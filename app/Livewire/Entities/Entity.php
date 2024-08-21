<?php

namespace App\Livewire\Entities;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\EntityForm;

class Entity extends Component
{
    use CrudModelsTrait;

    public EntityForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Entity::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.entities.entity', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
