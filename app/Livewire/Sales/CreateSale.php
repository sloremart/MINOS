<?php
namespace App\Livewire\Sales;

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
    public $clientsid;
    public $selectedCustomerData = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'address' => '',
    ];

    public $isModalOpen = false;
    public $quantity = 1;
    public $price;
    public $selectedProduct;
    public $selectedProducts = [];

    public $search = '';
    public $search_1 = '';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por código';

    public function mount()
    {
        $this->customers = Customer::all();
    }

    public function updatedClientsid($clientId)
    {
        $this->updateClient($clientId);
    }

    public function updateClient($clientId)
    {
        $customer = Customer::find($clientId);
        if ($customer) {
            $this->selectedCustomerData = [
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
            ];
        } else {
            $this->resetSelectedCustomerData();
        }
    }

    private function resetSelectedCustomerData()
    {
        $this->selectedCustomerData = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'address' => '',
        ];
    }



    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->quantity = 1;
        $this->price = null;
        $this->selectedProduct = null;
    }

    public function render()
    {
        return view('livewire.sales.create-sale', [
            'data' => $this->getData(),
            'search_placeholder' => $this->search_placeholder,
            'search_1_placeholder' => $this->search_1_placeholder,
        ])->layout('layouts.app');
    }
    public function addProductToSale($productId)
    {
        $this->selectedProduct = Product::find($productId);

        if ($this->selectedProduct) {
            $this->price = $this->selectedProduct->activePrice->price ?? 0;
        } else {
            $this->price = 0;
        }

        $this->isModalOpen = true;
    }
    public function confirmAddProductToSale()
    {
        if ($this->selectedProduct && $this->quantity > 0) {
            $this->selectedProducts[] = [
                'id' => $this->selectedProduct->id,
                'name' => $this->selectedProduct->name,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'subtotal' => $this->quantity * $this->price
            ];
        }

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
