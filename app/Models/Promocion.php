<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    protected $table = 'promociones';

    public $timestamps = false;

    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'id_paquete');
    }
}
