<?php

namespace App\Livewire\Reports;


use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PurchaseDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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

class ReportPurchaseSuplier extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

    public $search_2 = ''; // Fecha de inicio
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    public $search_2_placeholder = 'Buscar proveedor ...';
    private $paginacion = 4;

    public function updating($field)
    {
        $this->resetPage();
    }

    public $quantities = [];
    public $name = [];
    public $fecha = [];

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $query = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->select(
                'suppliers.name as supplier_name',        // Nombre del proveedor
                'products.name as product_name',          // Nombre del producto
                'purchase_details.quantity as quantity',              // Cantidad del producto
                'purchase_details.unit_price',            // Valor unitario de la compra
                'purchase_details.sub_total',              // Subtotal de la compra
                'purchases.purchase_date'                 // Fecha de la compra
            );

        // dd($query);
        if ($this->search_2) {
            $query->where('suppliers.name', '>=', $this->search_2);
            // dd($query);
        }
        if ($this->search) {
            $query->where('purchase_date', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('purchase_date', '<=', $this->search_1);
        }

        $data = $query->paginate($this->paginacion);
        $this->name = $data->pluck('supplier_name')->toArray();
        $this->quantities = $data->pluck('quantity')->toArray();

        // Dispatch un evento para actualizar la gráfica
        $this->dispatch('updateChart', supplier_name: $this->name, quantity: $this->quantities);

        // dd('Evento updateChart despachado', $this->products, $this->quantities);
        $this->graficaDetalle();
        return view('livewire.reports.report-purchase-suplier', [
            'data' => $data,
            'name' => $this->name,
            'quantity' => $this->quantities,
        ])->layout('layouts.app');
    }



    public function pdf()
    {
        Log::info('Generando PDF con las fechas:', [
            'search' => $this->search,
            'search_1' => $this->search_1,
            'search_2' => $this->search_2,
        ]);

        $query = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->select(
                'suppliers.name as supplier_name',        // Nombre del proveedor
                'products.name as product_name',          // Nombre del producto
                'purchase_details.quantity as quantity',              // Cantidad del producto
                'purchase_details.unit_price',            // Valor unitario de la compra
                'purchase_details.sub_total',              // Subtotal de la compra
                'purchases.purchase_date'                 // Fecha de la compra
            );


        // Aplicar filtros de fecha
        if (!empty($this->search)) {
            $query->where('purchase_date', '>=', $this->search);
            Log::info('Aplicando filtro de fecha desde: ' . $this->search);
        }

        if (!empty($this->search_1)) {
            $query->where('purchase_date', '<=', $this->search_1);
            Log::info('Aplicando filtro de fecha hasta: ' . $this->search_1);
        }
        if (!empty($this->search_2)) {
            $query->where('supplier_name', '<=', $this->search_2);
            Log::info('Aplicando filtro de fecha hasta: ' . $this->search_2);
        }


        // Obtener los datos filtrados
        $data = $query->get();

        // Log de la cantidad de datos obtenidos
        Log::info('Cantidad de registros obtenidos: ' . $data->count());

        // Generar el PDF con los datos filtrados
        $pdf = Pdf::loadView('livewire.reports.reportSupplierPdf', compact('data'));

        // Devuelve el PDF para visualizarlo o descargarlo
        return $pdf->stream('reporte_proveedor.pdf');
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
        $drawing->setPath(public_path('images/exportar/Excel.png')); // Ruta al logo
        $drawing->setCoordinates('A1'); // Posición del logo en la hoja
        $drawing->setHeight(100); // Ajustar tamaño del logo
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        // Combinar celdas A1:C10 para el logo
        $sheet->mergeCells('A1:C10');

        // Establecer el título de la hoja 2 filas debajo del logo
        $sheet->setCellValue('A12', 'Reporte de Compras por Proveedor');

        // Combinar las celdas A12:H12 para centrar el título
        $sheet->mergeCells('A12:H12');

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
        $sheet->getStyle('A12:H12')->applyFromArray($titleStyle);

        // Encabezados de la primera tabla (Detalles de las compras)
        $headers = ['Proveedor', 'Producto', 'Cantidad', 'Precio Unitario', 'Subtotal', 'Fecha de Compra'];

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
        $sheet->getStyle('A14:F14')->applyFromArray($headerStyle);

        // Establecer filtros para la tabla de datos
        $sheet->setAutoFilter('A14:F14');

        // Consulta a la base de datos para obtener los detalles de las compras
        $query = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->select(
                'suppliers.name as supplier_name',
                'products.name as product_name',
                'purchase_details.quantity as quantity',
                'purchase_details.unit_price',
                'purchase_details.sub_total',
                'purchases.purchase_date'
            );

        // Aplicar filtros de búsqueda
        if ($this->search_2) {
            $query->where('suppliers.name', 'like', $this->search_2);
        }
        if ($this->search) {
            $query->where('purchases.purchase_date', '>=', $this->search);
        }
        if ($this->search_1) {
            $query->where('purchases.purchase_date', '<=', $this->search_1);
        }

        // Obtener los datos de la primera tabla (detalles de compras)
        $data = $query->get()->toArray();

        // Escribir los datos debajo de los encabezados de la primera tabla (comienza en A15)
        $sheet->fromArray($data, null, 'A15');

        // Mover a una nueva posición para la segunda tabla (resumen por proveedor)
        $startRow = count($data) + 17;  // Mover dos filas después de los detalles de compra

        // Encabezados de la segunda tabla (Resumen de compras por proveedor)
        $sheet->setCellValue('H' . $startRow, 'Proveedor');
        $sheet->setCellValue('I' . $startRow, 'Cantidad Total');
        $sheet->setCellValue('J' . $startRow, 'Valor Total Comprado');

        // Aplicar estilo a los encabezados de la segunda tabla
        $sheet->getStyle("H$startRow:I$startRow:J$startRow")->applyFromArray($headerStyle);

        // Consulta para obtener el total de las compras por proveedor
        $summaryQuery = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->select(
                'suppliers.name',
                DB::raw('SUM(purchase_details.quantity) as total_quantity'),
                DB::raw('SUM(purchase_details.sub_total) as total_value')
            )
            ->groupBy('suppliers.name');

        // Obtener los datos de la segunda tabla (resumen por proveedor)
        $summaryData = $summaryQuery->get()->toArray();

        // Escribir los datos debajo de los encabezados de la segunda tabla (comienza en A[startRow + 1])
        $sheet->fromArray($summaryData, null, 'H' . ($startRow + 1));

        // Ajustar el ancho de las columnas
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);

        // Guardar el archivo Excel
        $fileName = 'reporte_compras_proveedor.xlsx';
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Retornar la ruta del archivo para descargar
        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    public function graficaDetalle(): void
    {

        $query = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->select(
                'suppliers.name as supplier_name',        // Nombre del proveedor
                'products.name as product_name',          // Nombre del producto
                'purchase_details.quantity as quantity',              // Cantidad del producto
                'purchase_details.unit_price',            // Valor unitario de la compra
                'purchase_details.sub_total',              // Subtotal de la compra
                'purchases.purchase_date'                 // Fecha de la compra
            );

        // Filtrar por fechas si se proporcionan
        if ($this->search_2) {
            $query->where('suppliers.name', '>=', $this->search_2);
            // dd($query);
        }
        if ($this->search) {
            $query->where('purchases.purchase_date', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('purchases.purchase_date', '<=', $this->search_1);
        }

        // Ejecutar la consulta
        $data = $query->get();

        // Almacenar los resultados
        $this->name = $data->pluck('supplier_name')->toArray();
        $this->quantities = $data->pluck('quantity')->toArray();
        // $this->fecha = $data->pluck('purchases.purchase_date')->toArray();

        // Despachar un evento para actualizar la gráfica
        $this->dispatch('updateChart', supplier_name: $this->name, quantity: $this->quantities);
    }


    // En tu componente Livewire para actualizar la grafica cada vez que consultes en la fecha de la venta en la tabla
    public function updateData()
    {
        $name = $this->name;
        $quantities = $this->quantity;

        // Log para depurar
        Log::info('Datos para updateChart', [
            'supplier_name' => $name,
            'quantity' => $quantities,
        ]);

        $this->dispatch('updateChart', [
            'supplier_name' => $name,
            'quantity' => $quantities,
        ]);
    }
}
