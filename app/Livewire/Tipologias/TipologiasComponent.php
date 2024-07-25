<?php

namespace App\Livewire\Tipologias;

use App\Models\Tipologias;
use Livewire\Component;
use Livewire\WithPagination;

class TipologiasComponent extends Component
{
    use WithPagination;

    public $buscar;
    public $isEditMode = false;
    public $tipologiaId;

    protected $listeners = [
        'eventoGuardarTipologia' => 'storetipologia',
        'eventoupdateTipologia' => 'updatetipologia',
    ];

    public function render()
    {
        $data = $this->getData();
        return view('livewire.tipologia.tipologias-component', [
            'data' => $data,
        ])->layout('layouts.app');
    }

    public function getData()
    {
        if ($this->buscar == "") {
            return Tipologias::paginate(5);
        } else {
            return Tipologias::where('nombre_uni', 'like', "%$this->buscar%")
                ->orWhere('abreviatura', 'like', "%$this->buscar%")
                ->orWhere('estatus', 'like', "%$this->buscar%")
                ->paginate(5);
        }
    }

    public function openModal($mode, $id = null)
    {
        if ($mode === 'edit') {
            $this->isEditMode = true;
            $this->edittipologia($id);
        } else {
            $this->isEditMode = false;
            $this->resetFields();
            $this->dispatch('resetModalFields');  // Emitir evento para resetear el modal
        }
    }

    public function resetFields()
    {
        $this->dispatch('resetModalFields');
    }

    public function storetipologia($data)
    {
        $tipologia = new Tipologias();
        $tipologia->nombre_uni = $data['nombre_uni'];
        $tipologia->abreviatura = $data['abreviatura'];
        $tipologia->estatus = "ACTIVO";
        $tipologia->save();

        $this->resetFields();
    }

    public function edittipologia($id)
    {
        $tipologia = Tipologias::find($id);
        $this->tipologiaId = $tipologia->id;

        $this->dispatch('editarTipologia', [
            'nombre_uni' => $tipologia->nombre_uni,
            'abreviatura' => $tipologia->abreviatura,
            'estatus' => $tipologia->estatus,
            'id' => $this->tipologiaId
        ]);
    }

    public function updatetipologia($data)
    {
        $tipologia = Tipologias::find($data['id']);
        $tipologia->nombre_uni = $data['nombre_uni'];
        $tipologia->abreviatura = $data['abreviatura'];
        $tipologia->estatus = $data['estatus'];
        $tipologia->save();

        $this->resetFields();
    }

    public function deletetipo($id)
    {
        $tipologia = Tipologias::find($id);
        if ($tipologia) {
            $tipologia->delete();
        }
    }
}
