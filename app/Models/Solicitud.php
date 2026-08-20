<?php

namespace App\Models;

use App\Models\Predio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getEstadoColorAttribute()
    {
        return [
            'nuevo' => 'blue-400',
            'entregado' => 'green-400',
            'recibido' => 'yellow-400',
            'concluido' => 'gray-400',
        ][$this->estado] ?? 'gray-400';
    }

    public function predios(){
        return $this->belongsToMany(Predio::class, 'predio_solicituds')->withPivot(['entregado_por', 'entregado_en', 'recibido_por', 'recibido_en']);
    }

    public function actualizadoPor(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }

    public function getCreatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['updated_at'])->format('d-m-Y H:i:s');
    }

}
