<?php
// C:\laragon\www\MINOS\app\Livewire\TipologiasComponent.php
namespace App\Http\Livewire\Tipologia;

use App\Models\Tipologias;
use Livewire\Component;
use Livewire\WithPagination;

class TipologiasComponent extends Component
{
   
    // Reglas de validación
    

    public function render()
{
    return view('livewire.tipologia.tipologias-component')
    ->layout('layouts.app'); 
}


  
   
}
