<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    public $timestamps = true;
    protected $fillable = array(
        'unidad_academica',
        'legajo',
        'tipo_documento',
        'nro_documento',
        'apellidos',
        'nombres',
        'sexo',
        'nacionalidad',
        'fecha_nacimiento',
        'e-mail',
        'domicilio',
        'localidad');
    protected $visible = array(
        'unidad_academica',
        'legajo',
        'tipo_documento',
        'nro_documento',
        'apellidos',
        'nombres',
        'sexo',
        'nacionalidad',
        'fecha_nacimiento',
        'e-mail',
        'domicilio',
        'localidad'
        );

    public function revisorDeCarreras(){
        return $this->belongsToMany('App\Models\Carrera', 'revisores', 'docente_id', 'carrera_id');
    }
    public function revisorDeSedes(){
        return $this->belongsToMany('App\Models\Sede', 'revisores', 'docente_id', 'sede_id');
    }
    
    public function scopeApellidos($query,$apellidos){
        if(trim($apellidos!="")){
            $query->where(\DB::raw("CONCAT(apellidos)"),"LIKE","%$apellidos%%"); 
        }
    }
     public function scopeNombre($query,$nombres){
        if(trim($nombres!="")){
            $query->where(\DB::raw("CONCAT(nombres)"),"LIKE","%$nombres%"); 
        }
    }
     public function scopeNro_Documento($query,$nro_documento){
        if(trim($nro_documento!="")){
            $query->where(\DB::raw("CONCAT(nro_documento)"),"LIKE","%$nro_documento%"); 
        }
    }
    public function scopeLocalidad($query,$localidad){
        if(trim($localidad!="")){
            $query->where(\DB::raw("CONCAT(localidad)"),"LIKE","%$localidad%"); 
        }
    }
}
