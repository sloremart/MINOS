<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tablas;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Forms\SaleForm;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix("proveedores")->group(function () {
        Route::get('listado', \App\Livewire\Suppliers\Supplier::class)
            ->name("supplier.list");
    });

// Rutas para Inventory
    Route::prefix("inventarios")->group(function () {
        Route::get('listado', \App\Livewire\Inventories\Inventory::class)
            ->name("inventory.list");
    });

// Rutas para Purchase
    Route::prefix("compras")->group(function () {
        Route::get('listado', \App\Livewire\Purchases\Purchase::class)
            ->name("purchase.list");
    });

// Rutas para Customer
    Route::prefix("clientes")->group(function () {
        Route::get('listado', \App\Livewire\Customers\Customer::class)
            ->name("customer.list");
    });

// Rutas para Sale
    Route::prefix("ventas")->group(function () {
        Route::get('listado', \App\Livewire\Sales\Sale::class)
            ->name("sale.list");
    });
 // Rutas para FormSale
    Route::prefix("ventas/detalles/{sale?}")->group(function () {
        Route::get('listado', \App\Livewire\SaleDetails\SaleDetail::class)
            ->name("sale_detail.list");
    });


// Rutas para crear Venta
    Route::prefix("ventas")->group(function () {
        Route::get('crear', \App\Livewire\Sales\CreateSale::class)
            ->name("sale.create");
    });

    // Rutas para crear Compra
    Route::prefix("compras")->group(function () {
        Route::get('crear', \App\Livewire\Purchases\CreatePurchase::class)
            ->name("purchase.create");
    });
// Rutas para File
    Route::prefix("archivos")->group(function () {
        Route::get('listado', \App\Livewire\Files\File::class)
            ->name("file.list");
    });

// Rutas para Entity
    Route::prefix("entidades")->group(function () {
        Route::get('listado', \App\Livewire\Entities\Entity::class)
            ->name("entity.list");
    });

// Rutas para Product
    Route::prefix("productos")->group(function () {
        Route::get('listado', \App\Livewire\Products\Product::class)
            ->name("product.list");
    });

// Rutas para Price
    Route::prefix("precios")->group(function () {
        Route::get('listado/{product?}', \App\Livewire\Prices\Price::class)
            ->name("price.list");
    });

// Rutas para Tipo Comercio
    Route::prefix("tipos-de-comercio")->group(function () {
        Route::get('listado', \App\Livewire\CommerceTypes\CommerceType::class)
            ->name("commerce_type.list");
    });


// Ruta Unidades
    Route::prefix("unidades")->group(function () {
        Route::get('listado', \App\Livewire\Units\Unit::class)
            ->name("unit.list");
    });

// Rutas para Sale
    Route::prefix("ventas")->group(function () {
        Route::get('listado', \App\Livewire\Sales\Sale::class)
            ->name("sale.list");
    });
 // Rutas para FormSale
    Route::prefix("ventas/detalles/{sale?}")->group(function () {
        Route::get('listado', \App\Livewire\SaleDetails\SaleDetail::class)
            ->name("sale_detail.list");
    });


// Rutas para crear Venta
    Route::prefix("ventas")->group(function () {
        Route::get('crear', \App\Livewire\Sales\CreateSale::class)
            ->name("sale.create");
    });
// Rutas para File
    Route::prefix("archivos")->group(function () {
        Route::get('listado', \App\Livewire\Files\File::class)
            ->name("file.list");
    });

// Rutas para Entity
    Route::prefix("entidades")->group(function () {
        Route::get('listado', \App\Livewire\Entities\Entity::class)
            ->name("entity.list");
    });
    Route::prefix("reportes")->group(function () {
        Route::get('listado', \App\Livewire\Reportes\Reportes::class)
            ->name("reporte.list");
    });
    Route::prefix("reportes/inventario")->group(function () {
        Route::get('listado', \App\Livewire\Reportes\ReporteInv::class)
            ->name("reporInv.list");
    });
    Route::prefix("reportes/ventaCliente")->group(function () {
        Route::get('listado', \App\Livewire\Reportes\ReporteCliente::class)
            ->name("reporInv.list");
    });



    Route::prefix('reportes/venta')->group(function () {
        Route::get('pdf', function () {
            $component = app()->make(\App\Livewire\Reportes\Reportes::class);
            // Renderizar el contenido de la vista
            return $component->pdf();
        })->name('reportespdf.list');
    });
// Rutas para Group
    Route::prefix("grupos")->group(function () {
        Route::get('listado', \App\Livewire\Groups\Group::class)
            ->name("group.list");
    });

// Rutas para Subgroup
    Route::prefix("subgrupos")->group(function () {
        Route::get('listado-todos', \App\Livewire\Subgroups\SubgroupAll::class)
            ->name("subgroup_all.list");
    });

// Rutas para Product
    Route::prefix("productos")->group(function () {
        Route::get('listado', \App\Livewire\Products\Product::class)
            ->name("product.list");
    });

// Rutas para Price
    Route::prefix("precios")->group(function () {
        Route::get('listado/{product?}', \App\Livewire\Prices\Price::class)
            ->name("price.list");
    });

    // Ruta Iva
    Route::prefix("iva")->group(function () {
        Route::get('listado', \App\Livewire\VatPercentages\VatPercentage::class)
            ->name("vat_percentage.list");
    });


});
