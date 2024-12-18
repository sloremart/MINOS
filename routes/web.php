<?php
// En este apartado se encuentran detalladas todas las rutas de navegación del software. Desde la interfaz principal, los usuarios pueden acceder de manera intuitiva a todas las funciones y características disponibles. Cada ruta está diseñada para maximizar la eficiencia y minimizar el tiempo de búsqueda de las herramientas necesarias. Con una estructura clara y un diseño amigable, las rutas de navegación permiten a los usuarios moverse con facilidad a través de las distintas secciones del software, garantizando una experiencia fluida y sin contratiempos.
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
Route::get('/test', function () {
    return response()->json(['message' => 'Conexión exitosa con Laravel']);
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
        Route::get('crear', \App\Livewire\Purchases\CreatePurchase::class)
            ->name("purchase.create");
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



///-------------------------------------------------------------

///reportes inventario +pdf

    Route::prefix("reportes/inventario")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportInv::class)
            ->name("reportInv.list");
    });
    Route::get('/export-excel', [\App\livewire\Reports\ReportInv::class, 'exportExcel'])->name('export-excel');
    Route::prefix('reportes/inventario')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            \Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
                'search_2' => $request->input('search_2'),
            ]);

            $component = app()->make(\App\Livewire\Reports\ReportInv::class);

            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            $component->search_2 = $request->input('search_2');

            // Generar el PDF
            return $component->pdf();
        })->name('reporte_inventario.list');
    });

////-------------------------------------------------------------
///reportee de ventas + pdf
Route::prefix("reportes/venta")->group(function () {
    Route::get('listado', \App\Livewire\Reports\Reports::class)
        ->name("reportSale.list");
});
Route::get('/export-excel', [\App\Livewire\Reports\Reports::class, 'exportExcel'])->name('export-excel');


Route::prefix('reportes/venta')->group(function () {
    Route::get('pdf', function (\Illuminate\Http\Request $request) {
        // Log para verificar que las fechas llegan correctamente
        Log::info('Valores de búsqueda recibidos:', [
            'search' => $request->input('search'),
            'search_1' => $request->input('search_1'),
            'search_2' => $request->input('search_2'),
        ]);

        $component = app()->make(\App\Livewire\Reports\Reports::class);

        // Capturar los parámetros de la URL
        $component->search = $request->input('search');
        $component->search_1 = $request->input('search_1');
        $component->search_2 = $request->input('search_2');

        // Generar el PDF
        return $component->pdf();
    })->name('reportpdf.list');
});

///-------------------------------------------------------------
// reportes venta cliente + pdf
    Route::prefix("reportes/ventaCliente")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportCustomer::class)
            ->name("reportCust.list");
    });
    Route::get('/export-excel', [\App\livewire\Reports\ReportCustomer::class, 'exportExcel'])->name('export-excel');
    Route::prefix('reportes/ventaCliente')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            Log::info('Valores de búsqueda recibidos  ventas cliente:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
                'search_2' => $request->input('search_2'),
            ]);

            $component = app()->make(\App\Livewire\Reports\ReportCustomer::class);

            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            $component->search_2 = $request->input('search_2');


            // Generar el PDF
            return $component->pdf();
        })->name('reporte_clientes.list');
    });




    //------------------------------------------
    //reporte proveedor + pdf
    Route::prefix("reportes/compraPoveedor")->group(function () {
        Route::get('listado', \App\Livewire\Reports\ReportPurchaseSuplier::class)
            ->name("reportSupplier.list");
    });
    Route::get('/export-excel', [\App\livewire\Reports\ReportPurchaseSuplier::class, 'exportExcel'])->name('export-excel');

    Route::prefix('reportes/compraPoveedor')->group(function () {
        Route::get('pdf', function (\Illuminate\Http\Request $request) {
            // Log para verificar que las fechas llegan correctamente
            \Log::info('Valores de búsqueda recibidos:', [
                'search' => $request->input('search'),
                'search_1' => $request->input('search_1'),
                'search_2' => $request->input('search_2'),
            ]);

            $component = app()->make(\App\Livewire\Reports\ReportPurchaseSuplier::class);

            // Capturar los parámetros de la URL
            $component->search = $request->input('search');
            $component->search_1 = $request->input('search_1');
            $component->search_2 = $request->input('search_2');

            // Generar el PDF
            return $component->pdf();
        })->name('reporte_proveedor.list');
    });




//--------------------------------------- termina rutas reportes



// Rutas para el desplegable del Menu - Administraciones
// -------------------------------------------------------------

// Ruta Unidades
Route::prefix("unidades")->group(function () {
    Route::get('listado', \App\Livewire\Units\Unit::class)
        ->name("unit.list");
});



// Rutas para Group
    Route::prefix("grupos")->group(function () {
        Route::get('listado', \App\Livewire\Groups\Group::class)
            ->name("group.list");
    });

 //Rutas para Subgroup
    Route::prefix("subgrupos")->group(function () {
        Route::get('listado-todos', \App\Livewire\Subgroups\SubGroupAll::class)
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


/////////----------------------> ruta para cuerre caja <-------------------/////////////


Route::prefix("cierre")->group(function () {
    Route::get('listado', \App\Livewire\CashClosures\CashClosure::class)
        ->name("cierre_caja.list");
});



Route::prefix('reportes/cierreCaja')->group(function () {
    Route::get('pdf/{closureId}', function ($closureId) {
        // Crear una instancia del componente Livewire
        $component = app()->make(\App\Livewire\CashClosures\CashClosure::class);
        // Llamar al método que genera el PDF pasando el ID del cierre
        return $component->generatePdf($closureId);
    })->name('cierre_caja.pdf');
});
