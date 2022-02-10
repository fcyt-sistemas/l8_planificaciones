@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">¡Crear Carrera!</div>
                  <div class="card-body">

					{!! Form::open(['action' => 'CarreraController@store','method' => 'POST'])!!}
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="unidad_academica">Unidad Académica:</label>
					  </div>
					{!! Form::text('unidad_academica') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="codigo">Código:</label>
					  </div>
					{!! Form::text('codigo') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="Nombre">Nombre:</label>
					  </div>
					{!! Form::text('nombre') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="plan_vigente">Plan Vigente:</label>
					  </div>
					{!! Form::text('plan_vigente') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="tipo_carrera">Tipo de Carrera:</label>
					  </div>
					{!! Form::text('tipo_carrera') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="nro_resolucion">N° Resolución:</label>
					  </div>
					{!! Form::text('nro_resolucion') !!}
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