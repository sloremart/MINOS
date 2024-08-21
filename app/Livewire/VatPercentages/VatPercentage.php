<?php

namespace App\Livewire\VatPercentages;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\VatPercentageForm;

class VatPercentage extends Component
{
    use CrudModelsTrait;

    public VatPercentageForm $modelForm;

    public function getData()
    {
        $data = \App\Models\VatPercentage::all();
        return $data;
    }

    public function render()
    {
        return view('livewire.vat-percentages.vat-percentage', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
