<?php

namespace App\Livewire\Clients;

use App\Livewire\Forms\SupplierForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Client extends Component
{
    public function getData()
    {
        $user = Auth::user();
        return $user->clients;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.clients.client', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }

}
