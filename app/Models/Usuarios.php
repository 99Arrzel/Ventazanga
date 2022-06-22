<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTimeInterface;

class Usuarios extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'usuarios';
    protected $fillable = [
        'usuario', 'id_rol', 'id_persona', 'password', 'verificado', 'id_foto_verificacion', 'id_foto_perfil', 'remember_token'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function foto_verificacion()
    {
        return $this->belongsTo(Imagenes::class, 'id_foto_verificacion');
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function datos_usuario()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }
    public function garantias()
    {
        return $this->belongsTo(Garantias::class, 'id_usuario', 'id_garantia');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->timezone('America/La_Paz')->format('d/m/Y');
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'id_rol');
    }
    public function scopePersonaCiudadRoles($query)
    {
        return $query->leftjoin('personas', 'personas.id', '=', 'usuarios.id_persona')
            ->leftjoin('ciudades', 'ciudades.id', '=', 'personas.id_ciudad')
            ->leftjoin('roles', 'roles.id', '=', 'usuarios.id_rol')
            ->select(
                'usuarios.*',
                'personas.nombre',
                'personas.apellido_p',
                'personas.apellido_m',
                'ciudades.nombre as nombre_ciudad',
                'personas.id_ciudad',
                'personas.ci',
                'personas.telefono',
                'personas.email',
                'roles.nombre as nombre_rol'
            );
    }
}
