<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Supplier extends Component
{
    use CrudModelsTrait;

    public SupplierForm $modelForm;

    public function getData()
    {
        $data= Auth::user()->suppliers;
        return $data;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.suppliers.supplier', [
        "data" => $this->getData()
        ])->layout('layouts.app');
    }

}
