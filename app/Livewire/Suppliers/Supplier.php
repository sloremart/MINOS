<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Supplier extends Component
{
    public SupplierForm $modelForm;
    use CrudModelsTrait;
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
        $query = auth()->user()->suppliers();
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.suppliers.supplier', [
        "data" => $this->getData()
        ])->layout('layouts.app');
    }

}
