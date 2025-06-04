<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    protected $primaryKey = 'id_municipio';

    public $timestamps = false;

    protected $fillable = ['municipio'];

    public function localidades()
    {
        return $this->hasMany(Localidad::class, 'id_municipio');
    }

}
