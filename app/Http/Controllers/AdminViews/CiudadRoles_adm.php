<?php

namespace App\Http\Controllers\AdminViews;

use App\Http\Controllers\Controller;
use App\Models\Ciudades;
use App\Models\Marcas;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CiudadRoles_adm extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $usuario->datos_usuario;
        $usuario->roles;
        return Inertia::render('Adm/CiudadesRolesYMarcas', [
            'usuario' => fn () => $usuario,
            'roles' => fn () => Roles::withTrashed()->get(),
            'ciudades' => fn () => Ciudades::withTrashed()->get(),
            'marcas' => fn () => Marcas::withTrashed()->get()
        ]);
    }
    public function create_r(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles',
            'descripcion' => 'required|string|max:255',
        ]);
        Roles::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return back()->with('success', ['message' => 'Rol creado con éxito']);
    }
    public function update_r(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:roles,id',
            'nombre' => 'required|string|max:255|unique:roles,nombre,' . $request->id,
            'descripcion' => 'required|string|max:255',
        ]);
        if ($request->id == 1) {
            return back()->withErrors(['message' => 'No se puede editar el rol "Administrador"']);
        }
        $rol = Roles::withTrashed()->where('id', $request->id)->first();
        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return back()->with('success', ['message' => 'Rol actualizado con éxito']);
    }
    public function delete_r(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:roles,id',
        ]);
        if ($request->id == 1) {
            return back()->withErrors(['message' => 'No se puede eliminar el rol "Administrador"']);
        }
        $rol = Roles::withTrashed()->find($request->id);

        if (isset($rol->deleted_at)) {
            $rol->restore();
            return back()->with('success', ['message' => 'Rol restaurado con éxito']);
        }
        $rol->delete();
        return back()->with('success', ['message' => 'Rol desactivado con éxito']);
    }
    public function create_c(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:ciudades',
        ]);
        Ciudades::create([
            'nombre' => $request->nombre,
        ]);
        return back()->with('success', ['message' => 'Ciudad creada con éxito']);
    }
    public function update_c(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ciudades,id',
            'nombre' => 'required|string|max:255|unique:ciudades,nombre,' . $request->id,
        ]);
        $ciudad = Ciudades::withTrashed()->find($request->id);
        $ciudad->update([
            'nombre' => $request->nombre,
        ]);
        return back()->with('success', ['message' => 'Ciudad actualizada con éxito']);
    }
    public function delete_c(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ciudades,id',
        ]);
        $ciudad = Ciudades::withTrashed()->find($request->id);
        if (isset($ciudad->deleted_at)) {
            $ciudad->restore();
            return back()->with('success', ['message' => 'Ciudad restaurada con éxito']);
        }
        $ciudad->delete();
        return back()->with('success', ['message' => 'Ciudad desactivada con éxito']);
    }
}
