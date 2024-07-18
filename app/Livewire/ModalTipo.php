<?php

namespace App\Livewire;

use Livewire\Component;

class ModalTipo extends Component
{
    public $nombre_uni;
    public $abreviatura;
    public $id;
    public $estatus;

    public function guardarTipologia()
    {
        $this->dispatch('eventoGuardarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus,
            'id' => $this->id
        ])->to('tipologias-component');
    }
    

    public function render()
    {
        return view('livewire.tipologia.modal-tipo');
    }
}


