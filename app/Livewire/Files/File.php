<?php

namespace App\Livewire\Files;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\FileForm;
use Livewire\WithPagination;

class File extends Component
{
    use CrudModelsTrait;

    public FileForm $modelForm;
    use WithPagination;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'document';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = null;

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        $query = \App\Models\File::query();
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
        return view('livewire.files.file', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
