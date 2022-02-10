<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Docente;
use Session;
use Redirect;
use Planificacion;
use Memoria;
use DB;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombres = trim($request->get('nombres'));
        $apellidos = trim($request->get('apellidos'));
        $nro_documento = trim($request->get('nro_documento'));
        $localidad = trim($request->get('localidad'));

        $request->user()->authorizeRoles(['admin']);
    
        if($request->user()->hasRole('admin')){
     
          $docentes = Docente::nombre($request->get('nombres'))->apellidos($request->get('apellidos'))->nro_documento($request->get('nro_documento'))->localidad($request->get('localidad'))->orderBy('nombres','DESC')->paginate(5);
       

          return view('admin.docentes.index', ['docentes' => $docentes]);
        
        } 
        else{
            return view('admin.docentes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.docentes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docente = Docente::create($request->all());
        $docente->save;
        Session::flash('message','Docente creado correctamente!');
        return Redirect::to('/docentes');
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
        $docente = Docente::find($id);
        return view('admin.docentes.edit', ['docente' => $docente]);
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
        $docente = Docente::find($id);
        $docente->fill($request->all());
        $docente->save();
        Session::flash('message','Docente actualizado correctamente!');
        return Redirect::to('/docentes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Docente::destroy($id);
        Session::flash('message','Docente eliminado correctamente!');
        return Redirect::to('/docentes');
    }
}
