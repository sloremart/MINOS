<?php
// ACA EN ESTE COMPONENTE SE REGISTRARA LAS UNIDADES DE MEDIDAS , TIENE METODOS DE CREAR ,ELIMINAR, EDITAR, 
namespace App\Livewire\Forms;

use App\Models\Unit;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    public $id = null;

    #[Validate('required|min:2')]
    public $name = '';

    #[Validate('required|min:1')]
    public $abbreviation = '';

    public function set($id)
    {
        $model = Unit::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->abbreviation = $model->abbreviation;
        }
    }

    public function store()
    {
        $this->validate();
        Unit::create($this->all());
        session()->flash('message', 'Unidad creada correctamente.');
        return redirect('/unidades/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Unit::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Unidad actualizada correctamente.');
            return redirect('/unidades/listado');
        }
    }

    public function delete($id)
    {
        $model = Unit::find($id);
        if ($model) {
            // $model->forceDelete();
            $model->delete();
            session()->flash('message', 'Unidad eliminada correctamente.');
        }
        // return redirect('/unidades/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'abbreviation']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'abbreviation.required' => 'La abreviatura es obligatoria.',
            'abbreviation.min' => 'La abreviatura debe tener al menos 1 carácter.',
        ];
    }
}
