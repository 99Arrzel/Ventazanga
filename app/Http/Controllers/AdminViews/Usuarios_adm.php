<?php

namespace App\Http\Controllers\AdminViews;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use App\Models\Personas;
use App\Models\Roles;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class Usuarios_adm extends Controller
{
    public function index()
    {
        //Call to methods in usuario
        //$usuarios = Usuarios::PersonaCiudadRoles()->withTrashed()->get();
        //$usuarios = Usuarios::with('roles', 'datos_usuario.ciudad')->get();
        //$personas = Personas::with('ciudad')->get(); Este método solo duplica la query

        return Inertia::render('Adm/Usuarios', [
            'usuario' => function () {
                $usuario = Auth::user();
                $usuario->roles;
                $usuario->datos_usuario->ciudad;
                return $usuario;
            },
            //'personas' => fn () => Personas::with('ciudad', 'usuario.roles')->get(),
            'personas' => fn () => Personas::with([
                'ciudad',
                'usuario' => fn ($query) => $query->with(['roles' => function ($query) {
                    $query->withTrashed();
                }])->withTrashed(),
            ])->get(),
            'ciudades' => Inertia::lazy(fn () => Ciudades::all()),
            'roles' => Inertia::lazy(fn () => Roles::all()),
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:255|unique:usuarios',
            'password' => 'required|string|max:255',
            'id_rol' => 'required|exists:roles,id',
            'id_persona' => 'required|exists:personas,id',
        ]);
        Usuarios::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'id_persona' => $request->id_persona,
        ]);
        return back()->with('success', ['message' => 'Usuario creado con éxito']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:usuarios,id',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario,' . $request->id,
            'password' => 'nullable|string|max:255',
            'id_rol' => 'required|exists:roles,id',
            'id_persona' => 'required|exists:personas,id',
        ]);
        $usuario = Usuarios::find($request->id);
        $usuario->update([
            'usuario' => $request->usuario,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
            'id_rol' => $request->id_rol,
            'id_persona' => $request->id_persona,
        ]);
        return back()->with('success', ['message' => 'Usuario actualizado con éxito']);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:usuarios,id',
        ]);
        $usuario = Usuarios::find($request->id);
        $usuario->delete();
        return back()->with('success', ['message' => 'Usuario eliminado con éxito']);
    }
    public function restore(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:usuarios,id',
        ]);
        $usuario = Usuarios::withTrashed()->find($request->id);
        $usuario->restore();
        return back()->with('success', ['message' => 'Usuario restaurado con éxito']);
    }
}
