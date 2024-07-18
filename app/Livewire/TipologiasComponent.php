<?php
// C:\laragon\www\MINOS\app\Livewire\TipologiasComponent.php
namespace App\Livewire;

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

    protected $listeners = ['eventoGuardarTipologia' => 'storetipologia'];


    public function render()
    {
        if ($this->buscar == "") {
            $tipologias = Tipologias::paginate(5);
        } else {
            $tipologias = Tipologias::where('nombre_uni', 'like', "%$this->buscar%")
                ->orWhere('abreviatura', 'like', "%$this->buscar%")
                ->orWhere('estatus', 'like', "%$this->buscar%")
                ->paginate(5);
        }
        return view('livewire.tipologia.tipologias-component', ['tipologias' => $tipologias]);
    }

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

        if ($tipologia) {
            $this->id = $tipologia->id;
            $this->nombre_uni = $tipologia->nombre_uni;
            $this->abreviatura = $tipologia->abreviatura;
            $this->estatus = $tipologia->estatus; // Log para depuración
            // Log para depuración
            logger()->debug('Datos de tipología:', [
                'selectedTipologia' => $this->id,
                'nombre_uni' => $this->nombre_uni,
                'abreviatura' => $this->abreviatura,
                'estatus' => $this->estatus,
            ]);
        }
    }
}
