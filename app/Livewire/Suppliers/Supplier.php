<?php

namespace App\Livewire\Suppliers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Supplier extends Component
{
    public function getData()
    {
        $user = Auth::user();
        return $user->suppliers;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.suppliers.supplier', [
        "data" => $this->getData()
        ])->layout('layouts.app');
        // return view('livewire.suppliers.supplier', [
        //     'data' => $this->getData()
        // ]);
    }
    
}
