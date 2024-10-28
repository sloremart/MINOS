<?php

namespace App\Livewire\CashClosures;


use App\Models\cash_closure;
use App\Models\Sale as ModelsSale;
use App\Models\SaleDetail;
use App\Models\PurchaseDetail;
use App\Models\User;
use App\Traits\CrudModelsTrait;
use Carbon\Doctrine\CarbonTypeConverter;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CashClosure extends Component
{
    use WithPagination;
    use CrudModelsTrait;

    public $user_name;
    public $closing_date_time; // Cambiar closure_time a closing_date_time
    public $start_balance = 0;
    public $payment_method;
    public $total_sales_cash;
    public $total_sales_card = 0;
    public $total_sales_transfer;
    public $total_expenses = 0;
    public $final_balance_cash = 0;
    public $final_balance_card;
    public $final_balance_transfer = 0;
    public $next_start_balance;
    public $total_sales;
    public $final_balance;
    public $selected_id;
    public $search = '';
    public $search_1 = '';
    public $search_2 = '';
    public $hasPreviousRecord = 0;
    public $purchaseDetails = []; // Inicializa la propiedad aquí
    public $isDisabled = false;
    private $paginacion = 7;
    public $users;



    public function calculateFinalBalance()
    {
        // Calcula el saldo final en efectivo
        $this->final_balance_cash = $this->start_balance + $this->total_sales_cash - $this->total_expenses;
    }



    public function mount()
    {
        $this->users = User::all();
        // Obtener el último registro de cierre de caja
        $lastCashClosure = cash_closure::latest('created_at')->first();
    
        // Verifica si ya hay un cierre de caja anterior
        $this->hasPreviousRecord = $this->checkForPreviousRecord();
    
        // Asigna 0 si no hay registro anterior, o deja el campo vacío
        $this->next_start_balance = $this->hasPreviousRecord ? null : 0;
    
        // Si existe un cierre de caja anterior, asignar el saldo inicial al valor de next_start_balance
        if ($lastCashClosure) {
            $this->start_balance = $lastCashClosure->next_start_balance;
            $this->next_start_balance = $this->start_balance; // Copia el saldo inicial al saldo para el próximo turno
        } else {
            // Si no hay registros previos, dejar el saldo inicial en 0 o permitir que se ingrese manualmente
            $this->start_balance = 0; // O puedes dejarlo en null si quieres permitir entrada manual
        }
    
        // Verificar si el saldo inicial es superior a 10,000
        if ($this->start_balance > 10000) {
            $this->isDisabled = true; // Deshabilitar el input si el saldo inicial es mayor a 10,000
        } else {
            $this->isDisabled = false; // Habilitar el input si es igual o menor a 10,000
        }
        // Deshabilitar el input si ya hay tres o más registros de cierre de caja
        $this->isDisabled = cash_closure::count() >= 0 ? true : $this->isDisabled;
    }
    


    

    public function checkForPreviousRecord()
    {
        // Lógica para verificar si existe un registro anterior de cierre de caja
        return cash_closure::where('user_id', auth()->id())->exists(); 
    }

    public function updatedStartBalance($value)
    {
        // Si el valor de start_balance cambia, verifica si debe habilitar o deshabilitar
        $this->isDisabled = !empty($value);
    }



    public function render()
    {
        $query = cash_closure::with('user');



        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'LIKE', "%{$this->search}%");
            });
        }

        if ($this->search_1) {
            $query->where('created_at', '<=', $this->search_1);
        }

        if ($this->search_2) {
            $query->where('created_at', '<=', $this->search_2);
        }


        $data = $query->paginate($this->paginacion);

        return view('livewire.cash-closure.cash-closure', [
            'data' => $data,
        ])->layout('layouts.app');
    }


    public function updatedPaymentMethod($value)
    {
        // Lógica para manejar la actualización según el método de pago
        if ($value === 'efectivo') {
            // Si seleccionas efectivo, asegúrate de que la transferencia esté en cero
            $this->total_sales_transfer = 0;
        } elseif ($value === 'transferencia') {
            // Si seleccionas transferencia, asegúrate de que el efectivo esté en cero
            $this->total_sales_cash = 0;
        }

        // Actualiza el total de ventas dependiendo del método seleccionado
        $this->calculateExpenses();
    }
    public function updateTotalSales()
    {
        // Resetear los totales

        $this->total_sales_transfer = 0;
        $this->total_expenses = 0; // Reiniciar los egresos


        // Calcular las ventas según el método de pago seleccionado
        if ($this->payment_method) {
            if ($this->payment_method === 'efectivo') {
                $this->total_sales_cash = $this->calculateSales('efectivo');
            } elseif ($this->payment_method === 'transferencia') {
                $this->total_sales_transfer = $this->calculateSales('transferencia');
            } elseif ($this->payment_method === 'all') {
                $this->total_sales_cash = $this->calculateSales('efectivo');
                $this->total_sales_transfer = $this->calculateSales('transferencia');
            }
        }

        $this->total_expenses = $this->calculateExpenses();
        // Calcular el total de ventas
        $this->total_sales = $this->total_sales_cash + $this->total_sales_transfer;

        // Calcular los egresos (asumiendo que tienes una tabla de egresos o algo similar)


        // Calcular el saldo final en efectivo
        $this->final_balance_cash =$this->total_sales_transfer + $this->start_balance + $this->total_sales_cash - $this->total_expenses;
       
        // Actualizar el balance total
        $this->final_balance = $this->start_balance + $this->total_sales - $this->total_expenses;
    }

    protected function calculateExpenses()
{
    // Asumimos que hay una tabla llamada 'purchases' para las compras
    return DB::table('purchases')
        ->whereDate('created_at', now()->format('Y-m-d')) // Filtrar por la fecha actual
        ->whereNull('deleted_at') // Excluir registros con fecha de eliminación
        ->sum('total_amount'); // Sumar el campo 'total_amount' de los registros no eliminados
}




    protected function calculateSales($method)
    {
        return ModelsSale::where('payment_method', $method)
            ->whereDate('created_at', now()->format('Y-m-d')) // Filtrar por la fecha actual
            ->get()
            ->sum(function ($sale) {
                return $sale->total_amount; // Cambia 'total_amount' por el campo correcto que representa el monto
            });
    }

    public function store()
    {
        $this->validate($this->validationRules());

        // Calcular el total de ventas y el saldo final
        $this->total_sales = $this->total_sales_cash  + $this->total_sales_transfer;
        $this->final_balance = $this->start_balance + $this->total_sales - $this->total_expenses;

        cash_closure::create([
            'user_id' => Auth::id(),
            // 'closing_date_time' => $this->closing_date_time, // Incluir closing_date_time
            'start_balance' => $this->start_balance,
            'total_sales_cash' => $this->total_sales_cash,
            'total_sales_card' => $this->total_sales_card,
            'total_sales_transfer' => $this->total_sales_transfer,
            'total_expenses' => $this->total_expenses,
            'total_sales' => $this->total_sales, // Nuevo campo
            'final_balance' => $this->final_balance, // Nuevo campo
            'final_balance_cash' => $this->final_balance_cash, // Nuevo campo
            'final_balance_card' => $this->final_balance_card, // Nuevo campo
            'final_balance_transfer' => $this->final_balance_transfer, // Nuevo campo
            'next_start_balance' => $this->next_start_balance,
        ]);
        // Resetear campos después de guardar
        $this->resetFields();
        return redirect('/cierre/listado');
    }




    public $salesDetails = [];
    public $showModal = false;


    public function showDetails($closureId)
{
    // Obtener el cierre de caja específico
    $closure = cash_closure::with('user')->find($closureId);
    if (!$closure) {
        session()->flash('error', 'cierre no encontrado');
        return;
    }
    
    $this->selected_id = $closure->id;
    $this->user_name = $closure->user->name;
    $this->closing_date_time = $closure->closing_date_time;
    $this->start_balance = $closure->start_balance;
    $this->total_sales = $closure->total_sales;
    $this->total_expenses = $closure->total_expenses;
    $this->final_balance = $closure->final_balance;

    // Convertir la fecha de cierre a un objeto Carbon
    $closingDateTime = Carbon::parse($closure->closing_date_time);
    
    // Obtener solo la parte de la fecha (Y-m-d)
    $closingDate = $closingDateTime->toDateString(); // Esto solo obtiene la fecha sin hora
    
    // Obtener los detalles de ventas relacionadas a este cierre basadas en la fecha
    $salesDetails = SaleDetail::with(['product' => function($query) {
            $query->withTrashed(); // Incluir productos eliminados
        }])
        ->whereHas('sale', function ($query) use ($closingDate) {
            // Comparar solo la fecha, no la hora
            $query->whereDate('created_at', $closingDate);
        })
        ->get();

    // Verificar si se encontraron ventas
    if ($salesDetails->isNotEmpty()) {
        // Asignar los detalles de ventas a una propiedad pública
        $this->salesDetails = $salesDetails;
        $this->showModal = true; // Abrir el modal de detalles
    } else {
        session()->flash('error', 'No se encontraron ventas para este cierre.');
    }

    // Obtener las compras por proveedor para la fecha actual del cierre
    $purchaseDetails = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
        ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        ->join('products', 'purchase_details.product_id', '=', 'products.id')
        ->select(
            'suppliers.name as supplier_name',        // Nombre del proveedor
            'products.name as product_name',          // Nombre del producto
            'purchase_details.quantity as quantity',   // Cantidad del producto
            'purchase_details.unit_price',             // Valor unitario de la compra
            'purchase_details.sub_total',              // Subtotal de la compra
            'purchases.purchase_date'                  // Fecha de la compra
        )
        ->whereDate('purchases.purchase_date', $closingDate) // Solo compras de la fecha actual
        ->get();

    // Verificar si se encontraron compras
    if ($purchaseDetails->isNotEmpty()) {
        // Asignar los detalles de compras a una propiedad pública
        $this->purchaseDetails = $purchaseDetails;
    } else {
        session()->flash('error', 'No se encontraron compras para este cierre.');
    }
}


    



