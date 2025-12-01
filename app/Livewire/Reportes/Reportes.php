<?php

namespace App\Livewire\Reportes;

use Livewire\Component;

class Reportes extends Component
{

    public $area;

    public $verMovimientos;
    public $verPredios;

    protected function rules(){
        return [
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after:date1',
         ];
    }

    protected $messages = [
        'fecha1.required' => "La fecha inicial es obligatoria.",
        'fecha2.required' => "La fecha final es obligatoria.",
    ];

    public function updatedArea(){

        if($this->area == 'movimientos'){

            $this->verMovimientos = true;
            $this->verPredios = false;

        }elseif($this->area == 'predios'){

            $this->verPredios = true;
            $this->verMovimientos = false;

        }

    }

    public function render()
    {
        return view('livewire.reportes.reportes')->extends('layouts.admin');
    }
}
