<?php
namespace App\Livewire\Sales;

use App\Livewire\Forms\CustomerForm;
use App\Livewire\Forms\ProductForm;
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
    public $quantity = 1;
    public $price;
    public ProductForm $selectedProduct;
    public $selectedProducts;

    public $search = '';
    public $search_1 = '';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por código';

    public function mount()
    {
        $this->customers = Customer::all();
        $this->selectedProducts = [];
    }
    public function submitForm()
    {
        dd($this->selectedProducts);
    }

    public function updatedCustomer()
    {
        if($this->customer->id == ""){
            $this->customer->resetForm();
            return;
        }
        $this->customer->set($this->customer->id);
    }
    public function updatedSelectedProductNumber()
    {
        $this->selectedProduct->subtotal = (int)$this->selectedProduct->price*(int)$this->selectedProduct->number;
        $this->selectedProduct->total = ((int)$this->selectedProduct->subtotal * (int)$this->vatPercentage/100) + (int)$this->selectedProduct->subtotal;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedProduct->resetForm();
    }

    public function render()
    {
        return view('livewire.sales.create-sale', [
            'data' => $this->getData(),
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
        $this->selectedProducts[]=$this->selectedProduct->toArray();
        $this->selectedProduct->resetForm();
        $this->closeModal();
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
}
