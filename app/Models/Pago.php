<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';

    public $timestamps = false;

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'id_viaje');
    }
}