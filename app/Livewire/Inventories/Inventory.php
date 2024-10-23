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
    public $search_placeholder;
    public $search_1_placeholder;
    

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
        // Cambiamos a paginate() en lugar de obtener todos los datos
        $data = Auth::user()->inventories()->paginate(10); // 10 es el número de registros por página
        return $data;
    }
    
    public function render()
    {
        return view('livewire.inventories.inventory', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
    
}
