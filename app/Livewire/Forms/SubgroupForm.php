<?php

namespace App\Livewire\Forms;

use App\Models\Subgroup;
use App\Models\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SubgroupForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('min:3')]
    public $code = '';
    #[Validate('nullable')]
    public $description = '';

    #[Validate('required|exists:groups,id')]
    public $group_id = null;

    public function set($id)
    {
        $model = Subgroup::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->code = $model->code;
            $this->description = $model->description;
            $this->group_id = $model->group_id;
        }
    }

    public function store()
    {
        $this->validate();
        $subgroup = Subgroup::create($this->all());
        $subgroup->code = $subgroup->group_id.$subgroup->id;
        $subgroup->save();
        session()->flash('message', 'Subgrupo creado correctamente.');
        // return redirect('/subgrupos/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Subgroup::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Subgrupo actualizado correctamente.');
            // return redirect('/subgrupos/listado');
        }
    }

    public function delete($id)
    {
        $model = Subgroup::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Subgrupo eliminado correctamente.');
        }
        // return redirect('/subgrupos/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'description', 'group_id']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'group_id.required' => 'El grupo es obligatorio.',
            'group_id.exists' => 'El grupo seleccionado no existe.',
        ];
    }
}
