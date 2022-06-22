<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'ci',
        'telefono',
        'email',
        'direccion',
        'id_ciudad',


    ];
    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'id_ciudad');
    }
    public function usuario()
    {
        return $this->hasMany(Usuarios::class, 'id_persona');
    }
}
