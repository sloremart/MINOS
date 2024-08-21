<?php

namespace App\Livewire\Prices;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PriceForm;

class Price extends Component
{
    use CrudModelsTrait;

    public PriceForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Price::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.prices.price', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
