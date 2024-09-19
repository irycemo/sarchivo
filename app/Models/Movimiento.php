<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Predio;
use App\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movimiento extends Model
{

    use HasFactory;
    use ModelosTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function predio(){
        return $this->belongsTo(Predio::class);
    }

    public function getFechaFormateadaAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha'])->format('d-m-Y');
    }

}
