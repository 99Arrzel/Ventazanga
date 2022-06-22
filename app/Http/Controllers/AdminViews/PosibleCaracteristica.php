<?php

namespace App\Http\Controllers\AdminViews;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Posibles_Caracteristicas;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PosibleCaracteristica extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|string|max:255',
            'descripcion' => 'required|min:3|string|max:255',
            'unidad_medida' => 'nullable|string|max:255',
        ]);
        //Validar nombre

        Posibles_Caracteristicas::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'unidad_medida' => $request->unidad_medida,
        ]);
        //Inertia response
        return back()->with('success', 'Característica creada con éxito');
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:posibles_caracteristicas,id',
            'nombre' => 'required|min:3|string|max:255',
            'descripcion' => 'required|min:3|string|max:255',
            'unidad_medida' => 'nullable|string|max:255',
        ]);
        //Actualizar
        Posibles_Caracteristicas::find($request->id)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'unidad_medida' => $request->unidad_medida,
        ]);
        //Inertia response
        return back()->with('success', 'Característica actualizada con éxito');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:posibles_caracteristicas,id',
        ]);
        /* Verificar que no tenga asignado ninguna relación en la tabla categorias_posiblesc */
        
        Posibles_Caracteristicas::find($request->id)->delete();
        return back()->with('success', 'Característica eliminada con éxito');
    }
}
