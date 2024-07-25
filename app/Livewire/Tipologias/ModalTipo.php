<?php

namespace App\Livewire\Tipologias;

use Livewire\Component;

class ModalTipo extends Component
{
    public $nombre_uni;
    public $abreviatura;
    public $estatus;
    public $tipologiaId;
    public $isEditMode = false;

    protected $listeners = ['editarTipologia'];

    public function guardarTipologia()
    {
        $this->dispatch('eventoGuardarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus
        ])->to('Tipologias.tipologias-component');
    }

    public function updateTipologia()
    {
        $this->dispatch('eventoupdateTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus,
            'id' => $this->tipologiaId
        ])->to('Tipologias.tipologias-component');
    }
    public function resetFields()
    {
        $this->nombre_uni = '';
        $this->abreviatura = '';
        $this->estatus = '';
        $this->tipologiaId = null;
        $this->isEditMode = false;
    }

    public function editarTipologia($data)
    {
        $this->nombre_uni = $data['nombre_uni'];
        $this->abreviatura = $data['abreviatura'];
        $this->estatus = $data['estatus'];
        $this->tipologiaId = $data['id'];
        $this->isEditMode = true;
    }

    public function render()
    {
        return view('livewire.tipologia.modal-tipo');
    }
}
