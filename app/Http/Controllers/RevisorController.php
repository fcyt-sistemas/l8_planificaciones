<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Revisor;
use App\Models\Carrera;
use App\Models\Sede;
use App\Models\Docente;
use App\Models\Role;
use App\Models\User;
use Session;
use Redirect;

class RevisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        
        $carrera_id = trim($request->get('carrera_id'));
        $sede_id = trim($request->get('sede_id'));
        $docente_id = trim($request->get('docente_id'));
        $anio_academico = trim($request->get('anio_academico'));
        
        $revisores = Revisor::carrera_id($request->get('carrera_id'))
        ->sede_id($request->get('sede_id'))
        ->docente_id($request->get('docente_id'))
        ->anio($request->get('anio_academico'))
        ->orderBy('sede_id','Asc')->paginate(5);
        
        if($request->user()->hasRole('admin')){
            return view('admin.revisores.index', compact('revisores'));
        }
        else{
            return view('revisor.planificaciones.index', ['revisores' => $revisores]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sedes = Sede::pluck('nombre','id');
        $carreras = Carrera::pluck('nombre', 'id');
        $docentes = DB::table('docentes')
        ->select(DB::raw('CONCAT(apellidos," ",nombres) as nombre_completo, id'))
        ->get()->pluck('nombre_completo', 'id');
        return view('admin.revisores.create', ['sedes' => $sedes,'carreras' => $carreras,'docentes' => $docentes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Permitido solo para administradores
        $request->user()->authorizeRoles(['admin']);
        
        $revisor = Revisor::create($request->all());
        $revisor->save();
        
        //localizo el usuario y veo si tiene el rol de control
        //si no lo tiene se lo agrego
        $usuario = User::where('docente_id', $revisor->docente_id)->first();
        if(!$usuario->hasRole('control')){
            $usuario->roles()->attach(Role::where('name','control')->first());
        };

        Session::flash('message','Revisor asociado correctamente!');
        return Redirect::to('/revisores');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revisor = Revisor::find($id);
        $sedes = Sede::pluck('nombre','id');
        $carreras = Carrera::pluck('nombre', 'id');
        $docentes = DB::table('docentes')
        ->select(DB::raw('CONCAT(apellidos," ",nombres) as nombre_completo, id'))
        ->get()->pluck('nombre_completo', 'id');
        return view('admin.revisores.edit', ['revisor' => $revisor,'sedes' => $sedes,'carreras' => $carreras,'docentes' => $docentes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $revisor = Revisor::find($id);
        $revisor->fill($request->all());
        $revisor->save();
        Session::flash('message','Docente revisor actualizado correctamente!');
        return Redirect::to('/revisores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Revisor::destroy($id);
        Session::flash('message','Docente revisor eliminado/a correctamente!');
        return Redirect::to('/revisores');
    }
}
