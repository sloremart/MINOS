<?php
// ESTE COMPONENTE SE ENCARGAR DE RENDERIZAR LOS BOTONES  PARA EDITAR  INFORACION   

namespace App\Livewire;

use Livewire\Component;

class BotonEditar extends Component
{
    public function render()
    {
        return view('livewire.botones.btn_normal.boton-editar');
    }
}
