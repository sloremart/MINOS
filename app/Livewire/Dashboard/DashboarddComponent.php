<?php

namespace App\Livewire\Dashboard;

use App\Models\Supplier; // Asegúrate de usar el modelo correcto
use App\Models\Customer;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class DashboarddComponent extends Component
{
    public $userCount, $proveedorCount, $Client, $saleALL;
    public $totalSalesFormatted; // Asegúrate de que esta línea esté presente

    public function mount()
    {
        // Contar el número total de usuarios, proveedores, clientes y ventas
        $this->userCount = User::count();
        $this->proveedorCount = Supplier::count(); // Aquí usamos el modelo correcto
        $this->Client = Customer::count(); // Aquí usamos el modelo correcto
        // Obtener la suma total
        $totalSales = Sale::sum('total_amount');

        // Formatear el número
        $this->totalSalesFormatted = number_format($totalSales, 2, '.', '.');
    }

    public function render()
    {
        // Obtener los detalles de las compras y unir las tablas necesarias
        $productos = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->select('products.name as product_name',  'purchase_details.unit_price as valor')
            ->get();

        // Determinar el precio mínimo y el rango
        $minPrice = $productos->min('valor');
        $maxPrice = $productos->max('valor');
        $range = ($maxPrice - $minPrice) / 3;

        return view('livewire.dashboard.dashboardd-component', [
            'productos' => $productos,
            'minPrice' => $minPrice,
            'range' => $range
        ])->layout('layouts.app');
    }
}
