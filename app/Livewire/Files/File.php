<?php

namespace App\Livewire\Files;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\FileForm;

class File extends Component
{
    use CrudModelsTrait;

    public FileForm $modelForm;

    public function getData()
    {
        $data = \App\Models\File::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.files.file', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
