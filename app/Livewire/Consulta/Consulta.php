<?php

namespace App\Livewire\Consulta;

use App\Models\Predio;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Consulta extends Component
{

    public $localidad;
    public $oficina;
    public $tipo;
    public $registro;

    public $predio;

    public $tarjeta;

    public $tomos = [];

    public $legajos = [];

    protected function rules(){
        return [
            'localidad' => 'required|numeric',
            'oficina' => 'required|numeric',
            'tipo' => 'required|numeric|max:2|min:1',
            'registro' => 'required|numeric',
         ];
    }

    public function buscarPredio(){

        $this->reset(['predio', 'tarjeta', 'tomos', 'legajos']);

        $this->validate();

        $this->predio = Predio::with('archivos', 'movimientos')
                            ->where('localidad', $this->localidad)
                            ->where('oficina', $this->oficina)
                            ->where('tipo_predio', $this->tipo)
                            ->where('numero_registro', $this->registro)
                            ->first();

        if(!$this->predio){

            $this->dispatch('mostrarMensaje', ['error', "No se encontro el predio."]);

            return;

        }

        if(Storage::disk('s3')->has('sarchivo/tarjetas_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->numero_registro . '.pdf')){

            $this->tarjeta = Storage::disk('s3')->temporaryUrl('sarchivo/tarjetas_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->numero_registro . '.pdf', now()->addMinutes(1));

        }

        foreach($this->predio->movimientos as $movimiento){

            $tomos = Storage::disk('s3')->allFiles('sarchivo/tomos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo);

            if($movimiento->cuenta_tomo){

                array_push($this->tomos, [
                    'movimiento_id' => $movimiento->id,
                    'tomos' => $tomos
                ]);

            }

            $tomos_bis = Storage::disk('s3')->allFiles('sarchivo/tomos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo . ' bis');

            if(!empty($tomos_bis)){

                array_push($this->tomos, [
                    'movimiento_id' => $movimiento->id,
                    'tomos' => $tomos_bis
                ]);

            }

            $legajos = Storage::disk('s3')->allFiles('sarchivo/legajos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->comprobante_año);

            if($movimiento->comprobante_año){

                array_push($this->legajos, [
                    'movimiento_id' => $movimiento->id,
                    'legajos' => $legajos
                ]);

            }
        }

    }

    public function mount(){

        $this->oficina = auth()->user()->oficina->oficina;

    }

    public function render()
    {
        return view('livewire.consulta.consulta')->extends('layouts.admin');
    }
}
