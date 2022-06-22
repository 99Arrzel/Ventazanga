<?php

namespace App\Http\Controllers;

use App\Models\Caracteristicas;
use App\Models\Categorias;
use App\Models\Ciudades;
use App\Models\Imagenes;
use App\Models\Marcas;
use App\Models\Ventas as ModelsVentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Ventas extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $usuario->datos_usuario;
        $usuario->roles;
        $usuario->garantias;
        return Inertia::render('CrearVenta', [
            'usuario' => fn () => $usuario,
            'categorias' => fn () => Categorias::with('posibles_caracteristicas')->get(),
            'ciudades' => fn () => DB::table('ciudades')->get(),
            'marcas' => fn () => DB::table('marcas')->select('id', 'nombre')->get(),
            'mis_ventas' => fn () => ModelsVentas::where('id_vendedor', Auth::user()->id)->with([
                'categoria' => fn ($query) =>
                $query->with('posibles_caracteristicas'),
                'marca' => fn ($query) =>
                $query->select('id', 'nombre'),
                'ciudad' => fn ($query) =>
                $query->select('id', 'nombre'), 'imagenes'
            ])->get()
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
            'precio' => 'required|numeric',
            'categoria' => 'required|exists:categorias,id',
            'ciudad' => 'required',
            'marca' => 'nullable',
            'estado' => 'nullable|numeric',
            'tipo_venta' => 'required|numeric|min:1|max:3',
            'imagenes' => 'required',
            'caracteristicas' => 'nullable|array',
        ]);
        DB::beginTransaction();
        try {
            $venta = ModelsVentas::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'id_categoria' => $request->categoria,
                'id_vendedor' => Auth::user()->id,
                'precio_venta' => $request->precio,
                'id_ciudad' => $request->ciudad,
                'estado_venta' => $request->estado,
                'id_marca' => $request->marca,
                'tipo_venta' => $request->tipo_venta,
            ]);
            /* Cargar imagenes */
            $array = [];
            if ($request->hasFile('imagenes')) {
                $imagenes = $request->file('imagenes');
                foreach ($imagenes as $imagen) {
                    //$nombre = $archivo->getClientOriginalName();

                    $nombre = time() . '_' . $imagen->getClientOriginalName();
                    $imagen->move(public_path() . '/archivos/ventas/', $nombre);
                    $imagen = Imagenes::create([
                        'descripcion' => $request->descripcion,
                        'url' => '/archivos/ventas/' . $nombre,
                    ]);
                    $array[] = $imagen->id;
                }
            }
            /* Sincronizamos array de imagenes con ventas */
            $venta->imagenes()->sync($array);
            /* Cargar caracteristicas */
            $caracteristicas = $request->caracteristicas;
            if (isset($caracteristicas) && count($caracteristicas) > 0) {

                foreach ($caracteristicas as $caracteristica) {
                    Caracteristicas::create([
                        'id_posible_caracteristica' => $caracteristica['id'],
                        'id_venta' => $venta->id,
                        'cantidad' => $caracteristica['cantidad'],
                    ]);
                }
            }


            DB::commit();
            return back()->with('success', 'Venta creada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:ventas,id',
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
            'precio_venta' => 'required|numeric',

        ]);
        $venta = ModelsVentas::find($request->id);
        if (Auth::user()->id != $venta->id_vendedor) {
            return back()->withErrors(['error' => 'No tienes permiso para editar esta venta']);
        }

        DB::beginTransaction();
        try {
            $venta->nombre = $request->nombre;
            $venta->descripcion = $request->descripcion;
            $venta->precio_venta = $request->precio_venta;
            $venta->save();
            DB::commit();
            return back()->with('success', 'Venta actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
