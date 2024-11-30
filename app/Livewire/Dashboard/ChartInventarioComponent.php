<?php
// ---------------------->ESTE COMPONENTE HACE PARTE DE LAS FUNCIONES PARA EL DASHBOARD Y SU TRABAJO ES GRAFICAR LOS PRODUCTOS CON BAJO STOCK  POR MEDIO DE UNA GRAFICA TIPO CANVA Y ESTA LIGADO AL DASHBOARD<-------------------------------------////
namespace App\Livewire\Dashboard;

use App\Models\Inventory;
use App\Models\SaleDetail;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ChartInventarioComponent extends Component

{
    public $products = [];
    public $quantities = [];
    public $products_inventario = [];
    public $quantities_inventario = [];

    public function mount()
    {

        // Definir un umbral para considerar que un producto tiene stock bajo (ejemplo: 10 unidades)
        $stockThreshold = 20;
        $userId = Auth::id();
        // Consulta para obtener los productos cuyo stock es menor que el umbral
        $stockLow = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->select('products.name as product_name', 'inventories.quantity as stock')
            ->where('inventories.quantity', '<=', $stockThreshold) // Verificar productos con stock bajo
            ->where('inventories.user_id', $userId) 
            ->orderBy('inventories.quantity', 'asc') // Ordenar por menor cantidad
            ->get();

        // Asignar los nombres y los stocks a las propiedades del componente
        $this->products = $stockLow->pluck('product_name')->toArray();
        $this->quantities = $stockLow->pluck('stock')->toArray();
    }
    public function render()
    {

        return view('livewire.dashboard.chart-inventario-component')->layout('layouts.app');
    }
}
