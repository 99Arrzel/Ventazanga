<?php

namespace App\Http\Controllers\PublicViews;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Usuarios;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class Home extends Controller
{
    public function index()
    {

        //llamar categorias y luego productos en estas categorias

        return Inertia::render('Home', [
            'filtros' => FacadesRequest::only(['buscar', 'usuario_buscar', 'categoria']),
            'usuario' =>  function () {
                if (Auth::check()) {

                    $usuario = Auth::user();
                    //Call to methods in usuario
                    $usuario->datos_usuario->ciudad;
                    $usuario->roles;
                    return $usuario;
                }
                return null;
            },
            'categorias' => function () {
                /**
                 * 10 categorías con ventas
                 * Optimizar el select algún día
                 */
                return Categorias::query()->with(['ventas' => function ($query) {
                    $query->with('usuario.datos_usuario', 'imagenes', 'ciudad', 'marca', 'caracteristicas.detalles')
                        ->orderBy('updated_at', 'desc')
                        ->when(FacadesRequest::input('buscar'), function ($query, $buscar) {
                            /* Nested query where */
                            $query->where(function ($query) use ($buscar) {
                                $query->where('nombre', 'like', "%{$buscar}%")
                                    ->orWhere('descripcion', 'like', "%{$buscar}%");
                            });
                        })

                        /* Falta implementar que el usuario está baneado y que no cargue, el fix lo hice en frontend pero no creo que sea bueno */
                        ->when(FacadesRequest::input("usuario_buscar"), function ($query, $u_buscar) {
                            $query->where('id_vendedor', $u_buscar);
                        })
                        ->when(FacadesRequest::input("categoria"), function ($query, $cat) {
                            $query->where('id_categoria', $cat);
                        })
                        ->limit(50); /* Nunca más de 50 resultados por categoria*/
                }])->withCount('ventas')->orderBy('ventas_count', 'DESC')->having('ventas_count', '>', 0)->get();
            },
            'todo_cat' => function () {
                return DB::table('categorias')->select('id', 'nombre', 'id_categoria_padre')->get();
            },

        ]);
    }
    /* Ahora haremos como una api en inertia para obtener más ventas pero especificas respecto al vendedor */
    public function obtenerVentas(Request $request)
    {
        /* Validamos que exista el usuario */
        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
        ]);
        /* El soft delete aplica acá, no dejará cargar si el usuario está dado de baja */
        $usuario = Usuarios::find($request->id)->with('ventas.marca', 'ventas.ciudad', 'ventas.garantia', 'ventas.caracteristicas');
        return $usuario->ventas;
    }
}
