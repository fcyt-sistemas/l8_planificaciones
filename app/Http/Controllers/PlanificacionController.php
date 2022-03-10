<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Planificacion;
use App\Models\Catedra;
use App\Models\Plan;
use App\Models\Carrera;
use App\Models\Sede;
use App\Http\Requests\CreatePlanificacionRequest;
use Session;
use Redirect;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;

class PlanificacionController extends Controller
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
        $estado = trim($request->get('estado'));
        $materia = trim($request->get('materia'));

        $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);
        $anios = Planificacion::pluck('anio_academico')->unique()->sort();
        $anio_academico = array();

        $sedes = Sede::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');

      
        $planificaciones = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->entregada($request->get('entregadas'))
        ->aprobada($request->get('aprobadas'))
        ->revisada($request->get('revisadas'))
        ->anio($request->get('anio_academico'))
        ->paginate(10);
    
        foreach ($anios as $anio){
            $anio_academico[$anio] = $anio;
        }

        if ($request->user()->hasRole('admin')) {
            return view('admin.planificaciones.index', ['planificaciones' => $planificaciones, 'sedes' => $sedes, 'carreras' => $carreras, 'anio_academico' => $anio_academico]);
        }elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {

            foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
                $idcarreras[] = $carrera->id;
                $carreras[$carrera->id] = $carrera->nombre;
            }
            foreach ($request->user()->docente->revisorDeSedes as $sede){
                $idsedes[] = $sede->id;
                $sedes[$sede->id] = $sede->nombre;
            }
      
            $planificaciones = Planificacion::whereSede($request->get('sede'))
            ->carrera($request->get('carrera'))
            ->anio($request->get('anio_academico'))
            ->asignatura($request->get('asignatura'))
            ->profesor($request->get('profesor'))
            ->entregada($request->get('entregadas'))
            ->aprobada($request->get('aprobadas'))
            ->revisada($request->get('revisadas'))
            ->whereIn('carrera_id', $idcarreras)
            ->whereIn('sede_id', $idsedes)
            ->whereRaw('entregado is true and prox_version is null')
            ->paginate(10);

            return view('revisor.planificaciones.index', ['planificaciones' => $planificaciones, 'sedes' => $sedes, 'carreras' => $carreras, 'anio_academico' => $anio_academico]);
        } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
            $planificaciones = Planificacion::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
            ->paginate(10);  
            return view('usuario.planificaciones.index', ['planificaciones' => $planificaciones, 'sedes' => $sedes, 'carreras' => $carreras, 'anio_academico' => $anio_academico]);
        } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura'){
            $sedes = Sede::pluck('nombre', 'id');
            $carreras = Carrera::pluck('nombre', 'id');
            $anios = Planificacion::pluck('anio_academico')->unique()->sort();
            $anio_academico = array();
            foreach ($anios as $anio) {
                $anio_academico[$anio] = $anio;
            }
            
            $planificaciones = Planificacion::whereSede($request->get('sede'))
            ->carrera($request->get('carrera'))
            ->anio($request->get('anio_academico'))
            ->asignatura($request->get('asignatura'))
            ->profesor($request->get('profesor'))
            ->entregada($request->get('entregadas'))
            ->aprobada($request->get('aprobadas'))
            ->revisada($request->get('revisadas'))
            ->anio($request->get('anio_academico'))
            ->paginate(10);
            return view('lectura.planificaciones.index', ['planificaciones' => $planificaciones, 'sedes' => $sedes, 'carreras' => $carreras, 'anio_academico' => $anio_academico]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');
        return view('usuario.planificaciones.create', ['catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
    }

    public function duplicar($id)
    {
        $old_plani = Planificacion::find($id);
        $planificaciones = $old_plani->replicate();
        $planificaciones->observado = null;
        $planificaciones->fecha_observado = null;
        $planificaciones->prev_version = $old_plani->id;
        $planificaciones->push();
        $planificaciones->save();
        $old_plani->prox_version = $planificaciones->id;
        $old_plani->save();
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');
        return view('usuario.planificaciones.edit', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
    }


    public function copiar($id)
    {
        $old_plani = Planificacion::find($id);
  
        $planificaciones = $old_plani->replicate();
        $planificaciones->observado = null;
        $planificaciones->fecha_observado = null;
        $planificaciones->entregado = null;
        $planificaciones->aprobado = null;
        $planificaciones->fecha_entrega = null;
        $planificaciones->fecha_aprobado = null;
    
        $planificaciones->push();
        $planificaciones->save();

    
        $old_plani->save();
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');

        $anios = Planificacion::pluck('anio_academico')->unique()->sort();
        $anio_academico = array();
        foreach ($anios as $anio) {
            $anio_academico[$anio] = $anio;
        }

        return view('usuario.planificaciones.copiar', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlanificacionRequest $request)
    {
        $plani = Planificacion::create($request->all());
        Session::flash('message', 'Planificación creada correctamente!');
        return Redirect::to('/planificaciones');
    }

    public function entregar($id)
    {
        $planificaciones = Planificacion::find($id);
        $planificaciones->fecha_entrega = new DateTime;
        $planificaciones->entregado = true;
        $planificaciones->save();
        Session::flash('message', 'Planificación entregada correctamente!');
        return Redirect::to('/planificaciones');
    }

    public function aprobar($id)
    {
        $planificaciones = Planificacion::find($id);
        $planificaciones->fecha_aprobado = new DateTime;
        $planificaciones->aprobado = true;
    
        $planificaciones->anio_academico_obs = null;
        $planificaciones->equipo_docente_obs = null;
        $planificaciones->anio_carrera_obs = null;
        $planificaciones->regimen_materia_obs = null;
        $planificaciones->carga_horaria_obs = null;
        $planificaciones->fundamentacion_obs = null;
        $planificaciones->objetivos_obs = null;
        $planificaciones->programa_contenidos_obs = null;
        $planificaciones->metodologia_trabajo_obs = null;
        $planificaciones->sistema_evaluacion_obs = null;
        $planificaciones->programa_practicos_obs = null;
        $planificaciones->bibliografia_obs = null;
        $planificaciones->requisitos_rendir_obs = null;
        $planificaciones->cronograma_trabajo_obs = null;
        $planificaciones->funciones_equipo_obs = null;
        $planificaciones->cronograma_actividades_obs = null;
        $planificaciones->mecanismos_autoeval_obs = null;
    
        $planificaciones->save();
        Session::flash('message', 'La planificacion ha sido aprobada!');
        return Redirect::to('/planificaciones');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $planificaciones = Planificacion::find($id);
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');
        if (Auth::user()->hasRole('admin')) {
            return view('admin.planificaciones.show', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
            return view('revisor.planificaciones.show', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
            return view('usuario.planificaciones.show', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura') {
            return view('lectura.planificaciones.show', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        }
    }

    public function revisar($id)
    {
        $planificaciones = Planificacion::find($id);
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');
        if (Auth::user()->hasRole('admin')) {
           return view('admin.planificaciones.review', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        } elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {
            return view('revisor.planificaciones.review', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
            return view('usuario.planificaciones.show', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planificaciones = Planificacion::find($id);
        $catedras = Catedra::pluck('nombre', 'id');
        $planes = Plan::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
        $sedes = Sede::pluck('nombre', 'id');
        return view('usuario.planificaciones.edit', ['planificaciones' => $planificaciones, 'catedras' => $catedras, 'planes' => $planes, 'carreras' => $carreras, 'sedes' => $sedes]);
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
        //dd($request->all());
        $planificaciones = Planificacion::find($id);
        $planificaciones->fill($request->all());
        $planificaciones->save();
        Session::flash('message', 'Planificacion actualizada correctamente!');
        return Redirect::to('/planificaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Planificacion::destroy($id);
        Session::flash('message', 'Planificación eliminada correctamente!');
        return Redirect::to('/planificaciones');
    }
    public function pdf($id)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::find($id);

    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $image = base64_encode(file_get_contents(public_path('/images/logo-tr.png')));
    return PDF::loadView('admin.planificaciones.pdf2', ['image' => $image, 'planificaciones' => $planificaciones])->stream('programa.pdf');
  }
  public function reporte(Request $request)
  {
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::whereSede($request->get('sede'))
    ->carrera($request->get('carrera'))
    ->asignatura($request->get('asignatura'))
    ->profesor($request->get('profesor'))
    ->anio($request->get('anio_academico'))
    ->get();
    PDF::setOptions(['defaultFont' => 'sans-serif']);
    $image = base64_encode(file_get_contents(public_path('/images/logo-tr.png')));
    return PDF::loadView('admin.planificaciones.reporte', ['image' => $image, 'planificaciones' => $planificaciones])->stream('planificaciones.pdf');
  }

  public function impresion($id)
  {
    /**
     * Impresión de versiones impresas completas de planificaciones
     **/
    /**
     * toma en cuenta que para ver los mismos
     * datos debemos hacer la misma consulta
     **/
    $planificaciones = Planificacion::find($id);
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    $image = base64_encode(file_get_contents(public_path('/images/logo-tr.png')));
    return PDF::loadView('admin.planificaciones.impresion', ['image' => $image, 'planificaciones' => $planificaciones])->stream($planificaciones->catedra->nombre . '-' . $planificaciones->anio_academico . '.pdf');
  }

  public function aprobado(Request $request){
      $estado = Trim($request->get('estado'));
      $materia = trim($request->get('materia'));

        $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);
        $anios = Planificacion::pluck('anio_academico')->unique()->sort();
        $anio_academico = array();

        $sedes = Sede::pluck('nombre', 'id');
        $carreras = Carrera::pluck('nombre', 'id');
      
        $aprobado = Planificacion::whereSede($request->get('sede'))
        ->carrera($request->get('carrera'))
        ->asignatura($request->get('asignatura'))
        ->profesor($request->get('profesor'))
        ->aprobada($request->get('aprobadas'))
        ->anio($request->get('anio_academico'))
        ->paginate(10);
    
        foreach ($anios as $anio){
            $anio_academico[$anio] = $anio;
        }
        if ($request->user()->hasRole('admin')) {
                $aprobado=Planificacion::Aprobada($request->get('aprobadas'))->paginate(5);
                return view('admin.planificaciones.aprobado', compact('aprobado', 'sedes' , 'carreras', 'anio_academico'));
 
        }elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {

            foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
                $idcarreras[] = $carrera->id;
                $carreras[$carrera->id] = $carrera->nombre;
            }
            foreach ($request->user()->docente->revisorDeSedes as $sede){
                $idsedes[] = $sede->id;
                $sedes[$sede->id] = $sede->nombre;
            }
            return view('revisor.planificaciones.aprobado', compact('aprobado', 'sedes' , 'carreras', 'anio_academico'));
             
        } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
            $aprobado = Planificacion::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
            ->paginate(10);  
            return view('usuario.planificaciones.aprobado', compact('aprobado', 'sedes' , 'carreras', 'anio_academico'));
        } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura'){
            $sedes = Sede::pluck('nombre', 'id');
            $carreras = Carrera::pluck('nombre', 'id');
            $anios = Planificacion::pluck('anio_academico')->unique()->sort();
            $anio_academico = array();
            foreach ($anios as $anio) {
                $anio_academico[$anio] = $anio;
            }
            return view('lectura.planificaciones.aprobado', compact('aprobado', 'sedes' , 'carreras', 'anio_academico'));
        }
  }

  public function revisado(Request $request){
    $estado = Trim($request->get('estado'));
    $materia = trim($request->get('materia'));

      $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();

      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
    
      $revisado = Planificacion::whereSede($request->get('sede'))
      ->carrera($request->get('carrera'))
      ->asignatura($request->get('asignatura'))
      ->profesor($request->get('profesor'))
      ->revisada($request->get('revisadas'))
      ->anio($request->get('anio_academico'))
      ->paginate(10);
  
      foreach ($anios as $anio){
          $anio_academico[$anio] = $anio;
      }
      if ($request->user()->hasRole('admin')) {
              return view('admin.planificaciones.revisado', compact('revisado', 'sedes' , 'carreras', 'anio_academico'));

      }elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {

          foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
              $idcarreras[] = $carrera->id;
              $carreras[$carrera->id] = $carrera->nombre;
          }
          foreach ($request->user()->docente->revisorDeSedes as $sede){
              $idsedes[] = $sede->id;
              $sedes[$sede->id] = $sede->nombre;
          }
          return view('revisor.planificaciones.revisado', compact('revisado', 'sedes' , 'carreras', 'anio_academico'));
           
      } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
          $revisado = Planificacion::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
          ->paginate(10);  
          return view('usuario.planificaciones.revisado', compact('revisado', 'sedes' , 'carreras', 'anio_academico'));
      } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura'){
          $sedes = Sede::pluck('nombre', 'id');
          $carreras = Carrera::pluck('nombre', 'id');
          $anios = Planificacion::pluck('anio_academico')->unique()->sort();
          $anio_academico = array();
          foreach ($anios as $anio) {
              $anio_academico[$anio] = $anio;
          }
          return view('lectura.planificaciones.revisado', compact('revisado', 'sedes' , 'carreras', 'anio_academico'));
        }
}

    public function entregado(Request $request){
        $estado = Trim($request->get('estado'));
        $materia = trim($request->get('materia'));
 
      $request->user()->authorizeRoles(['user', 'admin', 'control', 'lectura']);
      $anios = Planificacion::pluck('anio_academico')->unique()->sort();
      $anio_academico = array();

      $sedes = Sede::pluck('nombre', 'id');
      $carreras = Carrera::pluck('nombre', 'id');
    
      $entregado = Planificacion::whereSede($request->get('sede'))
      ->carrera($request->get('carrera'))
      ->asignatura($request->get('asignatura'))
      ->profesor($request->get('profesor'))
      ->entregada($request->get('entregadas'))
      ->anio($request->get('anio_academico'))
      ->paginate(10);
  
      foreach ($anios as $anio){
          $anio_academico[$anio] = $anio;
      }
      if ($request->user()->hasRole('admin')) {
              return view('admin.planificaciones.entregado', compact('entregado', 'sedes' , 'carreras', 'anio_academico'));

      }elseif (Auth::user()->hasRole('control') && \Session::get('tipoUsuario') == 'control') {

          foreach ($request->user()->docente->revisorDeCarreras as $carrera) {
              $idcarreras[] = $carrera->id;
              $carreras[$carrera->id] = $carrera->nombre;
          }
          foreach ($request->user()->docente->revisorDeSedes as $sede){
              $idsedes[] = $sede->id;
              $sedes[$sede->id] = $sede->nombre;
          }
          return view('revisor.planificaciones.entregado', compact('entregado', 'sedes' , 'carreras', 'anio_academico'));
           
      } elseif (Auth::user()->hasRole('user') && \Session::get('tipoUsuario') == 'user') {
          $entregado = Planificacion::whereRaw('docente_id =' . $request->user()->docente->id . ' and prox_version is null')
          ->paginate(10);  
          return view('usuario.planificaciones.entregado', compact('entregado', 'sedes' , 'carreras', 'anio_academico'));
      } elseif (Auth::user()->hasRole('lectura') && \Session::get('tipoUsuario') == 'lectura'){
          $sedes = Sede::pluck('nombre', 'id');
          $carreras = Carrera::pluck('nombre', 'id');
          $anios = Planificacion::pluck('anio_academico')->unique()->sort();
          $anio_academico = array();
          foreach ($anios as $anio) {
              $anio_academico[$anio] = $anio;
          }
          return view('lectura.planificaciones.entregado', compact('entregado', 'sedes' , 'carreras', 'anio_academico'));
        }
    }

  public function getCarreras($id)
  {
    return Sede::where('id', '=', $id)->first()->carreras;
  }
  public function getPlanes($id)
  {
    return Carrera::where('id', '=', $id)->first()->planes;
  }
  public function getCatedras($id)
  {
    return Plan::where('id', '=', $id)->first()->catedras;
  }
}
