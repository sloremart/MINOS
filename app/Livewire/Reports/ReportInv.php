<?php
// ESTE COMPONENTE SE ENCARGAR DE RENDERIZAR LA VISTA DE REPORTES DE INVENTARIO Y DE IMPORTAR LOS DATOS A LA VISTA, PORTA FUNCIONES DE EXPORTAR EN PDF, EXCEL , ESTE COMPONENTE ES ACOMPAÑADOT TAMBIEN CON UNA GRAFICA TIPO DONA QUE SE IRA ACTUALIZANDO DEACUERDO LA INFORMACION CONSULTADA POR EL USUARIO
namespace App\Livewire\Reports;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
// Incluir las librerías necesarias

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\Title;




use Barryvdh\DomPDF\Facade\Pdf; // Usa el facade en lugar de la clase
use Dompdf\Css\Content\Attr;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class ReportInv extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;


    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_2 = ''; // Fecha de fin
    public $search_2_placeholder = 'Bucar...';
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    private $paginacion = 4;

    public function updating($field)
    {
        $this->resetPage();
    }

    public $products = [];
    public $quantities = [];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $userid=Auth::id();
        $query = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(inventories.quantity) as total_quantity'),
                DB::raw('MAX(inventories.created_at) as last_created_at')
            )->where('products.user_id',$userid)
            ->groupBy('products.name');

        if ($this->search_2) {
            $query->where('products.name', 'like', $this->search_2);
            // dd($query);
        }
        if ($this->search) {
            $query->where('inventories.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('inventories.created_at', '<=', $this->search_1);
        }

        $data = $query->paginate($this->paginacion);
        $this->products = $data->pluck('name')->toArray();
        $this->quantities = $data->pluck('total_quantity')->toArray();

        // Dispatch un evento para actualizar la gráfica
        $this->dispatch('updateChart', products: $this->products, quantities: $this->quantities);

        // dd('Evento updateChart despachado', $this->products, $this->quantities);
        $this->graficaDetalle();
        return view('livewire.reports.reportinv', [
            'data' => $data,
            'quantities' => $this->quantities,
            'productNames' => $this->products,
        ])->layout('layouts.app');
    }

    public function pdf()
    {
        $userid=Auth::id();
        $this->search_2 = urldecode($this->search_2);

        Log::info('Generando PDF con las fechas:', [
            'search' => $this->search,
            'search_1' => $this->search_1,
            'search_2' => $this->search_2,
        ]);

        // Copia la misma consulta del método render(), incluyendo los filtros
        $query = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(inventories.quantity) as total_quantity'),
                DB::raw('MAX(inventories.created_at) as last_created_at')
            )->where('products.user_id',$userid)
            ->groupBy('products.name');

        // Aplicar filtros de fecha
        if (!empty($this->search)) {
            $query->where('inventories.created_at', '>=', $this->search);
            Log::info('Aplicando filtro de fecha desde: ' . $this->search);
        }
        if (!empty($this->search_1)) {
            $query->where('inventories.created_at', '<=', $this->search_1);
            Log::info('Aplicando filtro de fecha hasta: ' . $this->search_1);
        }
        if (!empty($this->search_2)) {
            $query->where('products.name', 'like', $this->search_2);
            Log::info('Aplicando filtro de fecha hasta: ' . $this->search_2);
        }

        // Obtener los datos filtrados
        $data = $query->get();

        // Log de la cantidad de datos obtenidos
        Log::info('Cantidad de registros obtenidos: ' . $data->count());

        // Generar el PDF con los datos filtrados
        $pdf = Pdf::loadView('livewire.reports.reportInvePdf', compact('data'));

        // Devuelve el PDF para visualizarlo o descargarlo
        return $pdf->stream('reporte.pdf');
    }

    public function exportExcel()
    {
        $userid=Auth::id();
        // Definición de la ruta constante para el directorio donde se guardará el archivo
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
        $drawing->setPath(public_path('images/Logo_minos/LOGO.png')); // Ruta al logo
        $drawing->setCoordinates('D2'); // Posición del logo en la hoja
        $drawing->setHeight(100); // Ajustar tamaño del logo
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        // Combinar celdas F2:G6 para el logo
        $sheet->mergeCells('D2:G6');

        // Establecer el título de la hoja (Sistema de Información para Minoristas)
        $sheet->setCellValue('D8', 'Sistema de Información para Minoristas');

        // Combinar las celdas E8:H8 para centrar el título
        $sheet->mergeCells('D8:G8');

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
        $sheet->getStyle('D8:G8')->applyFromArray($titleStyle);

        // Establecer el subtítulo (Reporte de Inventario)
        $sheet->setCellValue('D10', 'Reporte de Inventario');

        // Combinar celdas D10:F10 para centrar el subtítulo
        $sheet->mergeCells('D10:E10');

        // Aplicar estilo al subtítulo
        $subtitleStyle = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('D10:E10')->applyFromArray($subtitleStyle);

        // Establecer el subtítulo (Fecha de Exportación)
        $exportDate = now()->format('d/m/Y H:i:s'); // Obtener la fecha y hora actual
        $sheet->setCellValue('F10', 'Fecha de Exportación: ' . $exportDate);

        // Combinar celdas H10:I10 para centrar la fecha de exportación
        $sheet->mergeCells('F10:G10');

        // Estilo para la fecha de exportación
        $exportDateStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('F10:G10')->applyFromArray($exportDateStyle);

        // Encabezados de la tabla (comienzan en D12)
        $headers = ['ID', 'Nombre del Producto', 'Cantidad Total', 'Última Fecha de Inventario'];

        // Colocar los encabezados en las celdas combinadas
        $sheet->fromArray($headers, null, 'D12');

        // Estilo para encabezados
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
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
        $sheet->getStyle('D12:G12')->applyFromArray($headerStyle);

        // Establecer filtros para la tabla de datos
        $sheet->setAutoFilter('D12:G12');

        // Consulta a la base de datos para obtener los productos e inventarios
        $query = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                DB::raw('SUM(inventories.quantity) as total_quantity'),
                DB::raw('MAX(inventories.created_at) as last_created_at')
            )->where('products.user_id',$userid)
            ->groupBy('products.id', 'products.name');

        // Filtros por búsqueda (opcional)
        if ($this->search_2) {
            $query->where('products.name', '>=', $this->search_2);
        }
        if ($this->search) {
            $query->where('inventories.created_at', '>=', $this->search);
        }
        if ($this->search_1) {
            $query->where('inventories.created_at', '<=', $this->search_1);
        }

        // Obtener los datos
        $data = $query->get()->toArray();

        // Escribir los datos debajo de los encabezados (comienza en D13)
        $sheet->fromArray($data, null, 'D13');

        // Establecer bordes para los datos, limitando el rango a las celdas de la tabla
        $lastRow = 13 + count($data) - 1; // Determinar la última fila con datos
        $dataBorderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle('D12:G' . $lastRow)->applyFromArray($dataBorderStyle); // Aplicar bordes solo a las celdas que contienen datos

        // Centrar la imagen y el contenido en la hoja
        $sheet->getColumnDimension('D')->setWidth(30); // Ajustar ancho de columna si es necesario
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(30);

        // Guardar el archivo Excel
        $fileName = 'reporte_inventario.xlsx';
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Retornar la ruta del archivo para descargar
        return response()->download($filePath)->deleteFileAfterSend(true);
    }






    public function graficaDetalle(): void
    {
        $userid=Auth::id();
        $query = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(inventories.quantity) as total_quantity')
            )->where('products.user_id',$userid)
            ->groupBy('products.name');

        // Filtrar por fechas si se proporcionan

        if ($this->search) {
            $query->where('inventories.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('inventories.created_at', '<=', $this->search_1);
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
