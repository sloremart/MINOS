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

    // protected $rules = [
    //     'nombre_uni' => 'required|string|max:100',
    //     'abreviatura' => 'required|string|max:20',
    //     'estatus' => 'required|string|max:20',
    // ];

    public function guardarTipologia()
    {
        // $this->validate();
        $this->dispatch('eventoGuardarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus,
            'id' => $this->id
        ])->to('tipologias-component');
    }
    public function updateTipologia()
    {
        // $this->validate();
        $this->dispatch('eventoupdateTipologia', [
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
