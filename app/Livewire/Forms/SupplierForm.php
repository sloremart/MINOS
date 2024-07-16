<?php

namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
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

    public function store()
    {
        $this->validate();
        $user = Auth::user();
        $data = $this->all();
        $data['user_id'] = $user->id;
        Supplier::create($data);
        return redirect('/proveedores/listado');
    }

    public function insert($id)
    {
        $model = Supplier::find($id);
        if ($model){
            $this->id= $model->id;
            $this->email = $model->email;
            $this->name = $model->name;
            $this->document = $model->document;
            $this->phone = $model->phone;
            $this->city = $model->city;
            $this->address = $model->address;
        }


    }

    public function edit()
    {

        $model = Supplier::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Supplier updated successfully.');
            return redirect('/proveedores/listado');
        }
    }

    public function delete($id)
    {
        $model = Supplier::find($id);
        if ($model) {
            $model->delete();
        }
        session()->flash('message', 'Supplier deleted successfully.');
        return redirect('/proveedores/listado');
    }
}
