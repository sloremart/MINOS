<?php

namespace App\Livewire\SaleDetails;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SaleDetailForm;

class SaleDetail extends Component
{
    use CrudModelsTrait;

    public SaleDetailForm $modelForm;

    public function getData()
    {
        $data = \App\Models\SaleDetail::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.sale-details.sale-detail', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
