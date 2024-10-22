<?php

namespace App\Livewire\Forms;

use App\Models\VatPercentage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VatPercentageForm extends Form
{
    public $id = null;

    #[Validate('required|numeric|min:0|max:100')]
    public $percentage = 0.00;

    #[Validate('required|min:3')]
    public $description = '';

    public function set($id)
    {
        $model = VatPercentage::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->percentage = $model->percentage;
            $this->description = $model->description;
        }
    }

    public function store()
    {
        $this->validate();
        VatPercentage::create($this->all());
        session()->flash('message', 'Porcentaje de IVA creado correctamente.');
        // return redirect('/iva/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = VatPercentage::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Porcentaje de IVA actualizado correctamente.');
            // return redirect('/iva/listado');
        }
    }

    public function delete($id)
    {
        $model = VatPercentage::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Porcentaje de IVA eliminado correctamente.');
        }
        // return redirect('/iva/listado');
    }

    public function resetForm()
    {
        $this->reset(['percentage', 'description']);
    }

    protected function messages()
    {
        return [
            'percentage.required' => 'El porcentaje es obligatorio.',
            'percentage.numeric' => 'El porcentaje debe ser un número.',
            'percentage.min' => 'El porcentaje no puede ser menor que 0.',
            'percentage.max' => 'El porcentaje no puede ser mayor que 100.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 3 caracteres.',
        ];
    }
}
