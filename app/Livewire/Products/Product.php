<?php
// COMPONENTE ENCARGADO DE RENDERIZAR Y TRAER LA INFORAMCION A LA VISTA DE PRODUCTOS

namespace App\Livewire\Products;

use App\Livewire\Forms\InventoryForm;
use App\Livewire\Forms\PriceForm;
use App\Models\Subgroup;
use App\Models\Unit;
use App\Models\VatPercentage;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\ProductForm;
use Livewire\WithPagination;

class Product extends Component
{
    use CrudModelsTrait;

    public ProductForm $modelForm;
    public PriceForm $priceForm;
    public InventoryForm $inventoryForm;
    public $vatPercentages;
    public $units;
    public $subgroups;
    use WithPagination;
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
        $query = \App\Models\Product::query();
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        $data = $query->paginate(10);
        return $data;
    }

    public function mount()
    {
        $this->vatPercentages = VatPercentage::all();
        $this->units = Unit::all();
        $this->subgroups = Subgroup::all();
    }


    public function render()
    {
        return view('livewire.products.product', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
