<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\CustomerForm;

class Customer extends Component
{
    use CrudModelsTrait;

    public CustomerForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Customer::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.customers.customer', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
