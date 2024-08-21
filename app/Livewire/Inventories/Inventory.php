<?php

namespace App\Livewire\Inventories;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\InventoryForm;

class Inventory extends Component
{
    use CrudModelsTrait;

    public InventoryForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Inventory::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.inventories.inventory', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
