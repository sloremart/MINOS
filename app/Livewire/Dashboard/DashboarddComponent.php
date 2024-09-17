<?php

namespace App\Livewire\Dashboard;

use App\Models\Supplier; // Asegúrate de usar el modelo correcto
use App\Models\Customer;
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
        return view('livewire.dashboard.dashboardd-component')->layout('layouts.app');
    }
}
