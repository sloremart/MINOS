<?php
namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SupplierForm extends Component
{
    public $id = null;
    #[Validate('required|min:5')]
    public $name = '';
    #[Validate('required|min:5')]
    public $contact = '';
    #[Validate('required|min:5')]
    public $phone = '';
    #[Validate('required|min:5')]
    public $address = '';

    public function setSupplier($id)
    {
        $model = Supplier::find($this->id);
        if ($model) {
            $this->name = $model->name;
            $this->contact = $model->contact;
            $this->phone = $model->phone;
            $this->address = $model->address;
        }
    }

    public function store()
    {
        $this->validate();
        //$user = Auth::user();
        //$data = $this->all();
        //$data['user_id'] = $user->id;
        Supplier::create($this->all());
        session()->flash('message', 'Proveedor creado correctamente.');
        return redirect('/proveedores/listado');
    }

    public function update()
    {
        $this->validate();
        $this->supplier->update($this->all());
        session()->flash('message', 'Proveedor actualizado correctamente.');
        return redirect('/proveedores/listado');
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
        $this->reset(['name', 'contact', 'phone', 'address']);
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
