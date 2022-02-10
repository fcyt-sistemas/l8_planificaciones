<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Catedra extends Model
{
    use HasFactory;
    protected $table = 'catedras';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','codigo','nombre', 'tipo_materia', 'promovible', 'req_cursada','permite_libres','carga_horaria_total','tipo_periodo', 'horas_semanales');
    protected $visible = array('id','unidad_academica','codigo','nombre', 'tipo_materia', 'promovible', 'req_cursada','permite_libres','carga_horaria_total','tipo_periodo', 'horas_semanales');

    public function planes() {
        return $this
        ->belongsToMany('App\Models\Plan','plan_catedra')
        ->withTimestamps();
    }

    public function scopeEstado($query,$estado){
        if($estado!=''){
             $query->where('catedras.estado',$estado);
        }
    }
}
