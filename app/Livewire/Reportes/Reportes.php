<?php

namespace App\Livewire\Reportes;

use Livewire\Component;
use App\Traits\CrudModelsTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Price;
use Illuminate\Support\Facades\DB;



class Reportes extends Component
{
    use WithFileUploads;
    use CrudModelsTrait;
    use WithPagination;

    public $search = ''; // Fecha de inicio
    public $search_1 = ''; // Fecha de fin
    public $search_placeholder = 'Fecha inicio';
    public $search_1_placeholder = 'Fecha fin';
    private $paginacion = 4;

    public function updating($field)
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {

        // $query = DB::table('sale_details')
        //     ->join('products', 'sale_details.product_id', '=', 'products.id')
        //     ->select('products.name', 'sale_details.unit_price', 'sale_details.created_at');
        $query = SaleDetail::join('products', 'sale_details.product_id', '=', 'products.id')
        ->select('products.name', 'sale_details.unit_price', 'sale_details.created_at');

    // Verifica la consulta inicial
    dd($query->get());
        // Aplica filtro por fecha de inicio
        if ($this->search) {
            $query->where('sale_details.created_at', '>=', $this->search);
        }

        // Aplica filtro por fecha de fin
        if ($this->search_1) {
            $query->where('sale_details.created_at', '<=', $this->search_1);
        }
        
        // Pagina los resultados
        $data = $query->paginate($this->paginacion);


        // Retorna la vista con los datos paginados
        return view('livewire.reportes.reportes', [
            'data' => $data,
        ])->layout('layouts.app');
    }
}
