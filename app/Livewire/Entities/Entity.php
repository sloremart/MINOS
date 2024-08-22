<?php

namespace App\Livewire\Entities;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\EntityForm;
use Livewire\WithPagination;

class Entity extends Component
{
    use CrudModelsTrait;

    public EntityForm $modelForm;
    use WithPagination;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'nit';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = null;

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        $query = \App\Models\Entity::query();
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }

    public function render()
    {
        return view('livewire.entities.entity', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
