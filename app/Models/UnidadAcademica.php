<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadAcademica extends Model
{
    use HasFactory;
    protected $table = 'unidad_academicas';
    public $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = array('codigo','nombre','direccion','localidad','codigo_postal','telefono','email');
    protected $visible = array('codigo','nombre','direccion','localidad','codigo_postal','telefono','email');
}
