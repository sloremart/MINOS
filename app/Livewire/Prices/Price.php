<?php
// COMPONENTE ENCARGADO DE RENDERIZAR Y TRAER LA INFORAMCION A LA VISTA DE PRECIOS

namespace App\Livewire\Prices;

use App\Models\Product;
use App\Models\Subgroup;
use App\Models\Unit;
use App\Models\VatPercentage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Traits\CrudModelsTrait;
use App\Livewire\Forms\PriceForm;
use Livewire\WithPagination;

class Price extends Component
{
    use CrudModelsTrait;

    public PriceForm $modelForm;
    public $products;
    public $product;
    use WithPagination;
    public $search = '';
    public $search_1 = '';
    public $search_field = 'created_at';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por fecha';
    public $search_1_placeholder = null;

    public function mount(Product $product = null)
    {
        $this->product = $product;
        $this->products = Product::all();
    }
    public function updating($field)
    {
        $this->resetPage();
    }
    public function getData()
    {
        if ($this->product){
            $query = $this->product->prices();
        } else{
            $query = \App\Models\Price::query();
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

    public function render()
    {
        return view('livewire.prices.price', [
            "data" => $this->getData()
        ])->layout('layouts.app');
    }
}
