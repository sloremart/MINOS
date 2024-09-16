<?php

namespace App\Livewire\Reportes;

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
use Illuminate\Support\Facades\Log;

class ReporteCliente extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

    public $buscar = ''; // Fecha de inicio
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $buscar_placeholder = 'Bucar...';
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
            DB::raw('DATE(sales.sale_date) as sale_date'),  // Agrupar por fecha
            DB::raw('SUM(sales.total_amount) as total_amount')  // Sumar el total de las ventas por fecha
        )
        ->groupBy('customers.name', 'customers.email', 'customers.document', 'customers.phone',
         DB::raw('DATE(sales.sale_date)'));
       

        if ($this->buscar) {
            $query->where('customers.name', '>=', $this->buscar);
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
        return view('livewire.reportes.reporte-cliente', [
            'data' => $data,
            'name' => $this->name,
            'total_amount' => $this->total_amount,
        ])->layout('layouts.app');
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
        ->groupBy('customers.name', 'customers.email', 'customers.document', 'customers.phone',
         DB::raw('DATE(sales.sale_date)'));

        // Filtrar por fechas si se proporcionan
        if ($this->buscar) {
            $query->where('customers.name', '>=', $this->buscar);
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
