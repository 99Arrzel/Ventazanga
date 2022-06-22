<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_categoria_padre'
    ];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => ucfirst($value),
        );
    }

    protected function descripcion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => ucfirst($value),
        );
    }


    public function ventas()
    {
        return $this->hasMany(Ventas::class, 'id_categoria');
    }
    public function hijos()
    {
        return $this->hasMany(Categorias::class, 'id_categoria_padre');
    }
    public function posibles_caracteristicas()
    {
        return $this->belongsToMany(Posibles_Caracteristicas::class, 'categorias_posiblesc', 'id_categoria', 'id_posiblesc');
    }
}
