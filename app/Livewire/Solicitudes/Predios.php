<?php

namespace App\Livewire\Solicitudes;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
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

    public function toggelEstadoPredio(Predio $predio, int $estado){

        try {

            $predio->update([
                'estado' => $estado ? 'activo' : 'inactivo',
                'actualizado_por' => auth()->id()
            ]);

            $this->predio->refresh();

        } catch (\Throwable $th) {

            Log::error("Error al inactivar predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }

    }

    public function render()
    {
        return view('livewire.solicitudes.predios')->extends('layouts.admin');
    }
}
