<?php

namespace App\Livewire\Forms;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SaleForm extends Form
{
    public $id = null;

    #[Validate('required|exists:customers,id')]
    public $customer_id = null;

    #[Validate('required|exists:users,id')]
    public $user_id = null;

    #[Validate('required|date')]
    public $sale_date = '';

    #[Validate('required|numeric|min:0')]
    public $total_amount = 0.00;

    #[Validate('nullable')]
    public $details = '';

    public function set($id)
    {
        $model = Sale::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->customer_id = $model->customer_id;
            $this->user_id = $model->user_id;
            $this->sale_date = $model->sale_date;
            $this->total_amount = $model->total_amount;
            $this->details = $model->details;
        }
    }

    public function store()
    {
        $this->validate();
        Sale::create($this->all());
        session()->flash('message', 'Venta creada correctamente.');
        return redirect('/ventas/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Sale::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Venta actualizada correctamente.');
            return redirect('/ventas/listado');
        }
    }

    public function delete($id)
    {
        $model = Sale::find($id);
        if ($model) {
            $model->delete();
            // $model->forceDelete();
            session()->flash('message', 'Venta eliminada correctamente.');
        }
        return redirect('/ventas/listado');
    }

    public function resetForm()
    {
        $this->reset(['customer_id', 'user_id', 'sale_date', 'total_amount', 'details']);
    }

    protected function messages()
    {
        return [
            'customer_id.required' => 'El cliente es obligatorio.',
            'customer_id.exists' => 'El cliente seleccionado no existe.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'sale_date.required' => 'La fecha de venta es obligatoria.',
            'sale_date.date' => 'La fecha de venta debe ser una fecha válida.',
            'total_amount.required' => 'El monto total es obligatorio.',
            'total_amount.numeric' => 'El monto total debe ser un número.',
            'total_amount.min' => 'El monto total no puede ser negativo.',
        ];
    }
}
