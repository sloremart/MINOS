<?php

namespace App\Livewire\Dashboard;

use App\Models\Supplier; // Asegúrate de usar el modelo correcto
use App\Models\Customer;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DashboarddComponent extends Component
{
    public $userCount, $proveedorCount, $Client, $saleALL;
    public $buscar="";
    public $totalSalesFormatted; // Asegúrate de que esta línea esté presente
    private $paginacion= 4;

    use WithPagination;
    public function mount()
    {
        // Contar el número total de usuarios, proveedores, clientes y ventas
        $this->userCount = User::count();
        $this->proveedorCount = Supplier::count(); // Aquí usamos el modelo correcto
        $this->Client = Customer::count(); // Aquí usamos el modelo correcto
        // Obtener la suma total
        $totalSales = Sale::sum('total_amount');

        // Formatear el número
        $this->totalSalesFormatted = number_format($totalSales);
    }

    public function render()
    {
        // Obtener precios mínimo y máximo
        $minMaxPrices = PurchaseDetail::selectRaw('MIN(unit_price) as minPrice, MAX(unit_price) as maxPrice')
            ->first();

        $minPrice = $minMaxPrices->minPrice;
        $maxPrice = $minMaxPrices->maxPrice;
        $range = ($maxPrice - $minPrice) / 3;

        // Aplicar filtro de búsqueda si la variable buscar tiene contenido
        if (strlen($this->buscar) > 0) {
            $productos = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
                ->join('products', 'purchase_details.product_id', '=', 'products.id')
                ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                ->select(
                    'products.name as product_name',
                    'suppliers.name as supplier_name',
                    'purchase_details.unit_price as valor'
                )
                ->where('products.name', 'like', '%' . $this->buscar . '%') // Filtrar por nombre del producto
                ->orWhere('suppliers.name', 'like', '%' . $this->buscar . '%') // Filtrar por nombre del proveedor
                ->orWhere('purchase_details.unit_price', 'like', '%' . $this->buscar . '%') // Filtrar por precio
                ->orderBy('products.name', 'asc')
                ->paginate($this->paginacion); // Paginar los resultados
        } else {
            // Si no hay búsqueda, obtener todos los productos
            $productos = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
                ->join('products', 'purchase_details.product_id', '=', 'products.id')
                ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                ->select(
                    'products.name as product_name',
                    'suppliers.name as supplier_name',
                    'purchase_details.unit_price as valor'
                )
                ->orderBy('valor', 'asc') // Ordenar por valor (precio)
                ->paginate($this->paginacion); // Paginar los resultados
        }

        return view('livewire.dashboard.dashboardd-component', [
            'productos' => $productos,
            'minPrice' => $minPrice,
            'range' => $range,
            'maxPrice' => $maxPrice
        ])->layout('layouts.app');
    }
}
