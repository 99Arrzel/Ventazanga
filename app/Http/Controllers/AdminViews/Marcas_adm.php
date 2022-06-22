<?php

namespace App\Http\Controllers\AdminViews;

use App\Http\Controllers\Controller;
use App\Models\Marcas;
use Illuminate\Http\Request;

class Marcas_adm extends Controller
{
    //
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:marcas',
        ]);
        Marcas::create([
            'nombre' => $request->nombre,
        ]);
        return back()->with('success', ['message' => 'Marca creada con éxito']);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:marcas,id',
            'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $request->id,
        ]);
        $marca = Marcas::withTrashed()->where('id', $request->id)->first();
        $marca->update([
            'nombre' => $request->nombre,
        ]);
        return back()->with('success', 'Marca actualizada con éxito');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:marcas,id',
        ]);
        $marca = Marcas::withTrashed()->where('id', $request->id)->first();
        if ($marca->deleted_at != null) {
            $marca->restore();
            return back()->with('success', 'Marca restaurada con éxito');
        }
        $marca->delete();
        return back()->with('success', 'Marca eliminada con éxito');
    }
}
