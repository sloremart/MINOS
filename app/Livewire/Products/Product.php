<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\ProductForm;

class Product extends Component
{
    use CrudModelsTrait;

    public ProductForm $modelForm;

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
