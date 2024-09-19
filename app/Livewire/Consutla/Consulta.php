<?php

namespace App\Livewire\Consutla;

use App\Models\Predio;
use Livewire\Component;

class Consulta extends Component
{

    public $localidad;
    public $oficina;
    public $tipo;
    public $registro;

    public $predio;

    protected function rules(){
        return [
            'localidad' => 'required|numeric',
            'oficina' => 'required|numeric',
            'tipo' => 'required|numeric|max:2|min:1',
            'registro' => 'required|numeric',
         ];
    }

    public function buscarPredio(){

        $this->validate();

        $this->predio = Predio::with('archivos', 'movimientos')
                            ->where('localidad', $this->localidad)
                            ->where('oficina', $this->oficina)
                            ->where('tipo_predio', $this->tipo)
                            ->where('numero_registro', $this->registro)
                            ->first();

        if(!$this->predio){

            $this->dispatch('mostrarMensaje', ['error', "No se encontro el predio."]);

        }

    }

    public function mount(){

        $this->oficina = auth()->user()->oficina->oficina;

    }

    public function render()
    {
        return view('livewire.consutla.consulta')->extends('layouts.admin');
    }
}
