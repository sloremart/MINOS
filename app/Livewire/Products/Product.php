<?php

namespace App\Livewire\Products;

use App\Models\Subgroup;
use App\Models\Unit;
use App\Models\VatPercentage;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\ProductForm;

class Product extends Component
{
    use CrudModelsTrait;

    public ProductForm $modelForm;
    public $vatPercentages;
    public $units;
    public $subgroups;

    public function mount()
    {
        $this->vatPercentages = VatPercentage::all();
        $this->units = Unit::all();
        $this->subgroups = Subgroup::all();
    }

    public function getData()
    {
        $data = \App\Models\Product::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.products.product', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