public function generatePdf($closureId)
{
    // Obtener el cierre de caja específico
    $closure = cash_closure::with('user')->find($closureId);
    if (!$closure) {
        session()->flash('error', 'Cierre no encontrado.');
        return;
    }

    // Obtener la fecha de cierre
    $closingDateTime = Carbon::parse($closure->closing_date_time);
    $closingDate = $closingDateTime->toDateString(); // Solo fecha, sin hora

     // Obtener los detalles de ventas relacionadas a este cierre basadas en la fecha
     $salesDetails = SaleDetail::with(['product' => function($query) {
        $query->withTrashed(); // Incluir productos eliminados
    }])
    ->whereHas('sale', function ($query) use ($closingDate) {
        // Comparar solo la fecha, no la hora
        $query->whereDate('created_at', $closingDate);
    })
    ->get();

// Verificar si se encontraron ventas
if ($salesDetails->isNotEmpty()) {
    // Asignar los detalles de ventas a una propiedad pública
    $this->salesDetails = $salesDetails;
    // $this->showModal = true; 
} else {
    session()->flash('error', 'No se encontraron ventas para este cierre.');
}

    // Obtener los detalles de compras
    $purchaseDetails = PurchaseDetail::join('purchases', 'purchase_details.purchase_id', '=', 'purchases.id')
        ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        ->join('products', 'purchase_details.product_id', '=', 'products.id')
        ->select(
            'suppliers.name as supplier_name',        // Nombre del proveedor
            'products.name as product_name',          // Nombre del producto
            'purchase_details.quantity as quantity',  // Cantidad del producto
            'purchase_details.unit_price',            // Valor unitario de la compra
            'purchase_details.sub_total',             // Subtotal de la compra
            'purchases.purchase_date'                 // Fecha de la compra
        )
        ->whereDate('purchases.purchase_date', $closingDate) // Solo compras de la fecha actual
        ->get();

    // Verificar si se encontraron compras
    if ($purchaseDetails->isNotEmpty()) {
        $this->purchaseDetails = $purchaseDetails;
    } else {
        session()->flash('error', 'No se encontraron compras para este cierre.');
    }

    // Preparar los datos para la vista del PDF
    $data = [
        'closure' => $closure,
        'salesDetails' => $salesDetails,
        'purchaseDetails' => $purchaseDetails
    ];

    // Generar el PDF
    $pdf = Pdf::loadView('livewire.cash-closure.closure-pdf', $data);

    // Retornar el PDF generado para ser descargado
    return response()->streamDownload(
        fn() => print($pdf->output()),
        'cierre_de_caja_' . $closureId . '.pdf'
    );
}





    public function closeModal()
    {
        $this->showModal = false;
        $this->salesDetails = []; // Limpiar los detalles de ventas al cerrar
    }



    // Método para editar un cierre de caja
    protected function validationRules()
    {
        return [
            'user_name' => 'required|string',
            // 'closing_date_time' => 'required|date',
            'start_balance' => 'required|numeric',
            'next_start_balance' => 'required|numeric',
            // Agregar otras reglas según sea necesario
        ];
    }
    public function resetFields()
    {
        $this->user_name = '';
        // $this->closing_date_time = null; // Puede ser 'null' o una fecha por defecto si es necesario
        $this->start_balance = 0;
        $this->payment_method = null; // o '' si prefieres un string vacío
        $this->total_sales_cash = 0;
        $this->total_sales_card = 0;
        $this->total_sales_transfer = 0;
        $this->total_expenses = 0;
        $this->final_balance_cash = 0; // Resetear saldo final en efectivo
        $this->final_balance_card = 0; // Resetear saldo final en tarjeta
        $this->next_start_balance = 0;
        $this->total_sales = 0;
        $this->final_balance = 0;
        $this->search = '';
        $this->search_1 = '';
        $this->search_2 = '';
        return redirect('/cierre/listado');
        
    }
    public function Destroy($id)
    {
        $cashClosure = cash_closure::find($id);
        $cashClosure->delete();
    }
}
