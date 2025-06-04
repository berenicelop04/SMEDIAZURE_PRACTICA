<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEnergia extends Model
{
    use HasFactory;

    protected $table = 'estado_energia';
    protected $primaryKey = 'id_estado_energia';
    protected $fillable = ['estado_energia'];

    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class, 'id_estado_energia', 'id_estado_energia');
    }
}
