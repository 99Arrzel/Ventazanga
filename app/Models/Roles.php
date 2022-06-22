<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'roles';
    protected $fillable = ['nombre', 'descripcion'];
    public function usuarios()
    {
        return $this->hasMany(Usuarios::class, 'id_rol');
    }
    //Cast dates
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'deleted_at' => 'datetime:d/m/Y H:i',
    ];
}
