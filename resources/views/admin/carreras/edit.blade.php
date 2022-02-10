@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar datos de la carrera</div>
                  <div class="card-body">

					{!! Form::model($carreras,['route'=>['carreras.update',$carreras->id], 'method' => 'PUT'])!!} 

					<div class="form-group">
						{!! Form::label('unidad_academica', 'Unidad Académica:') !!}
						{!! Form::text('unidad_academica') !!}
					</div>
					<div class="form-group">
						{!! Form::label('codigo', 'Código:') !!}
						{!! Form::text('codigo') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nombre', 'Nombre:') !!}
						{!! Form::text('nombre') !!}
					</div>
					<div class="form-group">
						{!! Form::label('plan_vigente', 'Plan Vigente:') !!}
						{!! Form::text('plan_vigente') !!}
					</div>
					<div class="form-group">
						{!! Form::label('tipo_carrera', 'Tipo de Carrera:') !!}
						{!! Form::text('tipo_carrera') !!}
					</div>
					<div class="form-group">
						{!! Form::label('nro_resolucion', 'N° Resolución:') !!}
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