<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\VatPercentage;
use App\Models\Unit;
use App\Models\Subgroup;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public $id = null;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('unique:products,code')]
    public $code = '';
    #[Validate('unique:products,code')]

    #[Validate('nullable')]
    public $description = '';

    #[Validate('required')]
    public $price = '';
    //#[Validate('required')]
    public $total = '';
   // #[Validate('required')]
    public $subtotal = '';
    #[Validate('required')]
    public $quantity ='';
    //#[Validate('required|numeric|lt:quantity')]
    public $number = '';
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
            $this->price = $model->activePrice ? $model->activePrice->price : '';
            $this->quantity = 0;
            $this->subgroup_id = $model->subgroup_id;
            $this->number = 1;
            $this->subtotal = $this->number * $this->price;
            $this->total = $this->subtotal + (($this->subtotal*$model->vatPercentage->percentage/100));
        }
    }

    public function store()
    {
        $this->validate();
        $product = new Product();
        $product->name = $this->name;
        $product->description = $this->description;
        $product->applies_iva = $this->applies_iva;
        $product->vat_percentage_id = $this->vat_percentage_id;
        $product->unit_id = $this->unit_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->subgroup_id = $this->subgroup_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;
        $product->save();

        session()->flash('message', 'Producto creado correctamente.');
        return redirect('/productos/listado');
    }

    public function edit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'code' => 'required|min:3|unique:products,code,' . $this->id, // Ignora el registro actual en la validación de unicidad
            'description' => 'nullable|min:5',
            'price' => 'required|numeric|min:0', // Asegúrate de que el precio sea un número válido
            'quantity' => 'required|integer|min:0', // Asegúrate de que la cantidad sea un entero no negativo
            'unit_id' => 'required|exists:units,id', // Verifica que el unit_id exista en la tabla de unidades
            'subgroup_id' => 'required|exists:subgroups,id', // Verifica que el subgroup_id exista en la tabla de subgrupos
        ]);
        $model = Product::find($this->id);
        if ($model) {
            $model->name = $this->name;
            $model->description = $this->description;
            $model->applies_iva = $this->applies_iva;
            $model->vat_percentage_id = $this->vat_percentage_id;
            $model->unit_id = $this->unit_id;
            $model->price = $this->price;
            $model->quantity = $this->quantity;
            $model->subgroup_id = $this->subgroup_id;
            $model->updated_at = Carbon::now();
            $model->price = $this->price;
            $model->quantity = $this->quantity;
            $model->update();
            session()->flash('message', 'Producto actualizado correctamente.');
            return redirect('/productos/listado');
        }
    }

    public function delete($id)
    {
        $model = Product::find($id);
        if ($model) {
            // $model->forceDelete();
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
            'number.required' => 'El código es obligatorio.',
            'number.lt' => 'La cantidad debe ser menor al stock disponible.',
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
