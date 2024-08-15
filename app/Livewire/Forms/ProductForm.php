<?php
namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Component;

class ProductForm extends Component
{
    public $id;
    public $isOpen = false;  // Controla si el modal está abierto o cerrado

    public $grupo_producto = '';
    public $sub_grupo_producto = '';
    public $clase_producto = '';
    public $codigo_producto = '';
    public $nombre_producto = '';
    public $presentacion = '';
    public $tipo_unidad = '';
    public $valor_venta = '';
    public $stock = '';

    protected $rules = [
        'grupo_producto' => 'required|min:3',
        'sub_grupo_producto' => 'required|min:3',
        'clase_producto' => 'required|min:3',
        'codigo_producto' => 'required|min:3|unique:products,codigo_producto',
        'nombre_producto' => 'required|min:3',
        'presentacion' => 'required|min:3',
        'tipo_unidad' => 'required|min:2',
        'valor_venta' => 'required|numeric',
        'stock' => 'required|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.forms.product-form', [
            'products' => Product::all(),
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->grupo_producto = '';
        $this->sub_grupo_producto = '';
        $this->clase_producto = '';
        $this->codigo_producto = '';
        $this->nombre_producto = '';
        $this->presentacion = '';
        $this->tipo_unidad = '';
        $this->valor_venta = '';
        $this->stock = '';
        $this->id = null;
    }

    public function store()
    {

        if ($this->id) {
            $this->rules['codigo_producto'] = 'required|min:3|unique:products,codigo_producto,' . $this->id;
        }

        $this->validate();
        Product::updateOrCreate(['id' => $this->id], $this->only([
            'grupo_producto',
            'sub_grupo_producto',
            'clase_producto',
            'codigo_producto',
            'nombre_producto',
            'presentacion',
            'tipo_unidad',
            'valor_venta',
            'stock'
        ]));

        $this->closeModal();
        session()->flash('message', $this->id ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->id = $id;
        $this->grupo_producto = $product->grupo_producto;
        $this->sub_grupo_producto = $product->sub_grupo_producto;
        $this->clase_producto = $product->clase_producto;
        $this->codigo_producto = $product->codigo_producto;
        $this->nombre_producto = $product->nombre_producto;
        $this->presentacion = $product->presentacion;
        $this->tipo_unidad = $product->tipo_unidad;
        $this->valor_venta = $product->valor_venta;
        $this->stock = $product->stock;

        $this->openModal();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
        session()->flash('message', 'Producto eliminado correctamente.');
    }
}
