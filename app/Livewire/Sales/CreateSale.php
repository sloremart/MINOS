<?php

namespace App\Livewire\Sales;

use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\ProductForm;
use App\Livewire\SaleDetails\SaleDetail;
use App\Models\Inventory;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Product;

class CreateSale extends Component
{
    public $modelForm = [
        'customer_id' => null,
        'sale_date' => null,
        'total_amount' => null,
        'details' => null,
    ];

    public $customers;
    public CustomerForm $customer;
    public $unitName;
    public $vatPercentage;

    public $isModalOpen = false;
    public $total;
    public $paymentMethod;
    public $subtotal;
    public $vat;
    public ProductForm $selectedProduct;
    public $selectedProducts;

    public $search = '';
    public $search_1 = '';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por código';
    public $isCashModalOpen = false;
    public $cashGiven = 0;
    public $change = 0;



    public $billQuantities = [
        100000 => 0,
        50000 => 0,
        20000 => 0,
        10000 => 0,
        5000 => 0,
        2000 => 0,
    ];

    public $coinQuantities = [
        1000 => 0,
        500 => 0,
        200 => 0,
        100 => 0,
        50 => 0,
    ];
    public function updatedCashGiven($value)
    {
        // Actualiza el valor recibido y calcula el cambio
        $this->cashGiven = $value;
        $this->calculateChange();
    }
    public function updatedBillQuantities()
    {
        $this->calculateTotalCash();
    }

    public function updatedCoinQuantities()
    {
        $this->calculateTotalCash();
    }
    public function calculateTotalCash()
    {
        // Calcula la cantidad total de dinero en efectivo recibida
        $this->cashGiven = 0;

        // Suma de los billetes
        foreach ($this->billQuantities as $bill => $quantity) {
            $this->cashGiven += $bill * $quantity;
        }

        // Suma de las monedas
        foreach ($this->coinQuantities as $coin => $quantity) {
            $this->cashGiven += $coin * $quantity;
        }

        // Calcula el cambio
        $this->calculateChange();
    }

    // public function calculateChange()
    // {
    //     // Calcula el cambio a devolver
    //     $this->change = $this->cashGiven - $this->total;
        
    // }
    public function calculateChange()
{
    // Asegúrate de que los valores sean numéricos, incluso si están vacíos
    $total = is_numeric($this->total) ? $this->total : 0;
    $cashGiven = is_numeric($this->cashGiven) ? $this->cashGiven : 0;

    // Calcula el cambio a devolver
    $this->change = $cashGiven - $total;
}


    
    
    public function mount()
    {
        $this->customers = Customer::all();
        $this->selectedProducts = [];
        $this->paymentMethod = '';
    }

    public function submitForm()
    {

        if ($this->customer->id != "") {

            $sale = \App\Models\Sale::create([
                'customer_id' => $this->customer->id,
                'user_id' => auth()->user()->id,
                'sale_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'total_amount' => $this->total,
                'payment_method' => $this->paymentMethod,
            ]);
            foreach ($this->selectedProducts as $item) {
                \App\Models\SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['number'],
                    'unit_price' => $item['price'],
                    'sub_total' => $item['subtotal']
                ]);
                $inventory = Inventory::whereUserId(auth()->user()->id)->whereProductId($item['id'])->first();
                $inventory->quantity = $inventory->quantity - $item['number'];
                $inventory->last_updated_date = Carbon::now()->format('Y-m-d');
                $inventory->save();
            }
            return redirect('/ventas/listado');
        }
    }

    public function updatedPaymentMethod($value)
    {
        // Abre el modal de efectivo cuando se selecciona "Efectivo"
        if ($value === 'efectivo') {
            $this->isCashModalOpen = true;
        } else {
            $this->isCashModalOpen = false;
        }
    }

    public function closeCashModal()
    {
        $this->isCashModalOpen = false;
        $this->cashGiven = 0;
        $this->change = 0;
        $this->billQuantities = array_fill_keys(array_keys($this->billQuantities), 0); // Reiniciar cantidades de billetes
        $this->coinQuantities = array_fill_keys(array_keys($this->coinQuantities), 0); // Reiniciar cantidades de monedas
    }



    public function updatedCustomer()
    {
        if ($this->customer->id == "") {
            $this->customer->resetForm();
            return;
        }
        $this->customer->set($this->customer->id);
    }
    public function updatedSelectedProductNumber()
    {
        $this->selectedProduct->subtotal = (int)$this->selectedProduct->price * (int)$this->selectedProduct->number;
        $this->selectedProduct->total = ((int)$this->selectedProduct->subtotal * (int)$this->vatPercentage / 100) + (int)$this->selectedProduct->subtotal;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedProduct->resetForm();
    }




    public function render()
    {
        $paymentMethods = config('payment_methods.methods');


        return view('livewire.sales.create-sale', [
            'data' => $this->getData(),
            'paymentMethods' => $paymentMethods,
        ])->layout('layouts.app');
    }

    public function addProductToSale($productId)
    {
        $this->selectedProduct->set($productId);
        $product = Product::find($productId);
        $this->unitName = $product->unit->name;
        $this->vatPercentage = $product->vatPercentage->percentage;
        $this->isModalOpen = true;
    }
    public function confirmAddProductToSale()
    {
        $this->selectedProducts[] = $this->selectedProduct->toArray();
        $this->selectedProduct->resetForm();
        $this->calculateAmount();
        $this->closeModal();
    }
    public function calculateAmount()
    {
        $this->total = 0;
        $this->subtotal = 0;
        foreach ($this->selectedProducts as $item) {
            $this->subtotal = $this->subtotal + $item['subtotal'];
            $this->total = $this->total + $item['total'];
        }
        $this->vat = $this->total - $this->subtotal;
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

        public function cancel(){
            return redirect('/ventas/listado');
        }
}
