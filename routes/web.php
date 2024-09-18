<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tablas;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Forms\SaleForm;
use Illuminate\Support\Facades\Log;
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

    Route::prefix("tipos-de-comercio")->group(function () {
        Route::get('listado', \App\Livewire\CommerceTypes\CommerceType::class)
            ->name("commerce_type.list");
    });
/////Rutas para los reportes 
///reportee de ventas + pdf
    Route::prefix("reporte/venta")->group(function () {
        Route::get('listado', \App\Livewire\Reports\Reports::class)
            ->name("reportSale.list");
    });
   
    Route::prefix('reportes/venta')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
            ]);
    
            $component = app()->make(\App\Livewire\Reports\Reports::class);
            
            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            
            // Generar el PDF
            return $component->pdf();
        })->name('reportpdf.list');
    });
    
///-------------------------------------------------------------

///reportes inventario +pdf

    Route::prefix("reportes/inventario")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportInv::class)
            ->name("reportInv.list");
    });
    Route::prefix('reportes/inventario')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
            ]);
    
            $component = app()->make(\App\Livewire\Reports\ReportInv::class);
            
            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            
            // Generar el PDF
            return $component->pdf();
        })->name('reporte_inventario.list');
    });

////-------------------------------------------------------------
// reportes venta cliente + pdf
    Route::prefix("reportes/ventaCliente")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportCustomer::class)
            ->name("reportCust.list");
    });
    Route::prefix('reportes/ventaCliente')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
            ]);
    
            $component = app()->make(\App\Livewire\Reports\ReportCustomer::class);
            
            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            
            // Generar el PDF
            return $component->pdf();
        })->name('reporte_clientes.list');
    });

 //------------------------------------------   
    //reporte proveedor + pdf
    Route::prefix("reportes/compraPoveedor")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportPurchaseSuplier::class)
            ->name("reportCust.list");
    });

    Route::prefix('reportes/compraPoveedor')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
            ]);
    
            $component = app()->make(\App\Livewire\Reports\ReportPurchaseSuplier::class);
            
            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            
            // Generar el PDF
            return $component->pdf();
        })->name('reporte_proveedor.list');
    });
//////---------------------------------------------------------------

//--------------------------------------- termina rutas reportes



// Rutas para el desplegable del Menu - Administraciones 
// -------------------------------------------------------------

// Ruta Unidades
Route::prefix("unidades")->group(function () {
    Route::get('listado', \App\Livewire\Units\Unit::class)
        ->name("unit.list");
});

// Ruta Iva
Route::prefix("iva")->group(function () {
    Route::get('listado', \App\Livewire\VatPercentages\VatPercentage::class)
        ->name("vat_percentage.list");
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

});
