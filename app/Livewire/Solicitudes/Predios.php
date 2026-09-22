<?php

namespace App\Livewire\Solicitudes;

use Livewire\Component;
use App\Models\Predio;

class Predios extends Component
{

    public $localidad;
    public $oficina = 101;
    public $tipo_predio;
    public $numero_registro;

    public $predio;

    public function buscar(){

        $this->predio = Predio::where('localidad', $this->localidad)
                                ->where('oficina', $this->oficina)
                                ->where('tipo_predio', $this->tipo_predio)
                                ->where('numero_registro', $this->numero_registro)
                                ->first();

    }

    public function render()
    {
        return view('livewire.solicitudes.predios');
    }
}
