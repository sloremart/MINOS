<?php
namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;

class SaleForm extends Component
{
    public $isOpen = false;
    public $products;
    public $search = '';
    public $selectedProduct = null;
    public $id;
    public $forma_pago, $cliente, $nombre_cliente, $direccion_cliente, $telefono_cliente;
    public $codigo_articulo, $nombre_articulo, $tipo_unidad, $cantidad;
    public $valor_unitario, $iva, $observaciones;

    public function mount(): void
    {
        $this->products = Product::all();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.forms.sale-form', [
            'sales' => Sale::all(),
            'products' => Product::where('nombre_producto', 'like', '%' . $this->search . '%')->get(),
        ])->layout('layouts.app');
    }

    public function updatedSelectedProduct(): void
    {
        $product = Product::find($this->selectedProduct);
        if ($product) {
            $this->codigo_articulo = $product->codigo_producto;
            $this->nombre_articulo = $product->nombre_producto;
            $this->tipo_unidad = $product->tipo_unidad;
            $this->valor_unitario = $product->valor_venta;
        }
    }

    public function create(): void
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal(): void
    {
        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    private function resetInputFields(): void
    {
        $this->forma_pago = '';
        $this->cliente = '';
        $this->nombre_cliente = '';
        $this->direccion_cliente = '';
        $this->telefono_cliente = '';
        $this->codigo_articulo = '';
        $this->nombre_articulo = '';
        $this->tipo_unidad = '';
        $this->cantidad = '';
        $this->valor_unitario = '';
        $this->iva = '';
        $this->observaciones = '';
        $this->id = null;
        $this->selectedProduct = null;
    }

    public function store(): void
    {
        $this->validate([
            'forma_pago' => 'required',
            'cliente' => 'required',
            'nombre_cliente' => 'required',
            'direccion_cliente' => 'required',
            'telefono_cliente' => 'required',
            'codigo_articulo' => 'required',
            'nombre_articulo' => 'required',
            'tipo_unidad' => 'required',
            'cantidad' => 'required|numeric|min:1',
            'valor_unitario' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        Sale::updateOrCreate(
            ['id' => $this->id],
            [
                'forma_pago' => $this->forma_pago,
                'cliente' => $this->cliente,
                'nombre_cliente' => $this->nombre_cliente,
                'direccion_cliente' => $this->direccion_cliente,
                'telefono_cliente' => $this->telefono_cliente,
                'codigo_articulo' => $this->codigo_articulo,
                'nombre_articulo' => $this->nombre_articulo,
                'tipo_unidad' => $this->tipo_unidad,
                'cantidad' => $this->cantidad,
                'valor_unitario' => $this->valor_unitario,
                'iva' => $this->iva,
                'observaciones' => $this->observaciones,
            ]
        );

        $this->closeModal();
        session()->flash('message', 'Venta creada correctamente.');
    }
}
