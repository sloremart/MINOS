<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Price;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Usa el facade en lugar de la clase
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;




class Reports extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_2 = ''; // Fecha de fin
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    public $search_2_placeholder = 'Buscar Producto ...';
    private $paginacion = 4;

    public function updating($field)
    {
        $this->resetPage();
    }

    public $products = [];
    public $quantities = [];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity'),
                DB::raw('MAX(sale_details.unit_price) as unit_price'),
                DB::raw('MAX(sale_details.sub_total) as sub_total'),
                DB::raw('MAX(sale_details.created_at) as last_created_at') // O MIN(sale_details.created_at)
            )
            ->groupBy('products.name', 'sale_details.created_at');

        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
        }
        if ($this->search_2) {
            $query->where('products.name', '<=', $this->search_2);
        }

        $data = $query->paginate($this->paginacion);
        $this->products = $data->pluck('name')->toArray();
        $this->quantities = $data->pluck('total_quantity')->toArray();

        // Dispatch un evento para actualizar la gráfica
        $this->dispatch('updateChart', products: $this->products, quantities: $this->quantities);

        // dd('Evento updateChart despachado', $this->products, $this->quantities);
        $this->graficaDetalle();
        $this->pdf();
        return view('livewire.reports.reports', [
            'data' => $data,
            'quantities' => $this->quantities,
            'productNames' => $this->products,
        ])->layout('layouts.app');
    }



    ////----------------------------EXPORTAR EN PDF----------------------//////////

    public function pdf()
    {
        \Log::info('Generando PDF con las fechas:', [
            'search' => $this->search,
            'search_1' => $this->search_1,
            'search_1' => $this->search_2,
        ]);

        // Copia la misma consulta del método render(), incluyendo los filtros
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity'),
                DB::raw('MAX(sale_details.unit_price) as unit_price'),
                DB::raw('MAX(sale_details.sub_total) as sub_total'),
                DB::raw('MAX(sale_details.created_at) as last_created_at')
            )
            ->groupBy('products.name', 'sale_details.created_at');

        // Aplicar filtros de fecha
        if (!empty($this->search)) {
            $query->where('sale_details.created_at', '>=', $this->search);
            \Log::info('Aplicando filtro de fecha desde: ' . $this->search);
        }
        if (!empty($this->search_1)) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
            \Log::info('Aplicando filtro de fecha hasta: ' . $this->search_1);
        }
        if (!empty($this->search_2)) {
            $query->where('products.name', '<=', $this->search_2);
            \Log::info('Aplicando filtro de fecha hasta: ' . $this->search_2);
        }

        // Obtener los datos filtrados
        $data = $query->get();

        // Log de la cantidad de datos obtenidos
        \Log::info('Cantidad de registros obtenidos: ' . $data->count());

        // Generar el PDF con los datos filtrados
        $pdf = Pdf::loadView('livewire.reports.reportPdf', compact('data'));

        // Devuelve el PDF para visualizarlo o descargarlo
        return $pdf->stream('reporte.pdf');
    }



    /////-------------------------EXPORTAR EN EXCEL---------------------------//////////
    public function exportExcel()
    {
        // Define una ruta constante para el directorio donde se guardará el archivo
        $directoryPath = public_path('reportes');
    
        // Verifica si la carpeta existe, si no, la crea
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }
    
        // Crear un nuevo archivo de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Insertar logo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('images/exportar/Excel.png')); // Ruta al logo
        $drawing->setCoordinates('A1'); // Posición del logo en la hoja
        $drawing->setHeight(100); // Ajustar tamaño del logo
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
    
        // Combinar celdas A1:C10 para el logo
        $sheet->mergeCells('A1:C10');
    
        // Establecer el título de la hoja 2 filas debajo del logo
        $sheet->setCellValue('A12', 'Reporte de Ventas');
    
        // Combinar las celdas A12:F12 para centrar el título
        $sheet->mergeCells('A12:F12');
    
        // Aplicar estilo al título
        $titleStyle = [
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A12:F12')->applyFromArray($titleStyle);
    
        // Encabezados (2 filas debajo del título)
        $headers = ['ID', 'Nombre', 'Cantidad', 'Valor Unitario', 'Valor Subtotal', 'Fecha'];
    
        // Combinar las celdas para cada columna (2 filas combinadas)
        $sheet->mergeCells('A14:A15'); // ID
        $sheet->mergeCells('B14:B15'); // Nombre
        $sheet->mergeCells('C14:C15'); // Cantidad
        $sheet->mergeCells('D14:D15'); // Valor Unitario
        $sheet->mergeCells('E14:E15'); // Valor Subtotal
        $sheet->mergeCells('F14:F15'); // Fecha
    
        // Colocar los encabezados en las celdas combinadas
        $sheet->fromArray($headers, null, 'A14');
    
        // Estilo para encabezados
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0000FF'], // Azul
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A14:F15')->applyFromArray($headerStyle);
    
        // Obtener los datos (debajo de las celdas combinadas para los encabezados)
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'sale_details.id',
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity'),
                DB::raw('MAX(sale_details.unit_price) as unit_price'),
                DB::raw('MAX(sale_details.sub_total) as sub_total'),
                DB::raw('MAX(sale_details.created_at) as last_created_at')
            )
            ->groupBy('products.name', 'sale_details.created_at', 'sale_details.id');
    
        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }
    
        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
        }
        if ($this->search_2) {
            $query->where('products.name', 'LIKE', "%{$this->search_2}%");
        }
    
        $data = $query->get()->toArray();
        
        // Escribir los datos debajo de las celdas combinadas (comienza en A16)
        $sheet->fromArray($data, null, 'A16');
    
        // Totalizar valores unitarios y subtotales
        $totalRow = count($data) + 16; // Se suma 16 para ajustar la fila donde se coloca la totalización
    
        // Totalizar valor unitario
        $sheet->setCellValue('D' . $totalRow, '=SUM(D16:D' . ($totalRow - 1) . ')');
        $sheet->setCellValue('E' . $totalRow, '=SUM(E16:E' . ($totalRow - 1) . ')');
    
        // Estilo para la fila de totales
        $totalStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FF0000'], // Rojo
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('D' . $totalRow . ':E' . $totalRow)->applyFromArray($totalStyle);
    
        // Guardar el archivo Excel
        $fileName = 'reporte_ventas.xlsx';
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName; // Usar separador de directorio adecuado
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    

    





    public function graficaDetalle(): void
    {
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity')
            )
            ->groupBy('products.name');

        // Filtrar por fechas si se proporcionan
        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
        }
        if ($this->search_2) {
            $query->where('products.name', '<=', $this->search_2);
        }

        // Ejecutar la consulta
        $data = $query->get();

        // Almacenar los resultados
        $this->products = $data->pluck('name')->toArray();
        $this->quantities = $data->pluck('total_quantity')->toArray();

        // Despachar un evento para actualizar la gráfica
        $this->dispatch('updateChart', products: $this->products, quantities: $this->quantities);
    }


    // En tu componente Livewire para actualizar la grafica cada vez que consultes en la fecha de la venta en la tabla
    public function updateData()
    {
        $products = $this->products;
        $quantities = $this->quantities;

        // Log para depurar
        Log::info('Datos para updateChart', [
            'products' => $products,
            'quantities' => $quantities,
        ]);

        $this->dispatch('updateChart', [
            'products' => $products,
            'quantities' => $quantities,
        ]);
    }
}
