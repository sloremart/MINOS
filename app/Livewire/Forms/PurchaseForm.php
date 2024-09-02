<?php

namespace App\Livewire\Forms;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;

class PurchaseForm extends Form
{
    public $id = null;
   
    #[Validate('required|exists:users,id')]
    public $user_id = null;

    #[Validate('required|exists:suppliers,id')]
    public $supplier_id = null;

    #[Validate('required|date')]
    public $purchase_date = '';

    #[Validate('required|numeric|min:0')]
    public $total_amount = 0.00;

    #[Validate('nullable')]
    public $details = '';

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
        $model = Purchase::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->user_id = $model->user_id;
            $this->supplier_id = $model->supplier_id;
            $this->purchase_date = $model->purchase_date;
            $this->total_amount = $model->total_amount;
            $this->details = $model->details;
        }
    }

    public function store()
    {
        $this->validate();
        Purchase::create($this->all());
        session()->flash('message', 'Compra creada correctamente.');
        return redirect('/compras/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Purchase::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Compra actualizada correctamente.');
            return redirect('/compras/listado');
        }
    }

    public function delete($id)
    {
        $model = Purchase::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Compra eliminada correctamente.');
        }
        return redirect('/compras/listado');
    }

    public function resetForm()
    {
        $this->reset(['user_id', 'supplier_id', 'purchase_date', 'total_amount', 'details']);
    }

    protected function messages()
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'supplier_id.required' => 'El proveedor es obligatorio.',
            'supplier_id.exists' => 'El proveedor seleccionado no existe.',
            'purchase_date.required' => 'La fecha de compra es obligatoria.',
            'purchase_date.date' => 'La fecha de compra debe ser una fecha válida.',
            'total_amount.required' => 'El monto total es obligatorio.',
            'total_amount.numeric' => 'El monto total debe ser un número.',
            'total_amount.min' => 'El monto total no puede ser negativo.',
        ];
    }
}
