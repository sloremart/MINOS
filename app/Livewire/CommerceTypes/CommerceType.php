<?php

namespace App\Livewire\CommerceTypes;

use App\Livewire\Forms\CommerceTypeForm;
use Livewire\Component;
use App\Traits\CrudModelsTrait;

class CommerceType extends Component
{
    use CrudModelsTrait;

    public CommerceTypeForm $modelForm;

    public function getData()
    {
        $data = \App\Models\CommerceType::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.commerce-types.commerce-type', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
