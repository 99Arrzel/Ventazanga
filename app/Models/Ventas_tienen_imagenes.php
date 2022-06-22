<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas_tienen_imagenes extends Model
{
    use HasFactory;
    protected $table = 'ventas_tienen_imagenes';
    protected $fillable = [
        'id_venta',
        'id_imagen',
    ];
    /* No timestamps */
    public $timestamps = false;
    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'id_venta');
    }
    public function imagen()
    {
        return $this->belongsTo(Imagenes::class, 'id_imagen');
    }
}
