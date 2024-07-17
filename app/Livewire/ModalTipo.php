<?php

namespace App\Livewire;

use Livewire\Component;

class ModalTipo extends Component
{
    public $nombre_uni;
    public $abreviatura;

    public function guardarTipologia()
    {
        $this->dispatch('eventoGuardarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura
        ])->to('tipologias-component');
    }

    public function render()
    {
        return view('livewire.tipologia.modal-tipo');
    }
}


