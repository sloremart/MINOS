<?php
// --------->ESTE COMPONENTE  PERMITE TENER LOS REGISTROS DE LOS PRECIOS DE CADA PRODUCTO TIENE FUNCIONES DE CREAR, ELIMINAR Y EDITAR LOS REGISTROS <-----------//
namespace App\Livewire\Forms;

use App\Models\Price;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PriceForm extends Form
{
    public $id = null;

    #[Validate('required|exists:products,id')]
    public $product_id = null;

    #[Validate('required|exists:users,id')]
    public $user_id = null;

    #[Validate('required|numeric|min:0')]
    public $price = 0.00;

    #[Validate('required|boolean')]
    public $active = false;

    #[Validate('required|date')]
    public $valid_from_date = '';

    public function set($id)
    {
        $model = Price::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->product_id = $model->product_id;
            $this->user_id = $model->user_id;
            $this->price = $model->price;
            $this->active = $model->active;
            $this->valid_from_date = $model->valid_from_date;
        }
    }

    public function store()
    {
        $this->validate();
        Price::create($this->all());
        session()->flash('message', 'Precio creado correctamente.');
        // return redirect('/precios/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Price::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Precio actualizado correctamente.');
            // return redirect('/precios/listado');
        }
    }

    public function delete($id)
    {
        $model = Price::find($id);
        if ($model) {
            $model->forceDelete();
            // $model->delete();
            session()->flash('message', 'Precio eliminado correctamente.');
        }
        // return redirect('/precios/listado');
    }

    public function resetForm()
    {
        $this->reset(['product_id', 'user_id', 'price', 'active', 'valid_from_date']);
    }

    protected function messages()
    {
        return [
            'product_id.required' => 'El producto es obligatorio.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'active.required' => 'Debes indicar si el precio está activo.',
            'valid_from_date.required' => 'La fecha de inicio de vigencia es obligatoria.',
            'valid_from_date.date' => 'La fecha de inicio de vigencia debe ser una fecha válida.',
        ];
    }
}
