<?php

namespace App\Http\Controllers\Api\V1\Solicitudes;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CrearSolicitudRequest;
use App\Models\Predio;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Log;

class CrearSolicitudController extends Controller
{

    public function crearSolicitud(CrearSolicitudRequest $request){

        $data = $request->validated();

        try {

            $this->revisarDisponiblilidad($data);

            $this->buscarSolicitudActiva($data);

            $solicitud = $this->buscarSolicitudNueva($data['solicitante']);

            if($solicitud){

                $this->anexarPredio($data, $solicitud);

                return response()->json([
                    'data' => "La solicitud (" . $solicitud->folio . ") se generó con éxito",
                ], 200);

            }else{

                $solicitud = $this->crearNuevaSolicitud($data);

                return response()->json([
                    'data' => "La solicitud (" . $solicitud->folio . ") se generó con éxito",
                ], 200);

            }

        } catch (GeneralException $ex) {

            return response()->json([
                'error' => $ex->getMessage(),
            ], 500);

        } catch (\Throwable $th) {

            Log::error("Hubo un error al crear la solicitud de archivo." . $th);

            return response()->json([
                'error' => 'Hubo un error al crear la solicitud de archivo.',
            ], 500);

        }

    }

    private function buscarSolicitudActiva(array $data){

        $solicitud = Solicitud::where('solicitante', $data['solicitante'])->where('estado', '!=', 'concluido')->first();

        if(! $solicitud) return;

        $predio = Predio::where('localidad', $data['localidad'])
                                ->where('oficina', $data['oficina'])
                                ->where('tipo_predio', $data['tipo_predio'])
                                ->where('numero_registro', $data['numero_registro'])
                                ->first();

        if(! $predio){

            $predio = Predio::create([
                'localidad' =>  $data['localidad'],
                'oficina' =>  $data['oficina'],
                'tipo_predio' =>  $data['tipo_predio'],
                'numero_registro' =>  $data['numero_registro'],
            ]);

        }

        $predio_solicitud = $solicitud->predios()->where('predio_solicituds.predio_id', $predio->id)->first();

        if($predio_solicitud){

            throw new GeneralException('Ya existe una solicitud (' . $solicitud->folio . ') activa con el predio solicitado.');

        }

    }

    private function buscarSolicitudNueva(string $solicitante){

        return Solicitud::where('estado', 'nuevo')
                            ->where('solicitante', $solicitante)
                            ->first();

    }

    private function anexarPredio(array $data, Solicitud $solicitud){

        $predio = Predio::where('localidad', $data['localidad'])
                                ->where('oficina', $data['oficina'])
                                ->where('tipo_predio', $data['tipo_predio'])
                                ->where('numero_registro', $data['numero_registro'])
                                ->first();

        $solicitud->predios()->attach($predio->id);

    }

    private function crearNuevaSolicitud(array $data){

        $solicitud = Solicitud::create([
            'folio' => Solicitud::max('folio') + 1,
            'estado' => 'nuevo',
            'solicitante' => $data['solicitante']
        ]);

        $predio = Predio::where('localidad', $data['localidad'])
                                ->where('oficina', $data['oficina'])
                                ->where('tipo_predio', $data['tipo_predio'])
                                ->where('numero_registro', $data['numero_registro'])
                                ->first();

        if(! $predio){

            $predio = Predio::create([
                'localidad' =>  $data['localidad'],
                'oficina' =>  $data['oficina'],
                'tipo_predio' =>  $data['tipo_predio'],
                'numero_registro' =>  $data['numero_registro'],
            ]);

        }

        $solicitud->predios()->attach($predio->id);

        return $solicitud;

    }

    private function revisarDisponiblilidad(array $data){

        $predio = Predio::where('localidad', $data['localidad'])
                                    ->where('oficina', $data['oficina'])
                                    ->where('tipo_predio', $data['tipo_predio'])
                                    ->where('numero_registro', $data['numero_registro'])
                                    ->first();

        if(!$predio) return;

        $solicitud = Solicitud::whereHas('predios', function($q) use($predio){
                                    $q->where('predio_id', $predio->id);
                                })
                                ->where('solicitante', '!=', $data['solicitante'])
                                ->where('estado', '!=', 'concluido')
                                ->first();

        if($solicitud){

            throw new GeneralException('El archivo se encuentra ocupado.');

        }

    }

}
