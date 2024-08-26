<?php
namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
    public $id = null;

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|min:5|unique:suppliers,document')]
    public $document = '';

    #[Validate('required|email|unique:suppliers,email')]
    public $email = '';

    #[Validate('required|min:5')]
    public $phone = '';

    #[Validate('required|min:5')]
    public $address = '';

    // `user_id` is usually assigned automatically based on the logged-in user.
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
        $model = Supplier::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->document = $model->document;
            $this->email = $model->email;
            $this->phone = $model->phone;
            $this->address = $model->address;
            $this->user_id = $model->user_id;
        }
    }

    public function store()
    {
        $this->validate();
        $data = $this->all();
        $data['user_id'] = Auth::id();
        Supplier::create($data);
        session()->flash('message', 'Proveedor creado correctamente.');
        return redirect('/proveedores/listado');
    }

    public function edit()
    {
        $this->validate([
            'name' => 'required|min:5',
            'document' => 'required|min:5|unique:suppliers,document,' . $this->id, // Ignora el registro actual en la validación de unicidad
            'email' => 'required|email|unique:suppliers,email,' . $this->id, // Ignora el registro actual en la validación de unicidad
            'phone' => 'required|min:5',
            'address' => 'required|min:5',
        ]);
        $model = Supplier::find($this->id);
        if ($model) {
            $model->update($this->all());
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

    public function resetForm()
    {
        $this->reset(['name', 'document', 'email', 'phone', 'address']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'document.required' => 'El documento es obligatorio.',
            'document.min' => 'El documento debe tener al menos 5 caracteres.',
            'document.unique' => 'El documento ya está registrado.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.min' => 'El teléfono debe tener al menos 5 caracteres.',
            'address.required' => 'La dirección es obligatoria.',
            'address.min' => 'La dirección debe tener al menos 5 caracteres.',
        ];
    }
}
