<?php

namespace App\Livewire\Inventories;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\InventoryForm;

class Inventory extends Component
{
    use CrudModelsTrait;

    public InventoryForm $modelForm;
    public $products;

    public function mount()
    {
        $inventories = Auth::user()->inventories;
        if (count($inventories)>0){
            $id_inventories = $inventories->pluck('product_id');
            $this->products = Product::whereNotIn('id' , $id_inventories)->get();
        } else{
            $this->products = [];
        }
    }
    public function getData()
    {
        $data = Auth::user()->inventories;
        return $data;
    }

    public function render()
    {
        return view('livewire.inventories.inventory', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
