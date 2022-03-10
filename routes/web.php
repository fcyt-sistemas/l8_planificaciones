<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanificacionController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\MemoriaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\CatedraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\Auth\ResetPasswordController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/revisor', [ResetPasswordController::class,'resetPassword'])->name('reset');
Route::post('/home/revisor', [ResetPasswordController::class,'resetPassword'])->name('reset');
Route::get('/home/usuario', [ResetPasswordController::class,'resetPassword'])->name('reset');
Route::post('/home/usuario', [ResetPasswordController::class,'resetPassword'])->name('reset');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/perfil/{perfil}',[HomeController::Class,'cambiarPerfil'])->name('perfil');

Route::post('/admin/planificaciones', [PlanificacionController::Class,'index'])->name('planificaciones');
Route::get('/admin/home', [PlanificacionController::Class, 'aprobado'])->name('aprobado');
Route::get('/admin/home', [PlanificacionController::Class, 'revisado'])->name('revisado');
Route::get('/admin/home', [PlanificacionController::Class, 'entregado'])->name('entregado');
Route::get('/admin/home', [PlanificacionController::Class,'index'])->name('index');
Route::get('/planificaciones/{id}/ver', [PlanificacionController::Class,'ver']);
Route::post('/planificaciones/{id}/ver', [PlanificacionController::Class,'ver']);

//botones index planificaciones
Route::post('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.entregado');
Route::get('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.entregado');
Route::post('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.observado');
Route::get('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.observado');
Route::post('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.aprobado');
Route::get('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.aprobado');
Route::post('/admin/planificaciones/revisado', [PlanificacionController::Class, 'show'])->name('boton.ver');
Route::get('/admin/planificaciones/revisado', [PlanificacionController::Class, 'show'])->name('boton.ver');
Route::post('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.revisar');
Route::get('/admin/planificaciones', [PlanificacionController::Class, 'show'])->name('boton.revisar');

Route::get('/planificaciones/{id}/guardar', [PlanificacionController::Class,'guardar']);
Route::get('/planificaciones/{id}/entregar', [PlanificacionController::Class,'entregar']);
Route::get('/planificaciones/{id}/revisar', [PlanificacionController::Class,'revisar']);
Route::get('/planificaciones/{id}/duplicar', [PlanificacionController::Class,'duplicar']);
Route::get('/planificaciones/{id}/copiar',[PlanificacionController::Class,'copiar']);
Route::get('/planificaciones/{id}/aprobar', [PlanificacionController::Class,'aprobar']);
Route::get('/planificaciones/{id}/programa', [PlanificacionController::Class,'pdf'])->name('programa.pdf');
Route::get('/planificaciones/{id}/impresion', [PlanificacionController::Class,'impresion'])->name('planificaciones.impresion');
Route::get('/planificaciones/reporte', [PlanificacionController::Class,'reporte'])->name('reporte.pdf');
Route::get('/memorias/reporte', [MemoriaController::Class,'reporte'])->name('memoria.reporte');

Route::resource('passwords/reset', ResetPasswordController::Class);
Route::resource('planificaciones', PlanificacionController::class);
Route::resource('memorias', MemoriaController::Class);
Route::resource('revisores', RevisorController::Class);
Route::resource('docentes', DocenteController::Class);
Route::resource('usuarios', UserController::class);
Route::resource('catedras', CatedraController::Class);
Route::resource('planes', PlanController::Class);
Route::resource('carreras', CarreraController::Class);
Route::resource('sedes', SedeController::Class);

Route::get('/Mail', [EmailsControllers::Class,'getMail']);

Route::get('revisores',[RevisorController::Class,'index'])->name('revisores');
Route::post('revisores',[RevisorController::Class,'edit'])->name('edit');
//Route::post('revisores',[RevisorController::class,'store']->name('revisores.store'));
Route::get('docentes',[DocenteController::Class,'index'])->name('docentes');
//Route::post('docentes',[DocenteController::class,'store']->name('docentes.store'));
Route::get('usuarios',[UserController::Class,'index'])->name('usuarios');
//Route::post('usuarios',[UserController::class,'store']->name('usuarios.store'));
Route::get('catedras',[CatedraController::Class,'index'])->name('catedras');
//Route::post('catedras',[CatedraController::class,'store']->name('catedras.store'));
Route::get('carreras',[CarreraController::Class,'index'])->name('carreras');
//Route::post('carreras',[CarreraController::class,'store']->name('carreras.store'));
Route::get('sedes',[SedeController::Class,'index'])->name('sedes');
//Route::post('sedes',[SedeController::class,'store']->name('sedes.store'));
Route::get('planes',[PlanController::Class,'index'])->name('planes');
//Route::post('planes',[PlanController::class,'store']->name('planes.store'));

Route::get('/catedras/{id}/activar', [CatedraController::Class,'activar']);

Route::get('/catedras/{id}/desactivar', [CatedraController::Class,'desactivar']);
Route::get('/planes/{id}/activar', [PlanController::Class,'activar']);
Route::get('/planes/{id}/desactivar', [PlanController::Class,'desactivar']);
Route::get('/carreras/{id}/activar', [CarreraController::Class,'activar']);
Route::get('/carreras/{id}/desactivar', [CarreraController::Class,'desactivar']);
Route::get('/sedes/{id}/activar', [SedeController::Class,'activar']);
Route::get('/sedes/{id}/desactivar', [SedeController::Class,'desactivar']);

Route::get('/memorias', [MemoriaController::Class,'index'])->name('memorias');
Route::post('/memorias', [MemoriaController::Class,'index'])->name('memorias');
Route::get('/memorias/{id}/entregar', [MemoriaController::Class,'entregar']);
Route::get('/memorias/{id}/revisar', [MemoriaController::Class,'revisar']);
Route::get('/memorias/{id}/duplicar', [MemoriaController::Class,'duplicar']);
Route::get('/memorias/{id}/aprobar', [MemoriaController::Class,'aprobar']);
Route::get('/memorias/{id}/impresion', [MemoriaController::Class,'impresion'])->name('memoria.impresion');

Route::get('/memorias/carreras/{id}', [MemoriaController::Class,'getCarreras']);
Route::get('/memorias/planes/{id}', [MemoriaController::Class,'getPlanes']);
Route::get('/memorias/catedras/{id}', [MemoriaController::Class,'getCatedras']);
Route::get('/planificaciones/carreras/{id}', [PlanificacionController::Class,'getCarreras']);
Route::get('/planificaciones/planes/{id}', [PlanificacionController::Class,'getPlanes']);
Route::get('/planificaciones/catedras/{id}', [PlanificacionController::Class,'getCatedras']);
Route::get('/carreras/{id}', [PlanificacionController::Class,'getCarreras']);
Route::get('/planes/{id}', [PlanificacionController::Class,'getPlanes']);
Route::get('/catedras/{id}', [PlanificacionController::Class,'getCatedras']);
Route::get('/catedras/{id}', [CatedraController::Class,'getCatedras']);

