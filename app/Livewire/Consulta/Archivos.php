<?php

namespace App\Livewire\Consulta;

use App\Models\Oficina;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Archivos extends Component
{

    public $oficinas;
    public $oficina;
    public $arbol;

    public $files = [];

    public function mostrarArchivos($ruta){

        $this->files = Storage::disk('s3')->allFiles('sarchivo/' . $ruta);

    }

    public function mount(){

        if(auth()->user()->hasRole('Administrador')){

            $this->oficinas = Oficina::whereHas('usuarios', function($q){
                                            $q->whereHas('roles', function($q){
                                                $q->where('name', '!=', 'Administrador');
                                            });
                                        })
                                        ->pluck('oficina');

        }else{

            $this->oficinas []= auth()->user()->oficina->oficina;

        }

        $directorios = Storage::disk('s3')->directories('sarchivo');

        $this->arbol = null;

        foreach($directorios as $directorio){

            if($directorio == 'sarchivo/predios_catastro') continue;

            foreach($this->oficinas as $oficina){

                if($directorio == 'sarchivo/carpetas'){

                    $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][1] = [];
                    $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][2] = [];

                }elseif($directorio == 'sarchivo/legajos_catastro'){

                    $subDirectorios = Storage::disk('s3')->directories('sarchivo/legajos_catastro/' . $oficina . '/1');

                    foreach($subDirectorios as $subdirectorio){

                        $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][1][str_replace('sarchivo/legajos_catastro/' . $oficina . '/1/', '', $subdirectorio)]= [];

                    }

                    $subDirectorios = Storage::disk('s3')->directories('sarchivo/legajos_catastro/' . $oficina . '/2');

                    foreach($subDirectorios as $subdirectorio){

                        $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][2][str_replace('sarchivo/legajos_catastro/' . $oficina . '/2/', '', $subdirectorio)]= [];

                    }

                }elseif($directorio == 'sarchivo/tomos_catastro'){

                    $subDirectorios = Storage::disk('s3')->directories('sarchivo/tomos_catastro/' . $oficina . '/1');

                    foreach($subDirectorios as $subdirectorio){

                        $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][1][str_replace('sarchivo/tomos_catastro/' . $oficina . '/1/', '', $subdirectorio)]= [];

                    }

                    $subDirectorios = Storage::disk('s3')->directories('sarchivo/tomos_catastro/' . $oficina . '/2');

                    foreach($subDirectorios as $subdirectorio){

                        $this->arbol[str_replace('sarchivo/', '', $directorio)][$oficina][2][str_replace('sarchivo/tomos_catastro/' . $oficina . '/2/', '', $subdirectorio)]= [];

                    }

                }

            }

        }

    }

    public function render()
    {
        return view('livewire.consulta.archivos')->extends('layouts.admin');
    }
}
