<?php
// ESTE COMPONENTE RENDERIZA LA VISTA DE REPORTES DE VENTAS POR CLIENTES  MUESTRA LOS DETALLES DE LAS VENTAS POR CLIENTE , COMO QUE PRODUCCTOS COMPRO Y QUE CANTIDAD, PORTA OPCIONES COMO DE EXPORTAR EN PDF, EXCEL Y ESTA ACOMPAÑADO CON UNA GRAFICA TIPO DONA QUE SE IRA ACTUALIZANDO  DE ACUERDO LA CONSULTA 
namespace App\Livewire\Reports;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\SaleDetail;
use App\Models\Price;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
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

class ReportCustomer extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

    public $search_2 = ''; // Fecha de inicio
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_2_placeholder = 'Bucar cliente';
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    private $paginacion = 4;

    public function updating($field)
    {
        $this->resetPage();
    }

    public $name = [];
    public $total_amount = [];
    public $fecha = [];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $query = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                'sales.payment_method',
                DB::raw('DATE(sales.sale_date) as sale_date'),  // Agrupar por fecha
                DB::raw('SUM(sales.total_amount) as total_amount')  // Sumar el total de las ventas por fecha
            )
            ->groupBy(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                'sales.payment_method',
                DB::raw('DATE(sales.sale_date)')
            );


        if ($this->search_2) {
            $query->where('customers.name','like', $this->search_2);
            // dd($query);
        }
        if ($this->search) {
            $query->where('sales.sale_date', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sales.sale_date', '<=', $this->search_1);
        }

        $data = $query->paginate($this->paginacion);
        $this->name = $data->pluck('name')->toArray();
        $this->total_amount = $data->pluck('total_amount')->toArray();

        // Dispatch un evento para actualizar la gráfica
        $this->dispatch('updateChart', name: $this->name, total_amount: $this->total_amount);

        // dd('Evento updateChart despachado', $this->products, $this->quantities);
        $this->graficaDetalle();
        return view('livewire.reports.reportCustomer', [
            'data' => $data,
            'name' => $this->name,
            'total_amount' => $this->total_amount,
        ])->layout('layouts.app');
    }


    public function pdf()
    {
        // Decodifica el parámetro search_2
    $this->search_2 = urldecode($this->search_2);
        \Log::info('Generando PDF con las fechas venta cliente:', [
            'search' => $this->search,
            'search_1' => $this->search_1,
            'search_2' => $this->search_2,
        ]);

        $query = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                DB::raw('DATE(sales.sale_date) as sale_date'),  // Agrupar por fecha
                DB::raw('SUM(sales.total_amount) as total_amount')  // Sumar el total de las ventas por fecha
            )
            ->groupBy(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                DB::raw('DATE(sales.sale_date)')
            );

        // Aplicar filtros de fecha
        if (!empty($this->search)) {
            $query->where('sales.sale_date', '>=', $this->search);
            \Log::info('Aplicando filtro de fecha desde: ' . $this->search);
        }
        if (!empty($this->search_1)) {
            $query->where('sales.sale_date', '<=', $this->search_1);
            \Log::info('Aplicando filtro de fecha hasta: ' . $this->search_1);
        }
        if (!empty($this->search_2)) {
            $query->where('customers.name', 'like', $this->search_2);
            \Log::info('Aplicando filtro nombre: ' . $this->search_2);
        }

        

        // Obtener los datos filtrados
        $data = $query->get();

        // Log de la cantidad de datos obtenidos
        \Log::info('Cantidad de registros obtenidos: ' . $data->count());

        // Generar el PDF con los datos filtrados
        $pdf = Pdf::loadView('livewire.reports.reportCustomersPdf', compact('data'));

        // Devuelve el PDF para visualizarlo o descargarlo
        return $pdf->stream('reporte_clientes.pdf');
    }

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
    $drawing->setPath(public_path('images\Logo_minos\LOGO.png')); // Ruta al logo (ajusta según la ubicación)
    $drawing->setCoordinates('D1'); // Posición del logo en la hoja
    $drawing->setHeight(100); // Ajustar tamaño del logo
    $drawing->setWorksheet($spreadsheet->getActiveSheet());

    // Combinar celdas D1:F7 para el logo
    $sheet->mergeCells('D1:F7');

    // Establecer el título de la hoja en D9:F9
    $sheet->setCellValue('D9', 'Sistema de Información para Minoristas');
    // Combinar celdas D9:F9 para centrar el título
    $sheet->mergeCells('D9:F9');

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
    $sheet->getStyle('D9:F9')->applyFromArray($titleStyle);

    // Establecer el subtítulo "Reporte de Ventas Detallado Por Cliente" en D10:F10
    $sheet->setCellValue('A12', 'Reporte de Ventas Detallado Por Cliente');
    // Combinar celdas D10:F10 para centrar el subtítulo
    $sheet->mergeCells('A12:D12');

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
    $sheet->getStyle('A12:D12')->applyFromArray($subtitleStyle);

    // Mostrar la fecha de exportación en G12:I12
    $sheet->setCellValue('G12', 'Fecha de Exportación: ' . now()->format('d/m/Y')); // Ajusta el formato de fecha según sea necesario
    // Combinar celdas G12:I12 para centrar la fecha
    $sheet->mergeCells('G12:I12');

    // Estilo para la fecha de exportación
    $dateStyle = [
        'font' => [
            'bold' => true,
            'size' => 12,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
    ];
    $sheet->getStyle('G12:I12')->applyFromArray($dateStyle);

    // Encabezados (2 filas debajo del título)
    $headers = ['ID', 'Nombre', 'Documento', 'Email', 'Teléfono', 'Producto', 'Cantidad', 'Subtotal', 'Fecha'];

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
    $sheet->getStyle('A14:I14')->applyFromArray($headerStyle);

    // Establecer filtros para la tabla de datos
    $sheet->setAutoFilter('A14:I14');

    // Consulta a la base de datos
    $query = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
        ->join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
        ->join('products', 'sale_details.product_id', '=', 'products.id')
        ->select(
            'customers.id',
            'customers.name',
            'customers.document',
            'customers.email',
            'customers.phone',
            'products.name as product_name',
            'sale_details.quantity',
            'sale_details.sub_total',
            DB::raw('DATE(sales.sale_date) as sale_date')
        )
        ->groupBy(
            'customers.id',
            'customers.name',
            'customers.document',
            'customers.email',
            'customers.phone',
            'products.name',
            'sale_details.quantity',
            'sale_details.sub_total',
            DB::raw('DATE(sales.sale_date)')
        );

    // Filtros por búsqueda (opcional)
    if ($this->search_2) {
        $query->where('customers.name', '>=', $this->search_2);
    }
    if ($this->search) {
        $query->where('sales.sale_date', '>=', $this->search);
    }
    if ($this->search_1) {
        $query->where('sales.sale_date', '<=', $this->search_1);
    }

    $data = $query->get()->toArray();

    // Escribir los datos debajo de los encabezados (comienza en A15)
    $sheet->fromArray($data, null, 'A15');

    // Calcular el total de consumo por cliente
    $totalsByClient = [];
    foreach ($data as $row) {
        if (!isset($totalsByClient[$row['name']])) {
            $totalsByClient[$row['name']] = 0;
        }
        $totalsByClient[$row['name']] += $row['sub_total'];
    }

    // Insertar los totales por cliente en la hoja (a partir de la columna K)
    $sheet->setCellValue('K14', 'Totales por Cliente');
    $sheet->setCellValue('L14', 'Valor Total');

    // Estilo para el encabezado de la tabla de totales
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
        'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
    ];
    $bodyStyle = [
       
        'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
    ];

    // Aplicar estilo al encabezado de Totales por Cliente
    $sheet->getStyle('K14:L14')->applyFromArray($headerStyle);
    $sheet->getStyle('K15:L15')->applyFromArray($bodyStyle);
    $sheet->getStyle('K16:L16')->applyFromArray($bodyStyle);
    $sheet->getStyle('A14:I22')->applyFromArray($bodyStyle);
    


    // Asegurarse de que los nombres de los clientes y sus totales se inserten correctamente
    $clientRow = 15; // Comienza a insertar en la fila 15
    foreach ($totalsByClient as $clientName => $total) {
        $sheet->setCellValue('K' . $clientRow, $clientName); // Nombre del cliente
        $sheet->setCellValue('L' . $clientRow, $total); // Total
        $clientRow++;
    }

    // Alinear las celdas de totales
    $sheet->getStyle('K15:L' . ($clientRow - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Generar el gráfico de barras
    // Supongamos que $data contiene tus datos y están organizados correctamente
    $categories = array_column($data, 'nombre'); // Ajusta según tus datos
    $values = array_column($data, 'subtotal'); // Ajusta según tus datos

    // Definir los valores para el gráfico
    $dataSeriesLabels = [
        new DataSeriesValues('String', 'Hoja1!$B$2:$B$' . (count($data) + 1), null, count($data)), // Etiquetas
    ];
    $xAxisTickValues = [
        new DataSeriesValues('String', 'Hoja1!$A$2:$A$' . (count($data) + 1), null, count($data)), // Valores del eje X
    ];
    $dataSeriesValues = [
        new DataSeriesValues('Number', 'Hoja1!$C$2:$C$' . (count($data) + 1), null, count($data)), // Valores del eje Y
    ];

    // Configurar el gráfico
    $series = new DataSeries(
        DataSeries::TYPE_BARCHART, // Tipo de gráfico
        DataSeries::GROUPING_CLUSTERED, // Agrupación
        range(0, count($dataSeriesValues) - 1), // Series
        $dataSeriesLabels,
        $xAxisTickValues,
        $dataSeriesValues
    );

    // Crear el gráfico
    $chart = new Chart(
        'chart1',
        new Title('Total de Ventas por Producto'),
        new Legend(Legend::POSITION_RIGHT, null, false),
        new PlotArea(null, [
            new DataSeries(
                DataSeries::TYPE_BARCHART,
                DataSeries::GROUPING_CLUSTERED,
                range(0, count($values) - 1), // Índices de las series
                [new DataSeriesValues('String', 'Hoja1!$K$15:$K$' . ($clientRow - 1), null, count($categories))], // Etiquetas
                [new DataSeriesValues('String', 'Hoja1!$K$15:$K$' . ($clientRow - 1), null, count($categories))], // Categorías
                [new DataSeriesValues('Number', 'Hoja1!$L$15:$L$' . ($clientRow - 1), null, count($values))]  // Valores
            )
        ]),
        true,
        0,
        null,
        null
    );

    // Añadir el gráfico a la hoja
    $sheet->addChart($chart);

    // Guardar el archivo Excel
    $writer = new Xlsx($spreadsheet);
    $fileName = 'ventas_detalladas_' . date('Y-m-d_H-i-s') . '.xlsx'; // Nombre del archivo
    $writer->save($directoryPath . '/' . $fileName);

    // Retornar el archivo para descarga
    return response()->download($directoryPath . '/' . $fileName)->deleteFileAfterSend(true);
}


    





    public function graficaDetalle(): void
    {

        $query = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                DB::raw('DATE(sales.sale_date) as sale_date'),  // Agrupar por fecha
                DB::raw('SUM(sales.total_amount) as total_amount')  // Sumar el total de las ventas por fecha
            )
            ->groupBy(
                'customers.name',
                'customers.email',
                'customers.document',
                'customers.phone',
                DB::raw('DATE(sales.sale_date)')
            );

        // Filtrar por fechas si se proporcionan
        if ($this->search_2) {
            $query->where('customers.name', '>=', $this->search_2);
            // dd($query);
        }
        if ($this->search) {
            $query->where('sales.sale_date', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sales.sale_date', '<=', $this->search_1);
        }

        // Ejecutar la consulta
        $data = $query->get();

        // Almacenar los resultados
        $this->name = $data->pluck('name')->toArray();
        $this->total_amount = $data->pluck('total_amount')->toArray();
        $this->fecha = $data->pluck('sale_date')->toArray();

        // Despachar un evento para actualizar la gráfica
        $this->dispatch('updateChart', name: $this->name, total_amount: $this->total_amount);
    }


    // En tu componente Livewire para actualizar la grafica cada vez que consultes en la fecha de la venta en la tabla
    public function updateData()
    {
        $name = $this->name;
        $total_amount = $this->total_amount;

        // Log para depurar
        Log::info('Datos para updateChart', [
            'name' => $name,
            'total_amount' => $total_amount,
        ]);

        $this->dispatch('updateChart', [
            'name' => $name,
            'total_amount' => $total_amount,
        ]);
    }
}
