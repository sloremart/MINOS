<?php
// ----------->FUNCIONES PRINCIPALES DEL COMPONENTE DE CREAR EL PRODUCTO EN EL INVENTARIO PERMITE CREAR ,ELIMINAR,EDITAR Y CONSULTAR LOS PRODUCTO EN EL INVENTARIO  REGISTRADOS EN EL SISTEMA<------------------////
namespace App\Livewire\Forms;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InventoryForm extends Form
{
    public $id = null;

    #[Validate('required|exists:products,id')]
    public $product_id = null;

    #[Validate('required|integer|min:0')]
    public $quantity = 0;

    #[Validate('required|exists:users,id')]
    public $user_id = null;

    public function set($id)
    {
        $model = Inventory::find($id);
        if ($model) {
            $this->id = $model->id;
            $this->product_id = $model->product_id;
            $this->quantity = $model->quantity;
            $this->user_id = $model->user_id;
        }
    }

    public function store()
    {
        $this->validate();
        Inventory::create($this->all());
        session()->flash('message', 'Inventario creado correctamente.');
        return redirect('/inventarios/listado');
    }

    public function edit()
    {
        $this->validate();
        $model = Inventory::find($this->id);
        if ($model) {
            $model->update($this->all());
            session()->flash('message', 'Inventario actualizado correctamente.');
            return redirect('/inventarios/listado');
        }
    }

    public function delete($id)
    {
        $model = Inventory::find($id);
        if ($model) {
            $model->forceDelete();
            // $model->delete();
            session()->flash('message', 'Inventario eliminado correctamente.');
        }
        return redirect('/inventarios/listado');
    }

    public function resetForm()
    {
        $this->reset(['product_id', 'quantity', 'user_id']);
    }

    protected function messages()
    {
        return [
            'product_id.required' => 'El producto es obligatorio.',
            'product_id.exists' => 'El producto seleccionado no existe.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad no puede ser negativa.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
        ];
    }
}
