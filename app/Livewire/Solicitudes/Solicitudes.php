<?php

namespace App\Livewire\Solicitudes;

use App\Models\PredioSolicitud;
use App\Models\Predio;
use App\Models\Solicitud;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Solicitudes extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public $estado;
    public $solicitante;
    public $modalVer = false;
    public $modalBorrar = false;
    public $solicitud_seleccionada;
    public $predios_solicitados;
    public $filters = [
        'localidad' => '',
        'oficina' => '',
        'tipo_predio' => '',
        'numero_registro' => ''
    ];

    public Solicitud $modelo_editar;

    public function crearModeloVacio(){
        $this->modelo_editar = Solicitud::make();
    }

    public function abrirModalVer(Solicitud $modelo){

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->modalVer = true;

        $this->predios_solicitados = PredioSolicitud::with('entregadoPor:id,name', 'recibidoPor:id,name', 'predio')
                                                        ->where('solicitud_id', $this->modelo_editar->id)
                                                        ->get();

    }

    public function entregarSolicitud(){

        try {

            DB::transaction(function () {

                $this->modelo_editar->update([
                    'estado' => 'entregado',
                    'actualizado_por' => auth()->id()
                ]);

                foreach ($this->predios_solicitados as $predio_solicitado) {

                    $predio_solicitado->update([
                        'entregado_por' => auth()->id(),
                        'entregado_en' => now()
                    ]);

                }

            });

            $this->modalVer = false;

        } catch (\Throwable $th) {

            Log::error("Error al entregar solicitud id: " . $this->modelo_editar->id . " por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function recibirArchivo(PredioSolicitud $predio_solicitado){

        try {

            DB::transaction(function () use($predio_solicitado){

                $predio_solicitado->update([
                    'recibido_por' => auth()->id(),
                    'recibido_en' => now()
                ]);

                $this->predios_solicitados = PredioSolicitud::with('entregadoPor:id,name', 'recibidoPor:id,name', 'predio')
                                                        ->where('solicitud_id', $this->modelo_editar->id)
                                                        ->get();

                $todos_entregados = $this->predios_solicitados->every(function($predio_solicitado) { return $predio_solicitado->recibido_por ?? false; });

                if($todos_entregados){

                    $this->modelo_editar->update([
                        'estado' => 'concluido',
                        'actualizado_por' => auth()->id()
                    ]);

                }

            });

        } catch (\Throwable $th) {

            Log::error("Error al recibir archivo de la solicitud solicitud id: " . $this->modelo_editar->id . " por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }

    }

    public function recibirTodo(){

        try {

            DB::transaction(function () {

                $this->predios_solicitados = PredioSolicitud::with('entregadoPor:id,name', 'recibidoPor:id,name', 'predio')
                                                        ->where('solicitud_id', $this->modelo_editar->id)
                                                        ->get();

                foreach ($this->predios_solicitados as $predio_solicitado) {

                    $predio_solicitado->update([
                        'recibido_por' => auth()->id(),
                        'recibido_en' => now()
                    ]);

                }

                $this->modelo_editar->update([
                    'estado' => 'concluido',
                    'actualizado_por' => auth()->id()
                ]);

                $this->dispatch('mostrarMensaje', ['success', "La solicitud se concluyó con éxito."]);

                $this->modalVer = false;

            });

        } catch (\Throwable $th) {

            Log::error("Error al recibir archivo de la solicitud solicitud id: " . $this->modelo_editar->id . " por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function borrar(Solicitud $solicitud){

        try {

            $solicitud->predios()->detach();

            $solicitud->delete();

            $this->dispatch('mostrarMensaje', ['success', "La solicitud se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar archivo de la solicitud solicitud id: " . $this->modelo_editar->id . " por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    #[Computed]
    public function solicitudes(){

        $predio = null;

        if(
            ! empty($this->filters['localidad']) &&
            ! empty($this->filters['oficina']) &&
            ! empty($this->filters['tipo_predio']) &&
            ! empty($this->filters['numero_registro'])
        ){

            $predio = Predio::where('localidad', $this->filters['localidad'])
                                ->where('oficina', $this->filters['oficina'])
                                ->where('tipo_predio', $this->filters['tipo_predio'])
                                ->where('numero_registro', $this->filters['numero_registro'])
                                ->first();

        }

        return Solicitud::with('actualizadoPor:id,name')
                            ->withCount('predios')
                            ->when(! empty($this->estado), function($q){
                                $q->where('estado', $this->estado);
                            })
                            ->when($predio, function ($q) use($predio){
                                $q->whereHas('predios', function($q) use($predio){
                                    $q->where('predio_solicituds.predio_id', $predio->id);
                                });
                            })
                            ->where('solicitante', 'like', '%' . $this->solicitante . '%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.solicitudes.solicitudes')->extends('layouts.admin');
    }

}
