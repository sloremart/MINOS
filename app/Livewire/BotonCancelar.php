<?php
// ESTE COMPONENTE SE ENCARGAR DE RENDERIZAR LOS BOTONES  PARA CANCELAR 

namespace App\Livewire;

use Livewire\Component;

class BotonCancelar extends Component
{
    public function render()
    {
        return view('livewire.botones.btn_normal.boton-cancelar');
    }
}
