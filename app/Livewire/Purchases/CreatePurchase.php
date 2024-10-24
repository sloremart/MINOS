<?php

namespace App\Livewire\Purchases;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Inventory;
use Carbon\Carbon;
use Livewire\Component;

class CreatePurchase extends Component
{
    public $modelForm = [
        'supplier_id' => null,
        'purchase_date' => null,
        'total_amount' => 0,
        'details' => null,
    ];

    public $suppliers;
    public $selectedSupplier = null; // Proveedor seleccionado
    public $unitName;
    public $payment_method; //////agregue este campo payment_method
    public $selectedProducts = [];
    public $selectedProduct;
    public $selectedProductQuantity = 1;
    public $selectedProductPrice = 0; // Precio unitario de compra
    public $isModalOpen = false;
    public $total = 0;
    public $subtotal = 0;
    public $vat = 0;
    public $search = '';
    public $search_1 = '';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por código';

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->selectedProducts = [];
    }

    public function updatedModelFormSupplierId($supplierId)
    {
        // Actualiza el proveedor seleccionado cuando se cambia el ID del proveedor en el select
        $this->selectedSupplier = Supplier::find($supplierId);
    }

    public function submitForm()
    {
        if ($this->modelForm['supplier_id']) {
            $purchase = Purchase::create([
                'supplier_id' => $this->modelForm['supplier_id'],
                'user_id' => auth()->user()->id,
                'purchase_date' => Carbon::now()->format('Y-m-d'),
                'total_amount' => $this->total,
                'payment_method' => $this->payment_method,//////agregue este campo payment_method
                'details' => $this->modelForm['details'],
            ]);

            foreach ($this->selectedProducts as $item) {
                PurchaseDetail::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['number'],
                    'unit_price' => $item['price'],  // Precio de compra
                    'sub_total' => $item['subtotal'],
                ]);

                // Actualizar inventario
                $inventory = Inventory::whereProductId($item['id'])->first();
                $inventory->quantity += $item['number']; // Sumar al inventario
                $inventory->last_updated_date = Carbon::now()->format('Y-m-d');
                $inventory->save();
            }

            return redirect('/compras/listado');
        }
    }

    public function addProductToPurchase($productId)
    {
        $this->selectedProduct = Product::find($productId);
        $this->unitName = $this->selectedProduct->unit->name;
        $this->isModalOpen = true; // Abre el modal para añadir cantidad y precio
        $this->selectedProductQuantity = 1; // Restablecer la cantidad por defecto
        $this->selectedProductPrice = 0; // Restablecer el precio por defecto
    }

    public function confirmAddProductToPurchase()
    {
        // Calcular subtotal con el precio ingresado
        $subtotal = $this->selectedProductQuantity * $this->selectedProductPrice;

        $this->selectedProducts[] = [
            'id' => $this->selectedProduct->id,
            'name' => $this->selectedProduct->name,
            'number' => $this->selectedProductQuantity,
            'price' => $this->selectedProductPrice,
            'subtotal' => $subtotal,
        ];

        $this->calculateAmount();
        $this->closeModal();
    }

    public function calculateAmount()
    {
        $this->subtotal = 0;
        $this->total = 0;
        foreach ($this->selectedProducts as $item) {
            $this->subtotal += $item['subtotal'];
            $this->total += $item['subtotal'];
        }
        $this->vat = $this->total - $this->subtotal;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedProduct = null;
    }

    public function getData()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where('code', 'like', '%' . $this->search_1 . '%');
        }

        return $query->paginate(10);
    }

    public function render()
    {
        return view('livewire.purchases.create-purchase', [
            'data' => $this->getData(),
        ])->layout('layouts.app');
    }

    public function cancel(){
        return redirect('/compras/listado');
    }
}
