<?php

namespace App\Livewire\Forms;

use App\Models\Entity;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EntityForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $entity_type = '';

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3|unique:entities,tax_id')]
    public $tax_id = '';

    #[Validate('required|min:5')]
    public $legal_address = '';

    #[Validate('required|min:5')]
    public $phone_number = '';

    #[Validate('required|email|unique:entities,email')]
    public $email = '';

    public function set($id)
    {
        $model = Entity::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->entity_type = $model->entity_type;
            $this->name = $model->name;
            $this->tax_id = $model->tax_id;
            $this->legal_address = $model->legal_address;
            $this->phone_number = $model->phone_number;
            $this->email = $model->email;
        }
    }

    public function store()
    {
        $this->validate();
        Entity::create($this->all());
        session()->flash('message', 'Entidad creada correctamente.');
        // return redirect('/entidades/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Entity::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Entidad actualizada correctamente.');
            // return redirect('/entidades/listado');
        }
    }

    public function delete($id)
    {
        $model = Entity::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Entidad eliminada correctamente.');
        }
        // return redirect('/entidades/listado');
    }

    public function resetForm()
    {
        $this->reset(['entity_type', 'name', 'tax_id', 'legal_address', 'phone_number', 'email']);
    }

    protected function messages()
    {
        return [
            'entity_type.required' => 'El tipo de entidad es obligatorio.',
            'entity_type.min' => 'El tipo de entidad debe tener al menos 3 caracteres.',
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'tax_id.required' => 'El ID fiscal es obligatorio.',
            'tax_id.unique' => 'El ID fiscal ya está registrado.',
            'legal_address.required' => 'La dirección legal es obligatoria.',
            'legal_address.min' => 'La dirección legal debe tener al menos 5 caracteres.',
            'phone_number.required' => 'El número de teléfono es obligatorio.',
            'phone_number.min' => 'El número de teléfono debe tener al menos 5 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
        ];
    }
}
