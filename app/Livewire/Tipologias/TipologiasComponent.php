<?php
// C:\laragon\www\MINOS\app\Livewire\TipologiasComponent.php
namespace App\Livewire\Tipologias;

use App\Models\Tipologias;
use Livewire\Component;
use Livewire\WithPagination;

class TipologiasComponent extends Component
{
    use WithPagination;

    public $buscar;
    public $nombre_uni;
    public $abreviatura;
    public $id;
    public $estatus;

    protected $listeners = [
        'eventoGuardarTipologia' => 'storetipologia',
        'eventoupdateTipologia' => 'updatetipologia',

    ];
    // Reglas de validación
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

//     public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
// {
//     if ($this->buscar == "") {
//         $tipologias = Tipologias::paginate(5);
//     } else {
//         $tipologias = Tipologias::where('nombre_uni', 'like', "%$this->buscar%")
//             ->orWhere('abreviatura', 'like', "%$this->buscar%")
//             ->orWhere('estatus', 'like', "%$this->buscar%")
//             ->paginate(5);
//     }
//     return view('livewire.tipologia.tipologias-component', [
//         "data" => $tipologias
//     ])->layout('layouts.app');
// }


    // public function render()
    // {
    //     if ($this->buscar == "") {
    //         $tipologias = Tipologias::paginate(5);
    //     } else {
    //         $tipologias = Tipologias::where('nombre_uni', 'like', "%$this->buscar%")
    //             ->orWhere('abreviatura', 'like', "%$this->buscar%")
    //             ->orWhere('estatus', 'like', "%$this->buscar%")
    //             ->paginate(5);
    //     }
    //     return view('livewire.tipologia.tipologias-component', ['tipologias' => $tipologias]);
    // }

    public function storetipologia($data)
    {
        $this->nombre_uni = $data['nombre_uni'];
        $this->abreviatura = $data['abreviatura'];

        
        $tipologia = new Tipologias();
        $tipologia->nombre_uni = $this->nombre_uni;
        $tipologia->abreviatura = $this->abreviatura;
        $tipologia->estatus = "ACTIVO";
        $tipologia->save();

        $this->reset(['nombre_uni', 'abreviatura']);
    }
    public function edittipologia($id)
    {
        $tipologia = Tipologias::find($id);
        $this->id = $tipologia->id;
        $this->nombre_uni = $tipologia->nombre_uni;
        $this->abreviatura = $tipologia->abreviatura;
        $this->estatus = $tipologia->estatus;

        // Emitir el evento para enviar los datos al componente ModalTipo
        $this->dispatch('editarTipologia', [
            'nombre_uni' => $this->nombre_uni,
            'abreviatura' => $this->abreviatura,
            'estatus' => $this->estatus,
            'id' => $this->id
        ]);
    }
    public function updatetipologia($data)
    {
       
        $tipologia = Tipologias::find($data['id']);
        $tipologia->nombre_uni = $data['nombre_uni'];
        $tipologia->abreviatura = $data['abreviatura'];
        $tipologia->estatus = $data['estatus'];
        $tipologia->save();

        $this->reset(['nombre_uni', 'abreviatura', 'estatus', 'id']);
    }
    public function deletetipo($id)
    {
        $tipologia = Tipologias::find($id);
        if ($tipologia) {
            $tipologia->delete();
        }
    }

   
}
