<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\VatPercentage;
use App\Models\Unit;
use App\Models\Subgroup;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|unique:products,code')]
    public $code = '';

    #[Validate('nullable')]
    public $description = '';

    #[Validate('required|boolean')]
    public $applies_iva = false;

    #[Validate('required|exists:vat_percentages,id')]
    public $vat_percentage_id = null;

    #[Validate('required|exists:units,id')]
    public $unit_id = null;

    #[Validate('required|exists:subgroups,id')]
    public $subgroup_id = null;

    public function set($id)
    {
        $model = Product::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->name = $model->name;
            $this->code = $model->code;
            $this->description = $model->description;
            $this->applies_iva = $model->applies_iva;
            $this->vat_percentage_id = $model->vat_percentage_id;
            $this->unit_id = $model->unit_id;
            $this->subgroup_id = $model->subgroup_id;
        }
    }

    public function store()
    {
        $this->validate();
        Product::create($this->all());
        session()->flash('message', 'Producto creado correctamente.');
        return redirect('/productos/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Product::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Producto actualizado correctamente.');
            return redirect('/productos/listado');
        }
    }

    public function delete($id)
    {
        $model = Product::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Producto eliminado correctamente.');
        }
        return redirect('/productos/listado');
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'description', 'applies_iva', 'vat_percentage_id', 'unit_id', 'subgroup_id']);
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'code.required' => 'El código es obligatorio.',
            'code.unique' => 'El código ya está registrado.',
            'applies_iva.required' => 'Debes indicar si aplica IVA.',
            'vat_percentage_id.required' => 'El porcentaje de IVA es obligatorio.',
            'vat_percentage_id.exists' => 'El porcentaje de IVA seleccionado no existe.',
            'unit_id.required' => 'La unidad es obligatoria.',
            'unit_id.exists' => 'La unidad seleccionada no existe.',
            'subgroup_id.required' => 'El subgrupo es obligatorio.',
            'subgroup_id.exists' => 'El subgrupo seleccionado no existe.',
        ];
    }
}
