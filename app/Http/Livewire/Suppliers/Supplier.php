<?php

namespace App\Http\Livewire\Suppliers;

use Livewire\Component;

class Supplier extends Component
{
    public function render()
    {
        return view('livewire.suppliers.supplier')
            ->layout('layouts.app'); // Asegúrate de que usa el layout correcto
    }
}
