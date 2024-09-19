<?php

namespace App\Livewire\Captura;

use App\Models\File;
use App\Models\Predio;
use Livewire\Component;
use App\Models\Movimiento;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class Predios extends Component
{

    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public Predio $modelo_editar;
    public Movimiento $movimiento;

    public $files = [];
    public $files_edit = [];
    public $file_id;

    public $modalEliminar = false;
    public $modalVer = false;
    public $modalMovimineto = false;
    public $modalEliminarMovimiento = false;

    public $filters = [
        'localidad' => '',
        'oficina' => '',
        'tipo' => '',
        'registro' => '',
    ];

    protected function rules(){
        return [
            'modelo_editar.localidad' => 'required|numeric',
            'modelo_editar.oficina' => 'required|numeric',
            'modelo_editar.tipo_predio' => 'required|numeric|max:2|min:1',
            'modelo_editar.numero_registro' => 'required|numeric',
            'modelo_editar.nombre' => 'required',
            'movimiento.fecha' => 'nullable',
            'movimiento.comprobante_numero' => 'nullable',
            'movimiento.comprobante_año' => 'nullable',
            'movimiento.cuenta_tomo' => 'nullable',
            'movimiento.cuenta_folio' => 'nullable',
            'movimiento.propietario' => 'nullable',
            'movimiento.observaciones' => 'nullable',
            'files.*' => 'mimes:pdf',
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.tipo_predio' => 'tipo de predio',
        'modelo_editar.numero_registro' => 'número',
        'movimiento.comprobante_numero' => 'número',
        'movimiento.comprobante_año' => 'año',
        'movimiento.cuenta_tomo' => 'tomo',
        'movimiento.cuenta_folio' => 'folio',
    ];

    public function updatedFilters() { $this->resetPage(); }

    public function crearModeloVacio(){
        $this->modelo_editar = Predio::make();
        $this->movimiento = Movimiento::make();
    }

    public function abrirModalEditar(Predio $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->files_edit = File::where('fileable_id', $modelo->id)->where('fileable_type', 'App\Models\Predio')->get();
    }

    public function abrirModalVer(Predio $modelo){

        $this->resetearTodo();
        $this->modalVer = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        $this->modelo_editar->load('movimientos', 'archivos');

    }

    public function abrirModalMovimiento(Predio $modelo){

        $this->resetearTodo();
        $this->modalMovimineto = true;
        $this->crear =true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

        if($this->movimiento->getKey())
            $this->crearModeloVacio();

    }

    public function openModalDeleteFile($id){

        $this->file_id = $id;

        $this->modalEliminar = true;

    }

    public function guardar(){

        $this->validate();

        $predio = Predio::where('localidad', $this->modelo_editar->localidad)
                            ->where('oficina', $this->modelo_editar->oficina)
                            ->where('tipo_predio', $this->modelo_editar->tipo_predio)
                            ->where('numero_registro', $this->modelo_editar->numero_registro)
                            ->first();

        if($predio){

            $this->dispatch('mostrarMensaje', ['warning', "El predio ya existe."]);

            return;

        }

        try {

            DB::transaction(function () {

                $this->modelo_editar->estado = 'activo';
                $this->modelo_editar->creado_por = auth()->user()->id;
                $this->modelo_editar->save();

                if(isset($this->files)){

                    foreach($this->files as $file){

                        if(env('LOCAL') === "0" || env('LOCAL') === "2"){

                            $pdf = $file->store('/', 'predios_catastro');

                        }elseif(env('LOCAL') === "1"){

                            $pdf = $file->store('sarchivo/predios_catastro', 's3');

                        }

                        File::create([
                            'fileable_id' => $this->modelo_editar->id,
                            'fileable_type' => 'App\Models\Predio',
                            'url' => $pdf
                        ]);

                    }

                    $this->dispatch('removeFiles');
                }

                $this->resetearTodo($borrado = true);

                $this->dispatch('mostrarMensaje', ['success', "El predio se creó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al crear predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function guardarMovimiento(){

        $this->validate([
            'movimiento.fecha' => 'required|date',
            'movimiento.comprobante_año' => 'nullable|numeric',
            'movimiento.comprobante_numero' => 'nullable|numeric',
            'movimiento.cuenta_tomo' => 'nullable|numeric',
            'movimiento.cuenta_folio' => 'nullable|numeric',
            'movimiento.observaciones' => 'nullable',
            'movimiento.propietario' => 'required|string',
        ]);

        try {

            $this->movimiento->predio_id = $this->modelo_editar->id;
            $this->movimiento->creado_por = auth()->id();
            $this->movimiento->save();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El movimiento se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear movimiento por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function actualizarMovimiento(){

        $this->validate([
            'movimiento.fecha' => 'required',
            'movimiento.comprobante_año' => 'required',
            'movimiento.cuenta_tomo' => 'required',
            'movimiento.observaciones' => 'nullable',
        ]);

        try {

            $this->movimiento->predio_id = $this->modelo_editar->id;
            $this->movimiento->actualizado_por = auth()->id();
            $this->movimiento->save();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El movimiento se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar movimiento por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function editarMovimiento(Movimiento $movimiento){

        $this->resetearTodo();

        $this->movimiento = $movimiento;

        $this->modal = false;
        $this->modalMovimineto = true;
        $this->editar =true;

    }

    public function actualizar(){

        $this->validate();

        try{

            DB::transaction(function () {

                $this->modelo_editar->actualizado_por = auth()->user()->id;
                $this->modelo_editar->save();

                if(isset($this->files)){

                    foreach($this->files as $file){

                        if(env('LOCAL') === "0" || env('LOCAL') === "2"){

                            $pdf = $file->store('/', 'predios_catastro');

                        }elseif(env('LOCAL') === "1"){

                            $pdf = $file->store('sarchivo/predios_catastro', 's3');

                        }

                        File::create([
                            'fileable_id' => $this->modelo_editar->id,
                            'fileable_type' => 'App\Models\Predio',
                            'url' => $pdf
                        ]);
                    }

                    $this->dispatch('removeFiles');
                }

                $this->resetearTodo($borrado = true);

                $this->dispatch('mostrarMensaje', ['success', "El predio se actualizó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            DB::transaction(function () {

                $predio = Predio::find($this->selected_id);

                foreach ($predio->archivos as $file) {

                    if(env('LOCAL') === "0" || env('LOCAL') === "2"){

                        Storage::disk('predios_catastro')->delete($file->url);

                    }elseif(env('LOCAL') === "1"){

                        Storage::disk('s3')->delete($file->url);

                    }

                    $file->delete();

                }

                $predio->movimientos()->delete();

                $predio->delete();

            });

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El predio se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar predio por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrarArchivo(){

        try {

            $file = File::findorFail($this->file_id);

            if(env('LOCAL') === "0" || env('LOCAL') === "2"){

                Storage::disk('predios_catastro')->delete($file->url);

            }elseif(env('LOCAL') === "1"){

                Storage::disk('s3')->delete($file->url);

            }

            $file->delete();

            $this->dispatch('mostrarMensaje',['success', "El archivo ha sido eliminado con éxito."]);

            $this->files_edit = File::where('fileable_id', $this->modelo_editar->id)->where('fileable_type', 'App\Models\Predio')->get();

            $this->modalEliminar = false;

        } catch (\Throwable $th) {

            Log::error("Error al borrar archivo de entrada por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

        }
    }

    public function abrirModalBorrarMovimiento(Movimiento $movimiento){

        $this->modalEliminarMovimiento = true;

        $this->movimiento = $movimiento;

    }

    public function borrarMovimiento(){

        try {

            $this->movimiento->delete();

            $this->modelo_editar->load('movimientos');

            $this->modalEliminarMovimiento = false;

            $this->dispatch('mostrarMensaje',['success', "El movimiento ha sido eliminado con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar movimiento de entrada por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje',['error', "Lo sentimos hubo un error inténtalo de nuevo"]);

        }
    }

    public function verPdf($url){

        $headers = [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="filename.pdf"',
        ];

        return Response::make(Storage::disk('s3')->get($url), 200, $headers);

    }

    public function mount(){

        $this->crearModeloVacio();

        array_push($this->fields, 'files', 'files_edit', 'file_id', 'modalEliminar', 'modalVer', 'modalMovimineto', 'modalEliminarMovimiento');

        if(!auth()->user()->hasRole('Administrador')){

            $this->modelo_editar->oficina = auth()->user()->oficina->oficina;

        }

    }

    public function render()
    {

        if(auth()->user()->hasRole('Administrador')){

            $predios = Predio::with('actualizadoPor')
                            ->when($this->filters['localidad'], fn($q, $localidad) => $q->where('localidad', $localidad))
                            ->when($this->filters['oficina'], fn($q, $oficina) => $q->where('oficina', $oficina))
                            ->when($this->filters['tipo'], fn($q, $tipo) => $q->where('tipo_predio', $tipo))
                            ->when($this->filters['registro'], fn($q, $registro) => $q->where('numero_registro', $registro))
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        }else{

            $predios = Predio::with('actualizadoPor')
                            ->when($this->filters['localidad'], fn($q, $localidad) => $q->where('localidad', $localidad))
                            ->when($this->filters['oficina'], fn($q, $oficina) => $q->where('oficina', $oficina))
                            ->when($this->filters['tipo'], fn($q, $tipo) => $q->where('tipo_predio', $tipo))
                            ->when($this->filters['registro'], fn($q, $registro) => $q->where('numero_registro', $registro))
                            ->where('oficina', auth()->user()->oficina->oficina)
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        }

        return view('livewire.captura.predios', compact('predios'))->extends('layouts.admin');
    }
}
