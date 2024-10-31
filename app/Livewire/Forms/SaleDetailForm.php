<?php
// --------------->EL COMPONENTE DE DETALLE DE LA VENTA ESTA LIGADO CON EL MODULO DE VENTA  GRACIAS A ESTE COMPONENTE NOS PERMITE EXTRAER REPORTES DE LAS VENTAS DEL DIA A DIA , ESTE COMPONENTE ESTA UNIFICADO CON EL COMPONENTE  PRINCIPAL DE VENTA (SaleFrom) CUYAS FUNCIONE ESTAN COMPARTIDAS CON  ESTE COMPONENTRE<----------------------///
namespace App\Livewire\Forms;

use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SaleDetailForm extends Form
{
    public $id = null;

    #[Validate('required|exists:sales,id')]
    public $sale_id = null;

    #[Validate('required|exists:products,id')]
    public $product_id = null;

    #[Validate('required|integer|min:1')]
    public $quantity = 1;

    #[Validate('required|numeric|min:0')]
    public $unit_price = 0.00;

    #[Validate('required|numeric|min:0')]
    public $sub_total = 0.00;

    public function set($id)
    {
        $model = SaleDetail::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->sale_id = $model->sale_id;
            $this->product_id = $model->product_id;
            $this->quantity = $model->quantity;
            $this->unit_price = $model->unit_price;
            $this->sub_total = $model->sub_total;
        }
    }

    public function store()
    {
        $this->validate();
        SaleDetail::create($this->all());
        session()->flash('message', 'Detalle de venta creado correctamente.');
        return redirect('/ventas/detalles');
    }

    public function edit()
    {
        $this->validate();
        $model = SaleDetail::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Detalle de venta actualizado correctamente.');
            return redirect('/ventas/detalles');
        }
    }

    public function delete($id)
    {
        $model = SaleDetail::find($id);
        if ($model) {
            $model->delete();
            session()->flash('message', 'Detalle de venta eliminado correctamente.');
        }
        return redirect('/ventas/detalles');
    }

    public function resetForm()
    {
        $this->reset(['sale_id', 'product_id', 'quantity', 'unit_price', 'sub_total']);
    }

    protected function messages()
    {
        return [
            'sale_id.required' => 'La venta es obligatoria.',
            'sale_id.exists' => 'La venta seleccionada no existe.',
            'product_id.required' => 'El producto es obligatorio.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad debe ser al menos 1.',
            'unit_price.required' => 'El precio unitario es obligatorio.',
            'unit_price.numeric' => 'El precio unitario debe ser un número.',
            'unit_price.min' => 'El precio unitario no puede ser negativo.',
            'sub_total.required' => 'El subtotal es obligatorio.',
            'sub_total.numeric' => 'El subtotal debe ser un número.',
            'sub_total.min' => 'El subtotal no puede ser negativo.',
        ];
    }
}
