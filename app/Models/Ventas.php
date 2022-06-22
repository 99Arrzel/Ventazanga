<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_categoria',
        'id_vendedor',
        'estado_venta',
        'id_garantia',
        'id_ciudad',
        'tipo_venta',
        'precio_venta',

        'id_marca',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
    public function garantia()
    {
        return $this->belongsTo(Garantias::class, 'id_garantia');
    }
    public function marca()
    {
        return $this->belongsTo(Marcas::class, 'id_marca');
    }
    public function caracteristicas()
    {
        /* Muchas caracteristicas para una venta */
        return $this->hasMany(Caracteristicas::class, 'id_venta');
    }
    public function imagenes()
    {
        return $this->belongsToMany(Imagenes::class, 'ventas_tienen_imagenes', 'id_venta', 'id_imagen');
    }
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'id_vendedor');
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'id_ciudad');
    }
}
