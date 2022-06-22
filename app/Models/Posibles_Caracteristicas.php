<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posibles_Caracteristicas extends Model
{
    use HasFactory;
    protected $table = 'posibles_caracteristicas';
    protected $fillable = ['nombre', 'descripcion',  'unidad_medida'];
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristicas::class, 'id_posible_caracteristica');
    }
}
