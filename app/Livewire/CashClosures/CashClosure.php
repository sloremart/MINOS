<?php

namespace App\Livewire\CashClosures;


use App\Models\cash_closure;
use App\Models\Sale as ModelsSale;
use App\Models\SaleDetail;
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
    public $start_balance;
    public $payment_method;
    public $total_sales_cash;
    public $total_sales_card = 0;
    public $total_sales_transfer;
    public $total_expenses;
    public $final_balance_cash ;
    public $final_balance_card ;
    public $final_balance_transfer = 0;
    public $next_start_balance ;
    public $total_sales ;
    public $final_balance;
    public $selected_id;
    public $search = '';
    public $search_1 = '';
    public $search_2 = '';
    

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
            elseif ($this->payment_method === 'transfer') {
                $this->total_sales_transfer = $this->calculateSales('transfer');
            }
            // Si el método de pago es "all" (todos)
            elseif ($this->payment_method === 'all') {
                $this->total_sales_cash = $this->calculateSales('cash');
                $this->total_sales_transfer = $this->calculateSales('transfer');
            }
        }

        // Calcular el total de ventas
        $this->total_sales = $this->total_sales_cash + $this->total_sales_transfer;

        // Calcular el saldo final en efectivo
        $this->final_balance_cash = $this->start_balance + $this->total_sales_cash - $this->total_expenses;

        // Actualizar el balance total
        $this->final_balance = $this->start_balance + $this->total_sales - $this->total_expenses;
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




    public $salesDetails = [];
    public $showModal = false;


    public function showDetails($closureId)
    {
        // Obtener el cierre de caja específico
        $closure = cash_closure::with('user')->find($closureId);
        if (!$closure) {
            session()->flash('error', 'cierre no encontrado');
        }
        $this->selected_id = $closure->id;
        $this->user_name = $closure->user->name;
        $this->closing_date_time = $closure->closing_date_time;
        $this->start_balance = $closure->start_balance;
        $this->total_sales = $closure->total_sales;
        $this->total_expenses = $closure->total_expenses;
        $this->final_balance = $closure->final_balance;

        if (!$closure) {
            session()->flash('error', 'Cierre no encontrado.');
            return;
        }

        // Convertir la fecha de cierre a un objeto Carbon
        $closingDateTime = Carbon::parse($closure->closing_date_time);

        // Obtener solo la parte de la fecha (Y-m-d)
        $closingDate = $closingDateTime->toDateString(); // Esto solo obtiene la fecha sin hora

        // Obtener los detalles de ventas relacionadas a este cierre basadas en la fecha
        $salesDetails = SaleDetail::with('product')
            ->whereHas('sale', function ($query) use ($closingDate) {
                // Comparar solo la fecha, no la hora
                $query->whereDate('created_at', $closingDate);
            })
            ->get();

        // Verificar si se encontraron ventas
        if ($salesDetails->isNotEmpty()) {
            // Asignar los detalles de ventas a una propiedad pública
            $this->salesDetails = $salesDetails;
            // dd($this->salesDetails);  // Verifica el contenido de la variable antes de mostrar el modal
            $this->showModal = true;
        } else {
            session()->flash('error', 'No se encontraron ventas para este cierre.');
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

        // Obtener los detalles de ventas relacionados a este cierre
        $salesDetails = SaleDetail::with('product')
            ->whereHas('sale', function ($query) use ($closingDate) {
                $query->whereDate('created_at', $closingDate);
            })
            ->get();

        // Preparar los datos para la vista del PDF
        $data = [
            'closure' => $closure,
            'salesDetails' => $salesDetails
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
    public function Destroy($id)
    {
        $cashClosure = cash_closure::find($id);
        $cashClosure->delete();
    }
}
