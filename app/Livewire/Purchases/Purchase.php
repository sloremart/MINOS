<?php
// COMPONENTE ENCARGADO DE RENDERIZAR Y TRAER LA INFORAMCION A LA VISTA DE LAS COMPRAS

namespace App\Livewire\Purchases;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PurchaseForm;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Supplier;

class Purchase extends Component
{
    use CrudModelsTrait;
    use WithPagination;

    public PurchaseForm $modelForm;
    public $suppliers;
    public $users;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'id';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por numero';

    public function updating($field)
    {
        $this->resetPage();
    }

    public function getData()
    {
        // Cambia la consulta para obtener las compras relacionadas con el usuario autenticado
        $query = auth()->user()->purchases();

        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->paginate(10); // Asegúrate de usar el método correcto para la paginación
        return $data;
    }
    public function mount()
    {
        $this->suppliers = Supplier::all(); // Cargar los proveedores
        $this->users = User::all(); // Cargar los usuarios
    }
    public function render()
    {



        return view('livewire.purchases.purchase', [
            'data' => $this->getData(),

        ])->layout('layouts.app');
    }
}
