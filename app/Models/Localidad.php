<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades';
    
    protected $primaryKey = 'id_localidad';
    protected $fillable = ['localidad', 'id_municipio'];

    // App\Models\Localidad.php
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

}
