<?php

namespace App\Livewire\Purchases;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PurchaseForm;
use Livewire\WithPagination;

class Purchase extends Component
{
    use CrudModelsTrait;

    public PurchaseForm $modelForm;

    use WithPagination;
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
        $query = auth()->user()->purchases();
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
        return view('livewire.purchases.purchase', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
