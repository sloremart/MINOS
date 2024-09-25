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
