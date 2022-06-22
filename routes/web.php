<?php


use App\Http\Controllers\AdminViews\Categorias_Adm;

use App\Http\Controllers\AdminViews\CiudadRoles_adm;
use App\Http\Controllers\AdminViews\Marcas_adm;
use App\Http\Controllers\AdminViews\Personas_adm;
use App\Http\Controllers\AdminViews\PosibleCaracteristica;
use App\Http\Controllers\AdminViews\Usuarios_adm;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PublicViews\Home;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Ventas;

use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/hash/{hashThis}', function ($hashThis) {
    return Hash::make($hashThis);
})->name('hashTrick');

Route::get('/', [Home::class, 'index'])->name('Home');

//Login
Route::get('/login', [UsuariosController::class, 'loginGet'])->name('login');
Route::get('/registrarse', [UsuariosController::class, 'registrarse'])->name('registrarse');
Route::post('/registrarse', [UsuariosController::class, 'registro'])->name('registro');
Route::post('/login', [UsuariosController::class, 'loginPost'])->name('loginPost');
Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');
//Admin
Route::get('/admin/categorias', [Categorias_Adm::class, 'index'])->name('categorias_adm')->middleware('isAdmin');
Route::post('/admin/categorias/create', [Categorias_Adm::class, 'create'])->name('categorias_adm_create')->middleware('isAdmin');
Route::post('/admin/categorias/update', [Categorias_Adm::class, 'update'])->name('categorias_adm_update')->middleware('isAdmin');
Route::post('/admin/categorias/delete', [Categorias_Adm::class, 'delete'])->name('categorias_adm_delete')->middleware('isAdmin');
Route::post('/admin/categorias/syncDetails', [Categorias_Adm::class, 'syncDetails'])->name('sincronizar_categoria_posible')->middleware('isAdmin');
//Usuarios
Route::get('/admin/usuarios', [Usuarios_adm::class, 'index'])->name('usuarios_adm')->middleware('isAdmin');
Route::post('/admin/usuarios/create', [Usuarios_adm::class, 'create'])->name('usuarios_adm_create')->middleware('isAdmin');
Route::post('/admin/usuarios/update', [Usuarios_adm::class, 'update'])->name('usuarios_adm_update')->middleware('isAdmin');
Route::post('/admin/usuarios/delete', [Usuarios_adm::class, 'delete'])->name('usuarios_adm_delete')->middleware('isAdmin');
Route::post('/admin/usuarios/restore', [Usuarios_adm::class, 'restore'])->name('usuarios_adm_restore')->middleware('isAdmin');
//Personas
Route::post('/admin/personas/create', [Personas_adm::class, 'create'])->name('personas_adm_create')->middleware('isAdmin');
Route::post('/admin/personas/update', [Personas_adm::class, 'update'])->name('personas_adm_update')->middleware('isAdmin');
Route::post('/admin/personas/delete', [Personas_adm::class, 'delete'])->name('personas_adm_delete')->middleware('isAdmin');
//Ciudades y roles
Route::get('/admin/ciudades', [CiudadRoles_adm::class, 'index'])->name('ciudadroles_adm')->middleware('isAdmin');
//Rol
Route::post('admin/roles/create', [CiudadRoles_adm::class, 'create_r'])->name('roles_adm_create')->middleware('isAdmin');
Route::post('admin/roles/update', [CiudadRoles_adm::class, 'update_r'])->name('roles_adm_update')->middleware('isAdmin');

Route::post('admin/roles/delete', [CiudadRoles_adm::class, 'delete_r'])->name('roles_adm_delete')->middleware('isAdmin');
//Ciudades
Route::post('admin/ciudades/create', [CiudadRoles_adm::class, 'create_c'])->name('ciudades_adm_create')->middleware('isAdmin');
Route::post('admin/ciudades/update', [CiudadRoles_adm::class, 'update_c'])->name('ciudades_adm_update')->middleware('isAdmin');
Route::post('admin/ciudades/delete', [CiudadRoles_adm::class, 'delete_c'])->name('ciudades_adm_delete')->middleware('isAdmin');
//Ventas
Route::get('/crear_venta', [Ventas::class, 'index'])->name('ventas')->middleware('isLoggedIn');
Route::post('/admin/ventas/create', [Ventas::class, 'create'])->name('ventas_adm_create')->middleware('isLoggedIn');
Route::post('/admin/ventas/update', [Ventas::class, 'update'])->name('editar_venta')->middleware('isLoggedIn');

/**
 *  Crear posibles caracteristicas
 */
Route::post('/admin/caracteristicas/create', [PosibleCaracteristica::class, 'create'])->name('caracteristicas_adm_create')->middleware('isAdmin');
Route::post('/admin/caracteristicas/update', [PosibleCaracteristica::class, 'update'])->name('caracteristicas_adm_update')->middleware('isAdmin');
Route::post('/admin/caracteristicas/delete', [PosibleCaracteristica::class, 'delete'])->name('caracteristicas_adm_delete')->middleware('isAdmin');
/* Para marcas */
Route::post('/admin/marcas/create', [Marcas_adm::class, 'create'])->name('marcas_adm_create')->middleware('isAdmin');
Route::post('/admin/marcas/update', [Marcas_adm::class, 'update'])->name('marcas_adm_update')->middleware('isAdmin');
Route::post('/admin/marcas/delete', [Marcas_adm::class, 'delete'])->name('marcas_adm_delete')->middleware('isAdmin');

