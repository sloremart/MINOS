<?php

namespace App\Livewire\CashClosures;

use App\Models\cash_closure;
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
    public $payment_method; // Esto no aparece en la tabla, así que si no lo necesitas, puedes eliminarlo
    public $total_sales_cash = 0;
    public $total_sales_card = 0;
    public $total_sales_transfer = 0;
    public $total_expenses = 0;
    public $final_balance_cash = 0;
    public $next_start_balance = 0;
    public $selected_id; // Para guardar el ID del registro seleccionado para editar
    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_2 = ''; // Búsqueda de productos
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    public $search_2_placeholder = 'Buscar Producto ...';

    private $paginacion = 4;

    public $users; // Lista de usuarios

    public function mount()
    {
        // Cargar la lista de usuarios al inicio
        $this->users = User::all();
    }

    public function render()
    {
        // Filtrar datos según las búsquedas
        $query = cash_closure::query();

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

        $data = $query->paginate($this->paginacion); // Implementación de paginación

        return view('livewire.cash-closure.cash-closure', [
            'data' => $data,
        ])->layout('layouts.app');
    }

    // Método para crear un nuevo cierre de caja
    public function store()
    {
        $this->validate($this->validationRules());

        cash_closure::create([
            'user_id' => Auth::id(),
            'closing_date_time' => $this->closing_date_time, // Incluir closing_date_time
            'start_balance' => $this->start_balance,
            'total_sales_cash' => $this->total_sales_cash,
            'total_sales_card' => $this->total_sales_card,
            'total_sales_transfer' => $this->total_sales_transfer,
            'total_expenses' => $this->total_expenses,
            'final_balance_cash' => $this->final_balance_cash,
            'next_start_balance' => $this->next_start_balance,
        ]);

        // Resetear campos después de guardar
        $this->resetFields();
    }

    // Método para editar un cierre de caja
    public function edit($id)
    {
        $closure = cash_closure::findOrFail($id);

        $this->selected_id = $closure->id; // Guardar el ID del registro
        $this->user_name = $closure->user->name; // Asumiendo que hay una relación 'user' en CashClosure
        $this->closing_date_time = $closure->closing_date_time; // Asignar closing_date_time
        $this->start_balance = $closure->start_balance;
        $this->total_sales_cash = $closure->total_sales_cash;
        $this->total_sales_card = $closure->total_sales_card;
        $this->total_sales_transfer = $closure->total_sales_transfer;
        $this->total_expenses = $closure->total_expenses;
        $this->final_balance_cash = $closure->final_balance_cash;
        $this->next_start_balance = $closure->next_start_balance;
    }

    // Método para actualizar un cierre de caja
    public function update()
    {
        $this->validate($this->validationRules());

        $closure = cash_closure::findOrFail($this->selected_id);
        $closure->update([
            'user_id' => Auth::id(),
            'closing_date_time' => $this->closing_date_time, // Incluir closing_date_time
            'start_balance' => $this->start_balance,
            'total_sales_cash' => $this->total_sales_cash,
            'total_sales_card' => $this->total_sales_card,
            'total_sales_transfer' => $this->total_sales_transfer,
            'total_expenses' => $this->total_expenses,
            'final_balance_cash' => $this->final_balance_cash,
            'next_start_balance' => $this->next_start_balance,
        ]);

        // Resetear campos después de actualizar
        $this->resetFields();
    }

    // Método para eliminar un cierre de caja
    public function delete($id)
    {
        cash_closure::destroy($id);
    }

    // Método para validar campos
    protected function validationRules()
    {
        return [
            'user_name' => 'required|exists:users,name',
            'closing_date_time' => 'required|date',
            'start_balance' => 'required|numeric',
            'total_sales_cash' => 'required|numeric',
            'total_sales_card' => 'required|numeric',
            'total_sales_transfer' => 'required|numeric',
            'total_expenses' => 'required|numeric',
            'final_balance_cash' => 'required|numeric',
            'next_start_balance' => 'required|numeric',
        ];
    }

    // Método para resetear los campos
    public function resetFields()
    {
        $this->user_name = '';
        $this->closing_date_time = null; // Reiniciar closing_date_time
        $this->start_balance = 0;
        $this->total_sales_cash = 0;
        $this->total_sales_card = 0;
        $this->total_sales_transfer = 0;
        $this->total_expenses = 0;
        $this->final_balance_cash = 0;
        $this->next_start_balance = 0;
        $this->selected_id = null; // Reiniciar el ID seleccionado
    }
}
