<?php
// COMPONENTE QUE SE ENCARGAR DE RENDERIZAR LA VISTA DEL DETALLE DE LA VENTA

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SaleForm;
use Livewire\WithPagination;

class Sale extends Component
{
    use CrudModelsTrait;
    use WithPagination;

    public SaleForm $modelForm;
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
        $query = auth()->user()->sales();
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
        return view('livewire.sales.sale', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
