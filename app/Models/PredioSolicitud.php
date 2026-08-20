<?php

namespace App\Models;

use App\Models\Predio;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PredioSolicitud extends Model
{

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'entregado_en' => 'datetime',
        'recibido_en' => 'datetime'
    ];

    public function entregadoPor(){
        return $this->belongsTo(User::class, 'entregado_por');
    }

    public function recibidoPor(){
        return $this->belongsTo(User::class, 'recibido_por');
    }

    public function predio(){
        return $this->belongsTo(Predio::class);
    }

    public function solicitud(){
        return $this->belongsTo(Solicitud::class);
    }

}
