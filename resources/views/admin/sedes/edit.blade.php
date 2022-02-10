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
					<div class="form-group">
						{!! Form::label('codigo', 'Codigo:') !!}
						{!! Form::text('codigo') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nombre', 'Nombre:') !!}
						{!! Form::text('nombre') !!}
					</div>
					<div class="form-group">
						{!! Form::label('direccion', 'Dirección:') !!}
						{!! Form::text('direccion') !!}
					</div>
					<div class="form-group">
						{!! Form::label('localidad', 'Localidad:') !!}
						{!! Form::text('localidad') !!}
					</div>
					<div class="form-group">
						{!! Form::label('codigo_postal', 'Código Postal:') !!}
						{!! Form::text('codigo_postal') !!}
					</div>
					<div class="form-group">
						{!! Form::label('telefono', 'Teléfono:') !!}
						{!! Form::text('telefono') !!}
					</div>
					<div class="form-group">
						{!! Form::label('e-mail', 'E-mail') !!}
						{!! Form::text('e-mail') !!}
					</div>
					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('sedes', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection