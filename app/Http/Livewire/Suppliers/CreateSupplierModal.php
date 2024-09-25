<?php

namespace App\Http\Livewire\Suppliers;

use Livewire\Component;
use App\Models\Supplier;

class CreateSupplierModal extends Component
{
    public $showModal = false;
    public $name;
    public $document;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $user_id;

    protected $rules = [
        'name' => 'required|string|max:255',
        'document' => 'required|string|max:255',
        'email' => 'required|email|unique:suppliers,email',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ];

    public function createSupplier()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'document' => $this->document,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'user_id' => $this->user_id,
        ]);

        $this->reset(['name', 'document', 'email', 'phone', 'address', 'city', 'user_id']);
        $this->showModal = false;

        session()->flash('success', 'Proveedor creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.suppliers.create-supplier-modal');
    }
}
