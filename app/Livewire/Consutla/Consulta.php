<?php

namespace App\Livewire\Consutla;

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

    public $carpeta;

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

        $this->reset(['predio', 'carpeta', 'tomos', 'legajos']);

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

        if(env('LOCAL') === "0" || env('LOCAL') === "2"){

            if(Storage::disk('carpetas')->has($this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->cuentaPredial() . '.pdf'))
                $this->carpeta = Storage::disk('carpetas')->url($this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->cuentaPredial() . '.pdf');

        }elseif(env('LOCAL') === "1"){

            if(Storage::disk('s3')->has('sarchivo/carpetas/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->cuentaPredial() . '.pdf'))
                $this->carpeta = Storage::disk('s3')->temporaryUrl('sarchivo/carpetas/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $this->predio->cuentaPredial() . '.pdf', now()->addMinutes(1));

        }

        foreach($this->predio->movimientos as $movimiento){

            if(env('LOCAL') === "0" || env('LOCAL') === "2"){

                $tomos = Storage::disk('tomos_catastro')->allFiles($this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo);

                array_push($this->tomos, [
                    'movimiento_id' => $movimiento->id,
                    'tomos' => $tomos
                ]);

                $tomos_bis = Storage::disk('tomos_catastro')->allFiles($this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo . ' bis');

                if(!empty($tomos_bis)){

                    array_push($this->tomos, [
                        'movimiento_id' => $movimiento->id,
                        'tomos' => $tomos_bis
                    ]);

                }

                $legajos = Storage::disk('legajos_catastro')->allFiles($this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->comprobante_año);

                array_push($this->legajos, [
                    'movimiento_id' => $movimiento->id,
                    'legajos' => $legajos
                ]);

            }elseif(env('LOCAL') === "1"){

                $tomos = Storage::disk('s3')->allFiles('sarchivo/tomos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo);

                array_push($this->tomos, [
                    'movimiento_id' => $movimiento->id,
                    'tomos' => $tomos
                ]);

                $tomos_bis = Storage::disk('s3')->allFiles('sarchivo/tomos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->cuenta_tomo . ' bis');

                if(!empty($tomos_bis)){

                    array_push($this->tomos, [
                        'movimiento_id' => $movimiento->id,
                        'tomos' => $tomos_bis
                    ]);

                }

                $legajos = Storage::disk('s3')->allFiles('sarchivo/legajos_catastro/' . $this->predio->oficina . '/' . $this->predio->tipo_predio . '/' . $movimiento->comprobante_año);

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
        return view('livewire.consutla.consulta')->extends('layouts.admin');
    }
}
