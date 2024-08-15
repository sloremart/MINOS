<?php
namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SupplierForm extends Component
{
    public $isOpen = false;  // Controla si el modal está abierto o cerrado
    public $id;
    #[Validate('required|min:5')]
    public $name = '';
    #[Validate('required|min:5')]
    public $document = '';
    #[Validate('required|min:5|email|unique:suppliers,email')]
    public $email = '';
    #[Validate('required|min:5')]
    public $phone = '';
    #[Validate('required|min:5')]
    public $address = '';
    #[Validate('required|min:5')]
    public $city = '';

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();
        $user = Auth::user();
        $data = $this->all();
        $data['user_id'] = $user->id;
        Supplier::create($data);
        $this->closeModal();
        session()->flash('message', 'Proveedor creado correctamente.');
        return redirect('/proveedores/listado');
    }

    public function insert($id)
    {
        $model = Supplier::find($id);
        if ($model){
            $this->id = $model->id;
            $this->email = $model->email;
            $this->name = $model->name;
            $this->document = $model->document;
            $this->phone = $model->phone;
            $this->city = $model->city;
            $this->address = $model->address;
            $this->openModal();  // Abrir modal cuando se edita
        }
    }

    public function edit()
    {
        $model = Supplier::find($this->id);
        if ($model) {
            $model->update($this->all());
            $this->closeModal();
            session()->flash('message', 'Proveedor actualizado correctamente.');
            return redirect('/proveedores/listado');
        }
    }

    public function delete($id)
    {
        $model = Supplier::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Proveedor eliminado correctamente.');
        }
        return redirect('/proveedores/listado');
    }

    public function render()
    {
        return view('livewire.forms.supplier-form', [
            'suppliers' => Supplier::all(),
        ])->layout('layouts.app');
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'document.required' => 'El documento es obligatorio.',
            'document.min' => 'El documento debe tener al menos 5 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.min' => 'El teléfono debe tener al menos 5 caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.min' => 'La dirección debe tener al menos 5 caracteres.',
            'city.required' => 'La ciudad es obligatoria.',
            'city.min' => 'La ciudad debe tener al menos 5 caracteres.',
        ];
    }
}
