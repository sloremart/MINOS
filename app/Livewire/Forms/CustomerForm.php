<?php
// ----------->FUNCIONES PRINCIPALES DEL COMPONENTE DE CREAR TIPOS DE CLIENTES PERMITE CREAR ,ELIMINAR,EDITAR Y CONSULTAR LOS TIPOS DE CLIENTES REGISTRADOS EN EL SISTEMA<------------------////
namespace App\Livewire\Forms;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|unique:customers,email')]
    public $email = '';

    #[Validate('required|unique:customers,document')]
    public $document = '';

    #[Validate('required|min:5')]
    public $phone = '';

    #[Validate('required|min:5')]
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

    public function store()
    {
        $this->validate();
        $data = $this->all();
        $data['user_id'] = Auth::id();
        Customer::create($data);
        session()->flash('message', 'Cliente creado correctamente.');
        // return redirect('/clientes/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Customer::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Cliente actualizado correctamente.');
            // return redirect('/clientes/listado');
        }
    }

    public function delete($id)
    {
        $model = Customer::find($id);
        if ($model) {
            //$model->forceDelete();
            $model->delete();
            session()->flash('message', 'Cliente eliminado correctamente.');
        }
        // return redirect('/clientes/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'document', 'phone', 'address']);
    }

    protected function messages()
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
}
