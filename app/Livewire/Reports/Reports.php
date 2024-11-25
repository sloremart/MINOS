<?php
// ESTE COMPONENTE RENDERIZA LA VISTA DE REPORTES DE VENTAS    MUESTRA LOS DETALLES DE LAS  VENTAS , COMO QUE PRODUCCTOS SE VENDIERON Y QUE CANTIDAD ,Y VALOR, PORTA OPCIONES COMO DE EXPORTAR EN PDF, EXCEL Y ESTA ACOMPAÑADO CON UNA GRAFICA TIPO DONA QUE SE IRA ACTUALIZANDO  DE ACUERDO LA CONSULTA
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
    public $search_2; 
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
            )->withoutTrashed()
            ->groupBy('products.name', 'sale_details.created_at');

        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
        }
        if ($this->search_2) {
            $query->where('products.name', 'like', $this->search_2);
            // $query->where('products.name', 'like', '%' . $this->search . '%');

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

    public function mount()
    {
        $this->search_2 = ''; // Inicializa la propiedad
    }

    ////----------------------------EXPORTAR EN PDF----------------------//////////

    public function pdf()
    {
// Decodifica el parámetro search_2
    $this->search_2 = urldecode($this->search_2);
        // Log para verificar que las fechas y el nombre del producto llegan correctamente
    Log::info('Valores de búsqueda recibidos:', [
        'search' => $this->search,
        'search_1' => $this->search_1,
        'search_2' => $this->search_2,
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
            ->groupBy('products.name','sale_details.created_at');
    
       // Aplica los filtros de fechas
    if (!empty($this->search)) {
        $query->where('sale_details.created_at', '>=', $this->search);
    }
    if (!empty($this->search_1)) {
        $query->where('sale_details.created_at', '<=', $this->search_1);
    }
    if (!empty($this->search_2)) {
        $query->where('products.name', 'like', $this->search_2);
    }
    
        // Obtén los datos filtrados
        $data = $query->get();
    
        // Debug para verificar los datos filtrados
        // dd($data);
    
        // Genera el PDF con los datos filtrados
        $pdf = Pdf::loadView('livewire.reports.reportPdf', compact('data'));
        
        // Devuelve el PDF para visualizarlo
        return $pdf->stream('reporte.pdf');
    }



    /////-------------------------EXPORTAR EN EXCEL---------------------------//////////
    public function exportExcel()
    {
        // Definir la ruta para el directorio donde se guardará el archivo
        $directoryPath = public_path('reportes');

        // Verifica si la carpeta existe, si no, la crea
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0755, true);
        }

        // Crear un nuevo archivo de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Insertar logo
        // Insertar logo
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('images/Logo_Minos/LOGO.png')); // Ruta al logo
        $drawing->setCoordinates('F2'); // Posición del logo en la hoja
        $drawing->setHeight(100); // Ajustar altura del logo
        $drawing->setWidth(200); // Ajustar ancho del logo
        $drawing->setResizeProportional(true); // Mantener la proporción al cambiar el tamaño
        $drawing->setWorksheet($sheet);

        // Combinar celdas F2:H6 y G2:G6 para el logo
        $sheet->mergeCells('F2:G6');
        $sheet->mergeCells('G2:G6');
        $titleStylelOGO = [
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Aplicar el estilo a las celdas combinadas
        $sheet->getStyle('F2:G6')->applyFromArray($titleStylelOGO);
        $sheet->getStyle('G2:G6')->applyFromArray($titleStylelOGO);



        // Título del sistema y subtítulo
        $sheet->setCellValue('E8', 'Sistema de Información para Minoristas');

        // Combinar las celdas desde D4:I5 para el título
        $sheet->mergeCells('E8:H8');

        // Aplicar estilo para centrar el texto en las celdas combinadas
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

        // Aplicar el estilo a las celdas combinadas
        $sheet->getStyle('E8:H8')->applyFromArray($titleStyle);

        ////////////////////////////////////////////////////////////////////////////////////////////////

        ////SUBTITULO DE REPORTE DE VENTAS
        // Título del reporte
        $sheet->setCellValue('D10', 'Reporte de Ventas');
        $sheet->setCellValue('F21', 'Total:');

        // Combinar las celdas desde D10 hasta F10
        $sheet->mergeCells('D10:F10');

        // Aplicar estilo para alinear el texto a la izquierda
        $reportTitleStyle = [
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Aplicar el estilo a las celdas combinadas
        $sheet->getStyle('D10:F10')->applyFromArray($reportTitleStyle);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Establecer la fecha a la derecha
        // Obtener la fecha actual
        $currentDate = date('d-m-Y');

        // Colocar la fecha en la celda H10
        $sheet->setCellValue('H10', 'Fecha de Exportación:');
        $sheet->setCellValue('I10', $currentDate);

        // Aplicar estilo para alinear el texto
        $dateStyle = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Negro
                ],
            ],
        ];

        // Aplicar el estilo a las celdas H10 e I10
        $sheet->getStyle('H10:I10')->applyFromArray($dateStyle);

        ///////////////////////////////////////////////////////////////////////////////////

        // Encabezados de tabla
        $headers = ['ID', 'Nombre', 'Cantidad', 'Valor Unitario', 'Valor Subtotal', 'Fecha'];

        // Mover la tabla a D12 hasta I12
        $sheet->fromArray($headers, null, 'D12');

        // Aplicar estilo para encabezados
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
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Negro
                ],
            ],
        ];

        // Aplicar el estilo a los encabezados
        $sheet->getStyle('D12:I12')->applyFromArray($headerStyle);

        // Obtener los datos
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

        // Escribir los datos debajo de las celdas combinadas (comienza en D13)
        $sheet->fromArray($data, null, 'D13');

        // Estilo para los datos de la tabla
        $dataStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Negro
                ],
            ],
        ];

        // Aplicar el estilo a los datos de la tabla
        $sheet->getStyle('D13:I' . (12 + count($data)))->applyFromArray($dataStyle);

        // Totalizar valores unitarios y subtotales
        $totalRow = count($data) + 13; // Ajustar la fila de la totalización

        // Totalizar valor unitario con SUBTOTAL
        $sheet->setCellValue('G' . $totalRow, '=SUBTOTAL(109, G13:G' . ($totalRow - 1) . ')'); // Valor Unitario
        // Totalizar valor subtotal con SUBTOTAL
        $sheet->setCellValue('H' . $totalRow, '=SUBTOTAL(109, H13:H' . ($totalRow - 1) . ')'); // Valor Subtotal


        // Estilo para la fila de totales en verde claro
        $totalStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'CCFFCC'], // Verde claro
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Negro
                ],
            ],
        ];

        // Aplicar el estilo a la fila de totales
        $sheet->getStyle('D' . $totalRow . ':I' . $totalRow)->applyFromArray($totalStyle);

        // Agregar filtros en la fila de encabezados
        $sheet->setAutoFilter('D12:I12');

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
