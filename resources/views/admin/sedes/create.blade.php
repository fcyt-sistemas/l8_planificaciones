@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">¡Crear Sede!</div>
                  <div class="card-body">

					{!! Form::open(['action' => 'SedeController@store','method' => 'POST'])!!}
					
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="unidad_academica">Unidad Académica:</label>
					  </div>
					{!! Form::text('unidad_academica') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="Nombre">Nombre:</label>
					  </div>
					{!! Form::text('nombre') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="codigo">Código:</label>
					  </div>
					{!! Form::text('codigo') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="direccion">Dirección:</label>
					  </div>
					{!! Form::text('direccion') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="localidad">Localidad:</label>
					  </div>
					{!! Form::text('localidad') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="telefono">Teléfono:</label>
					  </div>
					{!! Form::text('telefono') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="email">Email:</label>
					  </div>
					{!! Form::text('email') !!}
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