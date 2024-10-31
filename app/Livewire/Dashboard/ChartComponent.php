<?php
// ---------------------->ESTE COMPONENTE HACE PARTE DE LAS FUNCIONES PARA EL DASHBOARD Y SU TRABAJO ES GRAFICAR LOS PRODUCTOS MAS VENDIDOS  POR MEDIO DE UNA GRAFICA TIPO CANVA Y ESTA LIGADO AL DASHBOARD<-------------------------------------////
namespace App\Livewire\Dashboard;
use App\Models\Inventory;
use App\Models\SaleDetail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ChartComponent extends Component

{
    public $products = [];
    public $quantities = [];
    public $products_inventario = [];
    public $quantities_inventario = [];

    public function mount()
    {
        // Selecciona los productos más vendidos de la tabla sale_details
        $graficas = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
            ->select('products.name as product_name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
            ->groupBy('products.name')
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
