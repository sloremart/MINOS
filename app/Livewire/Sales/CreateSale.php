<?php
namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\Customer;

class CreateSale extends Component
{
    public $selectedCustomer;
    public $customerName;
    public $customers;

    public function mount()
    {
        // Cargar todos los clientes para mostrarlos en el select
        $this->customers = Customer::all();
    }

    public function render()
    {
        return view('livewire.sales.create-sale');
    }
}
