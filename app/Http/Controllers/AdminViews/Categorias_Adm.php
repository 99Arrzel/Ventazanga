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

class Categorias_Adm extends Controller
{
    public function syncDetails(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categorias,id',
            'valores' => 'nullable|array',
        ]);
        $categoria = Categorias::find($request->id);
        $categoria->posibles_caracteristicas()->sync($request->valores);
        return back();
    }
    public function index()
    {

        $usuario = Auth::user();
        //Call to methods in usuario
        $usuario->datos_usuario->ciudad;
        $usuario->roles;
        return Inertia::render('Adm/Categorias', [
            'categorias' => fn () => Categorias::with('posibles_caracteristicas')->get(),
            'usuario' =>  fn () => $usuario,
            'posibles_caracteristicas' => fn () => Posibles_Caracteristicas::all(),
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'id_categoria_padre' => 'nullable',
        ]);
        //Validar nombre
        $ocurrencias = Categorias::where('nombre', strtolower($request->nombre))
            ->where('id_categoria_padre', $request->id_categoria_padre)->count();
        if ($ocurrencias > 0) {
            return back()->withErrors(['message' => 'Ya existe una categoría con el mismo nombre en el mismo padre']);
        }
        Categorias::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_categoria_padre' => $request->id_categoria_padre,
        ]);
        //Inertia response?
        return back()->with('success', ['message' => 'Categoría creada con éxito']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',

        ]);
        $categoria = Categorias::find($request->id);
        /* Validamos que no haya uno repetido para el mismo padre*/
        $ocurrencias = Categorias::where('nombre', strtolower($request->nombre))
            ->where('id_categoria_padre', $categoria->id_categoria_padre)->where('id', '!=', $request->id)->count();
        if ($ocurrencias > 0) {
            return back()->withErrors(['message' => 'Ya existe una categoría con el mismo nombre en el mismo padre']);
        }
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return back()->with('success', ['message' => 'Categoría actualizada con éxito']);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $categoria = Categorias::findOrFail($request->id);
        $categoria->hijos;

        if ($categoria->hijos->count() > 0) {
            //Inertia error redirect
            return Redirect::route('categorias_adm')->withErrors(['message' => 'La categoria tiene subcategorias, no se puede eliminar']);
        }
        $ocurrencias = Categorias::whereHas('posibles_caracteristicas', function ($query) use ($request) {
            $query->where('id_categoria', $request->id);
        })->count();
        if ($ocurrencias > 0) {
            return back()->withErrors(['message' => 'No se puede eliminar la categoría porque tiene características asociadas']);
        }
        $categoria->delete();
        return back()->with('success', ['message' => 'Categoría eliminada con éxito']);
    }
}
