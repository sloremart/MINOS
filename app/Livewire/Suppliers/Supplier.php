<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Supplier extends Component
{
    public bool $isOpen = false;
    public SupplierForm $modelForm;


    public function getData()
    {
        $data= \App\Models\Supplier::all();
        return $data;
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function edit($id)
    {
        $this->modelForm->set($id);
        $this->openModal();
    }
    public function delete($id)
    {
        $this->modelForm->delete($id);
    }
    public function submitForm()
    {

        if($this->modelForm->id != null){
            $this->modelForm->update();
        } else{
            $this->modelForm->store();
        }
        $this->closeModal();
    }


    public function closeModal()
    {
        $this->isOpen = false;
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
