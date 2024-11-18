<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class CustomerForm extends Form
{
    public $id = null;

    public $name = '';
    public $email = '';
    public $document = '';
    public $phone = '';
    public $address = '';
    public $user_id;

    public function mount($id = null)
    {
        if ($id) {
            $this->set($id);
        } else {
            $this->user_id = Auth::id(); // Set the current user's ID by default
        }
    }

    public function set($id)
    {
        $model = Customer::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->email = $model->email;
            $this->document = $model->document;
            $this->phone = $model->phone;
            $this->address = $model->address;
            $this->user_id = $model->user_id;
        } else {
            $this->resetForm();
        }
    }

    public function rules()
    {
        if ($this->id) {
            // Reglas para actualizar
            return [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:customers,email,' . $this->id, // Excluye el registro actual
                'document' => 'required|unique:customers,document,' . $this->id, // Excluye el registro actual
                'phone' => 'required|min:5',
                'address' => 'required|min:5',
            ];
        }

        // Reglas para crear
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:customers,email', // Valida unicidad
            'document' => 'required|unique:customers,document', // Valida unicidad
            'phone' => 'required|min:5',
            'address' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'document.required' => 'El documento es obligatorio.',
            'document.unique' => 'El documento ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.min' => 'El teléfono debe tener al menos 5 caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.min' => 'La dirección debe tener al menos 5 caracteres.',
        ];
    }

    public function store()
    {
        $this->validate($this->rules());
        $data = $this->all();
        $data['user_id'] = Auth::id(); // Asigna el ID del usuario autenticado
        Customer::create($data);
        session()->flash('message', 'Cliente creado correctamente.');
        $this->resetForm();
    }

    public function edit()
    {
        $this->validate($this->rules());
        $model = Customer::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Cliente actualizado correctamente.');
        }
    }

    public function delete($id)
    {
        $model = Customer::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Cliente eliminado correctamente.');
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'document', 'phone', 'address']);
    }
}
