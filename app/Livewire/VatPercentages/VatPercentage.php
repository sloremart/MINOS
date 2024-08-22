<?php

namespace App\Livewire\VatPercentages;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\VatPercentageForm;
use Livewire\WithPagination;

class VatPercentage extends Component
{
    use CrudModelsTrait;

    public VatPercentageForm $modelForm;
    use WithPagination;

    public $groups;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por codigo';

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        $query = \App\Models\VatPercentage::query();
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }

    public function render()
    {
        return view('livewire.vat-percentages.vat-percentage', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
