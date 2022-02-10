@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar datos del plan</div>
                  <div class="card-body">

					{!! Form::model($planes,['route'=>['planes.update',$planes->id], 'method' => 'PUT'])!!} 

					<div class="form-group">
						{!! Form::label('unidad_academica', 'Unidad Académica:') !!}
						{!! Form::text('unidad_academica') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="sede_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['placeholder'=>'Seleccione una carrera'] ) !!}
					</div>
					<div class="form-group">
						{!! Form::label('nombre', 'Nombre:') !!}
						{!! Form::text('nombre') !!}
					</div>
					<div class="form-group">
						{!! Form::label('version', 'Versión:') !!}
						{!! Form::text('version') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nro_resolucion', 'N° Resolución:') !!}
						{!! Form::text('nro_resolucion') !!}
					</div>
					<div class="form-group">
						{!! Form::label('cant_materias', 'Cantidad de Materias:') !!}
						{!! Form::text('cant_materias') !!}
					</div>
					<div class="form-group">
						{!! Form::label('estado', 'Estado:') !!}
						{!! Form::text('estado') !!}
					</div>
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('planes', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection