<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revisor extends Model
{
    use HasFactory;
    protected $table = 'revisores';
    public $timestamps = true;

    protected $fillable = array(
        'sede_id',
        'carrera_id',
        'docente_id',
    );
    
    protected $visible = array(
        'sede_id',
        'carrera_id',
        'docente_id',
        );
        
    public function docente(){
        return $this->belongsTo('App\Models\Docente');
    }
    
    public function sede(){
        return $this->belongsTo('App\Models\Sede');
    }
    public function carrera() {
        return $this
        ->belongsTo('App\Models\Carrera');
    }
    public function revisorDeCarreras(){
        return $this->belongsToMany('App\Models\Carrera', 'revisores', 'docente_id', 'carrera_id');
    }
    public function revisorDeSedes(){
        return $this->belongsToMany('App\Models\Sede', 'revisores', 'docente_id', 'sede_id');
    }
    public function scopeAnio($query,$anio_academico){
        if($anio_academico!=''){
            $query->where('memorias.anio_academico',$anio_academico);
        }
    }
    public function scopeCarrera_id($query,$carrera_id){
        if(trim($carrera_id!="")){
            $query->where(\DB::raw("CONCAT(carrera_id)"),"LIKE","%$carrera_id%"); 
        }
    }
   public function scopeSede_id($query,$sede_id){
        if(trim($sede_id!="")){
            $query->where(\DB::raw("CONCAT(sede_id)"),"LIKE","%$sede_id%"); 
        }
    }
    public function scopeDocente_id($query,$docente_id){
        if(trim($docente_id!="")){
            $query->where(\DB::raw("CONCAT(docente_id)"),"LIKE","%$docente_id%"); 
        }
    }
}
