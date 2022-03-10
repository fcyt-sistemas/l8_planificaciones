<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Catedra;

class Planificacion extends Model
{
    use HasFactory;
    protected $table = 'planificaciones';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'sede_id',
        'catedra_id',
        'plan_id',
        'carrera_id',
        'docente_id',
        'anio_academico',
        'anio_academico_obs',
        'equipo_docente',
        'equipo_docente_obs',
        'anio_carrera',
        'anio_carrera_obs',
        'regimen_materia',
        'regimen_materia_obs',
        'carga_horaria',
        'carga_horaria_obs',
        'fundamentacion',
        'fundamentacion_obs',
        'objetivos',
        'objetivos_obs',
        'programa_contenidos',
        'programa_contenidos_obs',
        'metodologia_trabajo',
        'metodologia_trabajo_obs',
        'sistema_evaluacion',
        'sistema_evaluacion_obs',
        'programa_practicos',
        'programa_practicos_obs',
        'bibliografia',
        'bibliografia_obs',
        'requisitos_rendir',
        'requisitos_rendir_obs',
        'cronograma_trabajo',
        'cronograma_trabajo_obs',
        'funciones_equipo',
        'funciones_equipo_obs',
        'cronograma_actividades',
        'cronograma_actividades_obs',
        'mecanismos_autoeval',
        'mecanismos_autoeval_obs',
        'prev_version',
        'prox_version',
        'entregado',
        'fecha_entrega',
        'observado',
        'fecha_observado',
        'aprobado',
        'fecha_aprobado',
        );
    protected $visible = array(
        'sede_id',
        'catedra_id',
        'plan_id',
        'carrera_id',
        'docente_id',
        'anio_academico',
        'anio_academico_obs',
        'equipo_docente',
        'equipo_docente_obs',
        'anio_carrera',
        'anio_carrera_obs',
        'regimen_materia',
        'regimen_materia_obs',
        'carga_horaria',
        'carga_horaria_obs',
        'fundamentacion',
        'fundamentacion_obs',
        'objetivos',
        'objetivos_obs',
        'programa_contenidos',
        'programa_contenidos_obs',
        'metodologia_trabajo',
        'metodologia_trabajo_obs',
        'sistema_evaluacion',
        'sistema_evaluacion_obs',
        'programa_practicos',
        'programa_practicos_obs',
        'bibliografia',
        'bibliografia_obs',
        'requisitos_rendir',
        'requisitos_rendir_obs',
        'cronograma_trabajo',
        'cronograma_trabajo_obs',
        'funciones_equipo',
        'funciones_equipo_obs',
        'cronograma_actividades',
        'cronograma_actividades_obs',
        'mecanismos_autoeval',
        'mecanismos_autoeval_obs',
        'prev_version',
        'prox_version',
        'entregado',
        'fecha_entrega',
        'observado',
        'fecha_observado',
        'aprobado',
        'fecha_aprobado',

        );

    public function docente()
    {
        return $this->belongsTo('App\Models\Docente');
    }

    public function catedra()
    {
        return $this->belongsTo('App\Models\Catedra');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function carrera()
    {
        return $this->belongsTo('App\Models\Carrera');
    }

    public function sede()
    {
        return $this->belongsTo('App\Models\Sede');
    }

    public function scopeWhereSede($query,$sede){
        if($sede!=''){
            $query->where('planificaciones.sede_id',$sede);
        }
    }

    public function scopeAnio($query,$anio_academico){
        if($anio_academico!=''){
            $query->where('planificaciones.anio_academico',$anio_academico);
        }
    }
    
    public function scopeCarrera($query,$carrera){
        if($carrera!=''){
            $query->where('planificaciones.carrera_id',$carrera);
        }
    }

    public function scopeCatedra($query,$catedra){
        if($catedra!=''){
            $query->where('planificaciones.catedra_id',$catedra);
        }
    }

    public function scopePlan($query,$plan){
        if($plan!=''){
            $query->where('planificaciones.plan',$plan);
        }
    }

    public function scopeAsignatura($query,$asignatura){
        if($asignatura!=''){
            $query->join('catedras','planificaciones.catedra_id','=','catedras.id')
                  ->where('catedras.nombre',"LIKE","%$asignatura%")
                  ->select('planificaciones.*'); 
        }
    }
    public function scopeProfesor($query,$profesor){
        if($profesor!=''){
            $query->join('docentes','planificaciones.docente_id','=','docentes.id')
                  ->where('docentes.apellidos',"LIKE","%$profesor%")
                  ->select('planificaciones.*'); 
        }
    }
    public function scopeId($query,$id){
        if($id!=''){
            $query->where('planificaciones.id',$id);
        }
    }
    /*
    public function scopePlani($query,$plani){
        if($plani!=''){
            $query->where('sede_id','carrera_id','catedra_id','anio_academico', 'plan_id')
                  ->select('planificaciones.*');
        }
    }*/
    
    public function scopeAprobada($query,$aprobadas){ 
        if($aprobadas=='on'){
            $query->where('planificaciones.aprobado',true);
        }
    }
    public function scopeRevisada($query,$revisadas){
        if($revisadas=='on'){
            $query->where('planificaciones.observado',true);
        }
    }
    public function scopeEntregada($query,$entregadas){
        if($entregadas=='on'){
            $query->where('planificaciones.entregado',true);
        }
    }
}
