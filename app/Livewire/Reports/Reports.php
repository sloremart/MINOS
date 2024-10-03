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
