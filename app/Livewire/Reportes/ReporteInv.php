<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PurchaseDetail;
use App\Models\Product;
<<<<<<< HEAD
use App\Models\Inventory;
=======
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
use App\Models\SaleDetail;
use App\Models\Price;
use Illuminate\Support\Facades\DB;



class ReporteInv extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

<<<<<<< HEAD
    public $buscar = ''; // Fecha de inicio
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $buscar_placeholder = 'Bucar...';
=======
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
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

        $data = $query->paginate($this->paginacion);
        $this->products = $data->pluck('name')->toArray();
        $this->quantities = $data->pluck('total_quantity')->toArray();

        // Dispatch un evento para actualizar la gráfica
        $this->dispatch('updateChart', products: $this->products, quantities: $this->quantities);

        // dd('Evento updateChart despachado', $this->products, $this->quantities);
        $this->graficaDetalle();
        return view('livewire.reportes.reporteinv', [
            'data' => $data,
            'quantities' => $this->quantities,
            'productNames' => $this->products,
        ])->layout('layouts.app');
    }

    public function graficaDetalle(): void
    {
<<<<<<< HEAD
        $query = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(inventories.quantity) as total_quantity')
=======
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select(
                'products.name',
                DB::raw('SUM(sale_details.quantity) as total_quantity')
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
            )
            ->groupBy('products.name');

        // Filtrar por fechas si se proporcionan
<<<<<<< HEAD
        if ($this->buscar) {
            $query->where('products.name', '>=', $this->buscar);
        }
        if ($this->search) {
            $query->where('inventories.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('inventories.created_at', '<=', $this->search_1);
=======
        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
>>>>>>> 0a2133f74b2fa9f339e781755bc5f7f8ba18015d
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
        \Log::info('Datos para updateChart', [
            'products' => $products,
            'quantities' => $quantities,
        ]);

        $this->dispatch('updateChart', [
            'products' => $products,
            'quantities' => $quantities,
        ]);
    }
}
