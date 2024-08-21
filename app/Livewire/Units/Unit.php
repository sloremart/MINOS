<?php

namespace App\Livewire\Units;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\UnitForm;

class Unit extends Component
{
    use CrudModelsTrait;

    public UnitForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Unit::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.units.unit', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
