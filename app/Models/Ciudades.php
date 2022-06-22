<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ciudades extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ciudades';

    protected $fillable = [
        'nombre',
    ];
    //Cast dates
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'deleted_at' => 'datetime:d/m/Y H:i',
    ];
}
