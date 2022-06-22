<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caracteristicas extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'caracteristicas';
    protected $fillable = ['id_posible_caracteristica', 'id_venta', 'cantidad'];
    public function ventas()
    {
        return $this->belongsTo(Ventas::class, 'id_caracteristica', 'id_venta');
    }
    public function detalles()
    {
        return $this->belongsTo(Posibles_Caracteristicas::class, 'id_posible_caracteristica');
    }
}
