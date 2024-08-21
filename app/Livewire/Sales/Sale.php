<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SaleForm;

class Sale extends Component
{
    use CrudModelsTrait;

    public SaleForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Sale::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.sales.sale', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
