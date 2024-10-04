<?php


use Illuminate\Support\Facades\Route;
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

    // Rutas para Supplier
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
        Route::get('crear', \App\Livewire\Sales\CreateSale::class)
            ->name("sale.create");
        Route::get('detalles/{sale?}', \App\Livewire\SaleDetails\SaleDetail::class)
            ->name("sale_detail.list");
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

    // Rutas para Commerce Types
    Route::prefix("tipos-de-comercio")->group(function () {
        Route::get('listado', \App\Livewire\CommerceTypes\CommerceType::class)
            ->name("commerce_type.list");
    });

    // Rutas para Units
    Route::prefix("unidades")->group(function () {
        Route::get('listado', \App\Livewire\Units\Unit::class)
            ->name("unit.list");
    });

    // Rutas para Groups
    Route::prefix("grupos")->group(function () {
        Route::get('listado', \App\Livewire\Groups\Group::class)
            ->name("group.list");
    });

    // Rutas para Subgroups
    Route::prefix("subgrupos")->group(function () {
        Route::get('listado-todos', \App\Livewire\Subgroups\SubgroupAll::class)
            ->name("subgroup_all.list");
    });

    // Rutas para VAT
    Route::prefix("iva")->group(function () {
        Route::get('listado', \App\Livewire\VatPercentages\VatPercentage::class)
            ->name("vat_percentage.list");
    });

    // Rutas para Cash Closure
    Route::prefix("cierre")->group(function () {
        Route::get('listado', \App\Livewire\CashClosures\CashClosure::class)
            ->name("cierre_caja.list");
    });

    Route::prefix('reportes/cierreCaja')->group(function () {
        Route::get('pdf/{closureId}', function ($closureId) {
            $component = app()->make(\App\Livewire\CashClosures\CashClosure::class);
            return $component->generatePdf($closureId);
        })->name('cierre_caja.pdf');
    });

    // Rutas para Reportes
    Route::prefix("reportes")->group(function () {
        Route::prefix("inventario")->group(function () {
            Route::get('listado', \App\Livewire\Reports\ReportInv::class)
                ->name("reportInv.list");

            Route::get('pdf', function (\Illuminate\Http\Request $request) {
                Log::info('Valores de búsqueda recibidos:', [
                    'search' => $request->input('search'),
                    'search_1' => $request->input('search_1'),
                ]);

                $component = app()->make(\App\Livewire\Reports\ReportInv::class);
                $component->search = $request->input('search');
                $component->search_1 = $request->input('search_1');

                return $component->pdf();
            })->name('reporte_inventario.list');
        });

        Route::prefix("venta")->group(function () {
            Route::get('listado', \App\Livewire\Reports\Reports::class)
                ->name("reportSale.list");

            Route::get('pdf', function (\Illuminate\Http\Request $request) {
                Log::info('Valores de búsqueda recibidos:', [
                    'search' => $request->input('search'),
                    'search_1' => $request->input('search_1'),
                ]);

                $component = app()->make(\App\Livewire\Reports\Reports::class);
                $component->search = $request->input('search');
                $component->search_1 = $request->input('search_1');

                return $component->pdf();
            })->name('reportpdf.list');
        });

        Route::prefix("ventaCliente")->group(function () {
            Route::get('listado', \App\Livewire\Reports\ReportCustomer::class)
                ->name("reportCust.list");

            Route::get('pdf', function (\Illuminate\Http\Request $request) {
                Log::info('Valores de búsqueda recibidos:', [
                    'search' => $request->input('search'),
                    'search_1' => $request->input('search_1'),
                ]);

                $component = app()->make(\App\Livewire\Reports\ReportCustomer::class);
                $component->search = $request->input('search');
                $component->search_1 = $request->input('search_1');

                return $component->pdf();
            })->name('reporte_clientes.list');
        });

        Route::prefix("compraPoveedor")->group(function () {
            Route::get('listado', \App\Livewire\Reports\ReportPurchaseSuplier::class)
                ->name("reportCust.list");

            Route::get('pdf', function (\Illuminate\Http\Request $request) {
                Log::info('Valores de búsqueda recibidos:', [
                    'search' => $request->input('search'),
                    'search_1' => $request->input('search_1'),
                ]);

                $component = app()->make(\App\Livewire\Reports\ReportPurchaseSuplier::class);
                $component->search = $request->input('search');
                $component->search_1 = $request->input('search_1');

                return $component->pdf();
            })->name('reporte_proveedor.list');
        });
    });
});
