<?php

namespace App\Livewire\SaleDetails;

use App\Models\Group;
use App\Models\Sale;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\SaleDetailForm;
use Livewire\WithPagination;

class SaleDetail extends Component
{
    use CrudModelsTrait;

    public SaleDetailForm $modelForm;

    use WithPagination;

    public $sales;
    public $sale;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'id';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por codigo';
    public $search_1_placeholder = null;

    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        if ($this->sale){
            $query = $this->sale->saleDetails();
        } else{
            $query = \App\Models\SaleDetail::query();
        }
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->pagination();
        return $data;
    }
    public function mount(Sale $sale = null)
    {
        $this->sale = $sale;
    }


    public function render()
    {
        return view('livewire.sale-details.sale-detail', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
