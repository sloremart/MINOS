<?php

namespace App\Livewire\Purchases;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PurchaseForm;

class Purchase extends Component
{
    use CrudModelsTrait;

    public PurchaseForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Purchase::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.purchases.purchase', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
