<?php

namespace App\Http\Controllers\AdminViews;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class Personas_adm extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'ci' => 'required|string|max:255|unique:personas',
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:personas',
            'direccion' => 'required|string|max:255',
            'id_ciudad' => 'required|exists:ciudades,id',
        ]);
        Personas::create([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'id_ciudad' => $request->id_ciudad,
        ]);
        return back()->with('success', ['message' => 'Persona creada con éxito']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:personas,id',
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'ci' => 'required|string|max:255|unique:personas,ci,' . $request->id,
            'telefono' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:personas,email,' . $request->id,
            'direccion' => 'required|string|max:255',
            'id_ciudad' => 'required|exists:ciudades,id',
        ]);
        Personas::find($request->id)->update([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'ci' => $request->ci,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'id_ciudad' => $request->id_ciudad,
        ]);
        return back()->with('success', ['message' => 'Persona actualizada con éxito']);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:personas,id',
        ]);

        if (Usuarios::where('id_persona', $request->id)->count() > 0) {
            return back()->withErrors(['message' => 'No se puede eliminar la persona porque tiene un usuario asociado']);
        }
        Personas::find($request->id)->delete();
        return back()->with('success', ['message' => 'Persona eliminada con éxito']);
    }
}
