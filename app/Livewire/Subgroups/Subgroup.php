<?php

namespace App\Livewire\Subgroups;

use App\Models\Group;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SubgroupForm;

class Subgroup extends Component
{
    use CrudModelsTrait;

    public SubgroupForm $modelForm;
    public $groups;

    public function mount()
    {
        $this->groups = Group::all();
    }
    public function getData()
    {
        $data = \App\Models\Subgroup::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.subgroups.subgroup', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
