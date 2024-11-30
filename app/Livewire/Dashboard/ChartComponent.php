<?php
namespace App\Livewire\Dashboard;

use App\Models\SaleDetail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Para obtener el usuario logueado

class ChartComponent extends Component
{
    public $products = [];
    public $quantities = [];
    public $products_inventario = [];
    public $quantities_inventario = [];

    public function mount()
    {
        // Obtener el ID del usuario logueado
        $userId = Auth::id();

        // Selecciona los productos más vendidos de la tabla sale_details
        // Solo para el usuario logueado
        $graficas = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id') // Relacionamos con la tabla 'sales'
            ->select('products.name as product_name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->groupBy('products.name')
            ->where('sales.user_id', $userId) // Filtramos solo por el usuario logueado
            ->orderBy('total_quantity', 'desc')
            ->get();

        // Asigna los nombres y cantidades a las propiedades del componente
        $this->products = $graficas->pluck('product_name')->toArray();
        $this->quantities = $graficas->pluck('total_quantity')->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.chart-component')->layout('layouts.app');
    }
}
