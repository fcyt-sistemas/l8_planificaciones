<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreras';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','codigo','nombre', 'plan_vigente', 'tipo_carrera', 'nro_resolucion', 'estado');
    protected $visible = array('id','unidad_academica','codigo','nombre', 'plan_vigente', 'tipo_carrera', 'nro_resolucion', 'estado');

    public function planVigente()
    {
        return $this->hasOne('Plan');
    }

    public function revisadaPor()
    {
        return $this->belongsToMany('App\Models\Docente', 'revisores', 'carrera_id', 'docente_id');
    }
    
    public function sedes() {
        return $this
        ->belongsToMany('App\Models\Sede')
        ->withTimestamps();
    }
    
    public function planes() {
        return $this->hasMany('App\Models\Plan');
    }
   
    public function scopeCarrera($query,$carrera){
        if($carrera!=''){
            $query->where('planificaciones.carrera_id',$carrera);
        }
    }
}
