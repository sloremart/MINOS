<?php
// ------------------------------->ESTE COMPONENTE SE ENCARGAR DE RENDERIZAR LA VISTA DE LOS CLIENTES QUE SE ENCUENTREN REGISTRADOS EN EL SISTEMA POR LO TANTO ESTE COMPONENTE ESTA UNIDO CON EL DE CustomerFomr QUE PORTA LAS FUNCIONES DE CREAR ELIMINAR BUSCAR, EDITAR LOS REGISTROS QUE SE ENCUENTREN EN LA DEBE DE "customers" <--------------------/////////
namespace App\Livewire\Customers;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\CustomerForm;
use Livewire\WithPagination;

class Customer extends Component
{
    use CrudModelsTrait;

    public CustomerForm $modelForm;
    use WithPagination;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'document';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por documento';

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        $query = \App\Models\Customer::query();
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }

    public function render()
    {
        return view('livewire.customers.customer', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
