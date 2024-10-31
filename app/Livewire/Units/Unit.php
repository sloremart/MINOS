<?php
/// COMPONENTE ENCARGADOR DE RENDERIZAR LA INFORMACION DE LAS UNIDADES DE MEDIDAS QUE SE ENCUENTREN REGISTRADAS EN EL SOFTWARE
namespace App\Livewire\Units;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\UnitForm;
use Livewire\WithPagination;

class Unit extends Component
{
    use CrudModelsTrait;

    public UnitForm $modelForm;

    use WithPagination;

    public $groups;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = null;

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        $query = \App\Models\Unit::query();
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
        return view('livewire.units.unit', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
