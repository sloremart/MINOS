<?php

namespace App\Livewire\CashClosures;


use App\Models\cash_closure;
use App\Models\Sale as ModelsSale;
use App\Models\SaleDetail;
use App\Models\User;
use App\Traits\CrudModelsTrait;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CashClosure extends Component
{
    use WithPagination;
    use CrudModelsTrait;

    public $user_name;
    public $closing_date_time; // Cambiar closure_time a closing_date_time
    public $start_balance;
    public $payment_method;
    public $total_sales_cash = 0;
    public $total_sales_card = 0;
    public $total_sales_transfer = 0;
    public $total_expenses = 0;
    public $final_balance_cash = 0;
    public $final_balance_card = 0;
    public $final_balance_transfer = 0;
    public $next_start_balance = 0;
    public $total_sales = 0;
    public $final_balance = 0;
    public $selected_id;
    public $search = '';
    public $search_1 = '';
    public $search_2 = '';
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    public $search_2_placeholder = 'Buscar Producto ...';

    private $paginacion = 4;
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        $query = cash_closure::with('user');

        if ($this->search) {
            $query->where('created_at', '>=', $this->search);
        }

        if ($this->search_1) {
            $query->where('created_at', '<=', $this->search_1);
        }

        if ($this->search_2) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'LIKE', "%{$this->search_2}%");
            });
        }

        $data = $query->paginate($this->paginacion);

        return view('livewire.cash-closure.cash-closure', [
            'data' => $data,
        ])->layout('layouts.app');
    }

    public function updateTotalSales()
    {
        // Resetear los totales
        $this->total_sales_cash = 0;
        $this->total_sales_transfer = 0;
    
        // Calcular los totales según el método de pago seleccionado
        if ($this->payment_method) {
            // Si el método de pago es "cash" (efectivo)
            if ($this->payment_method === 'cash') {
                $this->total_sales_cash = $this->calculateSales('cash');
            }
            
            // Si el método de pago es "transfer" (transferencia)
            if ($this->payment_method === 'transfer') {
                $this->total_sales_transfer = $this->calculateSales('transfer');
            }
        }
    
        // Calcular el total de ventas
        $this->total_sales = $this->total_sales_cash + $this->total_sales_transfer;
    
        // Calcular el saldo final en efectivo (automáticamente)
        // Fórmula: Saldo Final en Efectivo = Saldo Inicial + Ventas en Efectivo - Egresos en Efectivo
        $this->final_balance_cash = $this->start_balance + $this->total_sales_cash - $this->total_expenses;
    
        // Actualizar el balance total (si se requiere que combine efectivo y otros métodos)
        $this->final_balance = $this->start_balance + $this->total_sales - $this->total_expenses;
    }
    
    
    

    protected function calculateSales($method)
    {
        return ModelsSale::where('payment_method', $method)
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
            'closing_date_time' => $this->closing_date_time, // Incluir closing_date_time
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
    }

    // Método para editar un cierre de caja
    protected function validationRules()
    {
        return [
            'user_name' => 'required|string',
            'closing_date_time' => 'required|date',
            'start_balance' => 'required|numeric',
            'next_start_balance' => 'required|numeric',
            // Agregar otras reglas según sea necesario
        ];
    }
    public function resetFields()
{
    $this->user_name = '';
    $this->closing_date_time = null; // Puede ser 'null' o una fecha por defecto si es necesario
    $this->start_balance = 0;
    $this->payment_method = null; // o '' si prefieres un string vacío
    $this->total_sales_cash = 0;
    $this->total_sales_card = 0;
    $this->total_sales_transfer = 0;
    $this->total_expenses = 0;
    $this->final_balance_cash = 0; // Resetear saldo final en efectivo
    $this->next_start_balance = 0;
    $this->total_sales = 0;
    $this->final_balance = 0;
    $this->search = '';
    $this->search_1 = '';
    $this->search_2 = '';
    $this->search_placeholder = 'Fecha inicio';
    $this->search_1_placeholder = 'Fecha fin';
    $this->search_2_placeholder = 'Buscar Producto ...';
}

}
