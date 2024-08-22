<?php

namespace App\Livewire\Prices;

use App\Models\Product;
use App\Models\Subgroup;
use App\Models\Unit;
use App\Models\VatPercentage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PriceForm;

class Price extends Component
{
    use CrudModelsTrait;

    public PriceForm $modelForm;
    public $products;

    public function mount()
    {
        $this->products = Product::all();
    }
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
