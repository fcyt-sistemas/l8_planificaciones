@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">¡Crear Planes!</div>
                  <div class="card-body">

					{!! Form::open(['action' => 'PlanController@store','method' => 'POST'])!!}
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="unidad_academica">Unidad Académica:</label>
					  </div>
					{!! Form::text('unidad_academica') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="carrera_id">Carrera:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['id'=>'carreras','placeholder'=>'Seleccione una carrera'] ) !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="Nombre">Nombre:</label>
					  </div>
					{!! Form::text('nombre') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="version">Versión:</label>
					  </div>
					{!! Form::text('version') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="nro_resolucion">N° Resolución:</label>
					  </div>
					{!! Form::text('nro_resolucion') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="cant_materias">Cantidad de Materias:</label>
					  </div>
					{!! Form::text('cant_materias') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="estado">Estado:</label>
					  </div>
					{!! Form::text('estado') !!}
					</div>
					
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('carreras', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection