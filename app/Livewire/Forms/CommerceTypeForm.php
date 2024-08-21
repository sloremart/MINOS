<?php

namespace App\Livewire\Forms;

use App\Models\CommerceType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommerceTypeForm extends Form
{
    public $id = null;

    #[Validate('required|min:3|unique:commerce_types,name')]
    public $name = '';

    public function set($id)
    {
        $model = CommerceType::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
        }
    }

    public function store()
    {
        $this->validate();
        CommerceType::create($this->all());
        session()->flash('message', 'Tipo de comercio creado correctamente.');
        return redirect('/tipos-de-comercio/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = CommerceType::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Tipo de comercio actualizado correctamente.');
            return redirect('/tipos-de-comercio/listado');
        }
    }

    public function delete($id)
    {
        $model = CommerceType::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Tipo de comercio eliminado correctamente.');
        }
        return redirect('/tipos-de-comercio/listado');
    }

    public function resetForm()
    {
        $this->reset(['name']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.unique' => 'El nombre ya está registrado.',
        ];
    }
}
