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

    public function storetipologia()
    {
        $tipologia = new Tipologias();
        $tipologia->nombre_uni = $this->nombre_uni;
        $tipologia->abreviatura = $this->abreviatura;
        $tipologia->estatus = "ACTIVO";
        $tipologia->save();
    }
}
