<?php

namespace App\Livewire\Forms;

use App\Models\File;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FileForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $file_name = '';

    #[Validate('required|min:3')]
    public $file_type = '';

    #[Validate('required|integer|min:1')]
    public $file_size = 0;

    #[Validate('required|integer')]
    public $morphable_id = null;

    #[Validate('required|min:3')]
    public $morphable_type = '';

    public function set($id)
    {
        $model = File::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->file_name = $model->file_name;
            $this->file_type = $model->file_type;
            $this->file_size = $model->file_size;
            $this->morphable_id = $model->morphable_id;
            $this->morphable_type = $model->morphable_type;
        }
    }

    public function store()
    {
        $this->validate();
        File::create($this->all());
        session()->flash('message', 'Archivo guardado correctamente.');
        return redirect('/archivos/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = File::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Archivo actualizado correctamente.');
            return redirect('/archivos/listado');
        }
    }

    public function delete($id)
    {
        $model = File::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Archivo eliminado correctamente.');
        }
        return redirect('/archivos/listado');
    }

    public function resetForm()
    {
        $this->reset(['file_name', 'file_type', 'file_size', 'morphable_id', 'morphable_type']);
    }

    protected function messages()
    {
        return [
            'file_name.required' => 'El nombre del archivo es obligatorio.',
            'file_name.min' => 'El nombre del archivo debe tener al menos 3 caracteres.',
            'file_type.required' => 'El tipo de archivo es obligatorio.',
            'file_type.min' => 'El tipo de archivo debe tener al menos 3 caracteres.',
            'file_size.required' => 'El tamaño del archivo es obligatorio.',
            'file_size.integer' => 'El tamaño del archivo debe ser un número entero.',
            'file_size.min' => 'El tamaño del archivo debe ser al menos 1 byte.',
            'morphable_id.required' => 'El ID de la entidad relacionada es obligatorio.',
            'morphable_type.required' => 'El tipo de entidad relacionada es obligatorio.',
            'morphable_type.min' => 'El tipo de entidad relacionada debe tener al menos 3 caracteres.',
        ];
    }
}
