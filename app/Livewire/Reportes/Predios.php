<?php

namespace App\Livewire\Reportes;

use App\Models\User;
use App\Models\Predio;
use App\Models\Oficina;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Predios extends Component
{

    public $usuarios;
    public $usuario;
    public $oficinas;
    public $oficina;
    public $fecha1;
    public $fecha2;

    #[Computed]
    public function predios(){

        return Predio::when($this->oficina && $this->oficina != '', function($q){
                            $q->where('oficina', $this->oficina);
                        })
                        ->when($this->usuario && $this->usuario != '', function($q){
                            $q->where('creado_por', $this->usuario);
                        })
                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                        ->count();

    }

    public function mount(){

        $this->oficinas = Oficina::orderBy('nombre')->get();

        $this->usuarios = User::whereHas('roles', function($q){
                                    $q->where('name', 'Capturista');
                                })
                                ->get();

    }

    public function render()
    {
        return view('livewire.reportes.predios');
    }
}
