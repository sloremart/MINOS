<?php
// ----------->FUNCIONES PRINCIPALES DEL COMPONENTE DE CREAR TIPOS DE GRUPOS PARA CLASIFICAR Y ORGANIZAR LOS PRODUCTOS  PERMITE CREAR ,ELIMINAR,EDITAR Y CONSULTAR LOS TIPOS DE GRUPOS DE INVENTARIO REGISTRADOS EN EL SISTEMA<------------------////
namespace App\Livewire\Forms;

use App\Models\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('min:3')]
    public $code = '';
    #[Validate('nullable')]
    public $description = '';

    public function set($id)
    {
        $model = Group::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->code = $model->code;
            $this->description = $model->description;
        }
    }

    public function store()
    {
        $this->validate();
        $group = Group::create($this->all());
        $group->code = $group->id;
        $group->save();
        session()->flash('message', 'Grupo creado correctamente.');
        // return redirect('/grupos/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Group::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Grupo actualizado correctamente.');
            // return redirect('/grupos/listado');
        }
    }

    public function delete($id)
    {
        $model = Group::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Grupo eliminado correctamente.');
        }
        // return redirect('/grupos/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'description']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
        ];
    }
}
