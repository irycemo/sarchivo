<?php

namespace App\Models;

use App\Models\File;
use App\Models\Movimiento;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Predio extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getEstadoColorAttribute()
    {
        return [
            'activo' => 'green-400',
            'inactivo' => 'red-400',
        ][$this->estado] ?? 'gray-400';
    }

    public function archivos(){
        return $this->morphMany(File::class, 'fileable');
    }

    public function movimientos(){
        return $this->hasMany(Movimiento::class);
    }

    public function cuentaPredial(){

        return $this->localidad . '-' . $this->oficina . '-' . $this->tipo_predio . '-' . $this->numero_registro;

    }

}
