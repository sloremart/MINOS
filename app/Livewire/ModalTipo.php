<?php

namespace App\Livewire;

use Livewire\Component;

class ModalTipo extends Component
{
    public $nombre_uni;
    public $abreviatura;
    public $id;
    public $estatus;
    protected $listeners = ['editarTipologia'];

    public function guardarTipologia()
    {
        $this->dispatch('eventoGuardarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus,
            'id' => $this->id
        ])->to('tipologias-component');
    }
    
    public function editarTipologia($data)
    {
        $this->nombre_uni = $data['nombre_uni'];
        $this->abreviatura = $data['abreviatura'];
        $this->estatus = $data['estatus'];
        $this->id = $data['id'];
    }
    

    public function render()
    {
        return view('livewire.tipologia.modal-tipo');
    }
}


