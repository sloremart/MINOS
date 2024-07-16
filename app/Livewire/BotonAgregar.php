<?php
// ESTE COMPONENTE SE ENCARGAR DE RENDERIZAR LOS BOTONES  PARA AGREGAR INFORACION   AGREGAR 
namespace App\Livewire;

use Livewire\Component;

class BotonAgregar extends Component
{
    public function render()
    {
        return view('livewire.botones.btn_normal.boton-agregar');
    }
}
