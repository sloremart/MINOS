<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\GroupForm;

class Group extends Component
{
    use CrudModelsTrait;

    public GroupForm $modelForm;

    public function getData()
    {
        $data = \App\Models\Group::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.groups.group', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
