<?php

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
use Illuminate\Support\Facades\Auth;

class Product extends Component
{
    use CrudModelsTrait;
    use WithPagination;

    public ProductForm $modelForm;
    public PriceForm $priceForm;
    public InventoryForm $inventoryForm;
    public $vatPercentages;
    public $units;
    public $subgroups;

    public $search = '';
    public $search_1 = '';
    public $search_field = 'name';
    public $search_1_field = 'code';
    public $search_placeholder = 'Buscar por nombre';
    public $search_1_placeholder = 'Buscar por código';

    public function updating($field)
    {
        $this->resetPage(); // Reinicia la paginación al actualizar los filtros de búsqueda
    }

    public function getData()
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::id(); // ID del usuario actualmente autenticado

        // Filtrar productos del usuario autenticado
        $query = \App\Models\Product::where('user_id', $userId);

        // Agregar condiciones de búsqueda si se especifican
        if ($this->search) {
            $query->where($this->search_field, 'like', '%' . $this->search . '%');
        }

        if ($this->search_1) {
            $query->where($this->search_1_field, 'like', '%' . $this->search_1 . '%');
        }

        // Obtener los datos paginados
        return $query->paginate(10);
    }

    public function mount()
    {
        $this->vatPercentages = VatPercentage::all(); // Porcentajes de IVA disponibles
        $this->units = Unit::all(); // Unidades disponibles
        $this->subgroups = Subgroup::all(); // Subgrupos disponibles
    }

    public function render()
    {
        return view('livewire.products.product', [
            "data" => $this->getData(), // Pasar los datos a la vista
        ])->layout('layouts.app');
    }
}
