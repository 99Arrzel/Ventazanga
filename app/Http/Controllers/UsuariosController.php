<?php

namespace App\Http\Controllers;

use App\Models\Ciudades;
use App\Models\Personas;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(Request $request)
    {
        /* Custom validator */
        Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:personas,email',
            'ci' => 'required|max:255|unique:personas,ci',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario',
            'nombre' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'ciudad' => 'required|integer|exists:ciudades,id',
            'telefono' => 'required|max:255|min:8|max:8',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
        ], [
            'email.required' => 'El email es requerido',
            'email.string' => 'El email debe ser una cadena de texto',
            'email.email' => 'El email debe ser un email válido',
            'email.max' => 'El email debe tener máximo 255 caracteres',
            'email.unique' => 'El email ya existe',
            'ci.required' => 'El ci es requerido',
            'ci.max' => 'El ci debe tener máximo 255 caracteres',
            'ci.unique' => 'El ci ya existe',
            'usuario.required' => 'El usuario es requerido',
            'usuario.string' => 'El usuario debe ser una cadena de texto',
            'usuario.max' => 'El usuario debe tener máximo 255 caracteres',
            'usuario.unique' => 'El usuario ya existe',
            'nombre.required' => 'El nombre es requerido',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.max' => 'El nombre debe tener máximo 255 caracteres',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'ciudad.required' => 'La ciudad es requerida',
            'ciudad.integer' => 'La ciudad debe ser un número entero',
            'ciudad.exists' => 'La ciudad no existe',
            'telefono.required' => 'El teléfono es requerido',

            'telefono.max' => 'El teléfono debe tener máximo 255 caracteres',
            'apellido_p.required' => 'El apellido paterno es requerido',
            'apellido_p.string' => 'El apellido paterno debe ser una cadena de texto',
            'apellido_p.max' => 'El apellido paterno debe tener máximo 255 caracteres',
            'apellido_m.required' => 'El apellido materno es requerido',
            'apellido_m.string' => 'El apellido materno debe ser una cadena de texto',
            'apellido_m.max' => 'El apellido materno debe tener máximo 255 caracteres',
        ])->validate();


        DB::beginTransaction();
        try {

            /* Creo la persona */
            $persona = Personas::create([
                'nombre' => $request->nombre,
                'apellido_p' => $request->apellido_p,
                'apellido_m' => $request->apellido_m,
                'ci' => $request->ci,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'id_ciudad' => $request->ciudad,
            ]);
            /* Creo el usuario */
            Usuarios::create([
                'usuario' => $request->usuario,
                'password' => Hash::make($request->password),
                'id_persona' => $persona->id,
                'id_rol' => 2,
            ]);
            /* Redirijo a la página de inicio */
            DB::commit();
            return Redirect::back()->with('success', 'Usuario creado correctamente');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['Error al registrar el usuario']);
        }
    }
    public function registrarse()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return Inertia::render('Registro', [
            'ciudades' => function () {
                return Ciudades::all();
            },
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Default create as user
    public function create(Request $request)
    {
        $request->validate([
            'usuario' => 'required|unique:usuarios',
            'password' => 'required',
            'id_persona' => 'required',
        ]);
        Usuarios::create([
            'usuario' => $request->usuario,
            'password' => bcrypt($request->password),
            'id_rol' => 2,
            'id_persona' => $request->id_persona,
        ]);
    }
    public function loginGet()
    {
        if (Auth::check()) {
            return Redirect::to('/');
        }
        return Inertia::render('Login');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);
        //Use auth attempt and login
        if (!Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            return Inertia::render('Login', [
                'error' => 'Usuario o contraseña incorrectos',
            ]);
        }
        return Redirect('/'); //Aqui le pasamos los props del usuario básicos
    }
    public function logout()
    {
        Auth::logout();
        return Redirect('/');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
