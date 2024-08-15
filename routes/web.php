<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tablas;
use App\Livewire\Forms\ProductForm;

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
        Route::get('listado', \App\Livewire\Forms\SupplierForm::class)
            ->name("supplier.list");

        Route::post('crear', [SupplierController::class, 'store'])
            ->name('suppliers.store'); // Definimos la ruta suppliers.store
    });


    Route::prefix("clientes")->group(function () {
        Route::get('listado', \App\Livewire\Clients\Client::class)
            ->name("client.list");
    });

    Route::get('/tablas', [tablas::class, 'tablas'])->name('tablas.tablas');


    Route::get('/productos/listado', \App\Livewire\Forms\ProductForm::class)->name('product.list');


});
