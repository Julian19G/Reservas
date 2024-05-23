<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;
    protected $table = 'viajes';

    public $timestamps = false;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'id_paquete');
    }
}
