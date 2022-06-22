<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garantias extends Model
{
    use HasFactory;
    protected $table = 'garantias';
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_usuario',

    ];
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario');
    }
    /* Las ventas tienen un id de garantia así que creamos la relación también */
    public function ventas()
    {
        /* La relación es 1 a n */
        return $this->hasMany(Ventas::class, 'id_garantia');
    }
}
