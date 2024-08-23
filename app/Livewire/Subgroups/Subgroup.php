<?php

namespace App\Livewire\Subgroups;

use App\Models\Group;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SubgroupForm;
use Livewire\WithPagination;

class Subgroup extends Component
{
    use CrudModelsTrait;

    public SubgroupForm $modelForm;
    use WithPagination;

    public $groups;
    public $group;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por codigo';

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        if ($this->group){
            $query = $this->group->subgroups();
        } else{
            $query = \App\Models\Subgroup::query();
        }
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }
    public function mount(Group $group = null)
    {
        $this->group = $group;
        $this->groups = Group::all();
    }


    public function render()
    {
        return view('livewire.subgroups.subgroup', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
