<?php

namespace App\Livewire\Tipologias;

use App\Models\Tipologias;
use Livewire\Component;
use Livewire\WithPagination;

class TipologiasComponent extends Component
{
    use WithPagination;

    public $buscar;
    public $name;
    public $abreviatura;
    public $estatus;
    public $selected_id;
    public $componetName;
    public $pageTitle;
    public $modalTitle;
    private $paginacion=5;

   

    public function render()
    {
        $data = $this->getData();
        return view('livewire.tipologia.tipologias-component', [
            'data' => $data,
        ])->layout('layouts.app');
    }
    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componetName = 'Tipologias';
        $this->modalTitle = 'Crear';
    }
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function getData()
    {
        if ($this->buscar == "") {
            return Tipologias::paginate($this->paginacion);
        } else {
            return Tipologias::where('nombre_uni', 'like', "%$this->buscar%")
                ->orWhere('abreviatura', 'like', "%$this->buscar%")
                ->orWhere('estatus', 'like', "%$this->buscar%")
                ->paginate($this->paginacion);
        }
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:data|min:3',
            'abreviatura' => 'required',
            'estatus' => 'required',
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre de la tipologia es requerido',
            'name.unique' => 'Ya existe el nombre de la tipologia',
            'name.min' => 'El nombre de la tipologia debe tener mínimo 3 caracteres',
            'abreviatura.required' => 'abreviatura requerida!',
        ];

        $this->validate($rules, $messages);

        $tipologia = Tipologias::create([
            'nombre_uni' => $this->name,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus
        ]);
      
         $tipologia->save();
      
        $this->resetUI();
        $this->dispatch('category-added', 'tipologia registrada');
    }
    public function Edit($id)
    {
        $record = Tipologias::find($id, ['id', 'nombre_uni', 'estatus','abreviatura']);
        if ($record) {
            $this->name = $record->nombre_uni;
            $this->selected_id = $record->id;
            $this->estatus =$record-> estatus;
            $this->abreviatura =$record-> abreviatura;

            $this->dispatch('show-modal', 'show modal !');
        } else {
            // Manejar el caso en que no se encuentre el registro
            session()->flash('message', 'Categoría no encontrada.');
        }
    }

    public function Update()
    {
       
        $rules = [
            'name' => 'required|unique:data|min:3',
            'abreviatura' => 'required',
            'estatus' => 'required',
            'name' => 'required',
        ];
        $messages = [
            'name.required' => 'Nombre de la tipologia es requerido',
            'name.unique' => 'Ya existe el nombre de la tipologia',
            'name.min' => 'El nombre de la tipologia debe tener mínimo 3 caracteres',
            'abreviatura.required' => 'abreviatura requerida!',
        ];
        $this->validate($rules, $messages);
        $tipologia = Tipologias::find($this->selected_id);
        $tipologia->Update([
            'nombre_uni' => $this->name,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus
        ]);
        $tipologia->save();
        // $this->resetUI();
        $this->dispatch('category-updated', 'categoria actualizada');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->abreviatura = '';
        $this->estatus = '';
        $this->selected_id = '';
    }

    public function Destroy(Tipologias $tipologia)
    {
        // $category = Categories::find($id);
        // dd($category);
       
            // Eliminar la categoría
            $tipologia->delete();
            // Eliminar la imagen si existe
           
            $this->resetUI();
            // $this->dispatch('deleteRow', 'categoria eliminada');
       
    }

   

    
}
