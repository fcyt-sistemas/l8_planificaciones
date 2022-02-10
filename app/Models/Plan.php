<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'planes';
    public $timestamps = true;
    protected $fillable = array('id','unidad_academica','carrera_id','nombre', 'version', 'cant_materias', 'nro_resolucion', 'estado');
    protected $visible = array('id', 'unidad_academica', 'carrera_id', 'nombre', 'version', 'cant_materias', 'nro_resolucion', 'estado');

    public function catedras() {
        return $this
        ->belongsToMany('App\Models\Catedra','plan_catedra')
        ->withTimestamps();
    }
}
