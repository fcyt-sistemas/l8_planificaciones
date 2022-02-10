<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    use HasFactory;
    protected $table = 'sedes';
    public $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = array('codigo','nombre','unidad_academica_id','direccion','localidad','codigo_postal','telefono','email');
    protected $visible = array('codigo','nombre','unidad_academica_id','direccion','localidad','codigo_postal','telefono','email');

    public function unidadAcademica()
    {
        return $this->belongsTo('App\Models\UnidadAcademica');
    }
    
    public function carreras() {
        return $this
        ->belongsToMany('App\Models\Carrera')
        ->withTimestamps();
    }
}
