@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar datos de la catedra</div>
                  <div class="card-body">

					{!! Form::model($catedras,['route'=>['catedras.update',$catedras->id], 'method' => 'PUT'])!!} 

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
						{!! Form::label('tipo_materia', 'Tipo de Materia:') !!}
						{!! Form::text('tipo_materia') !!}
					</div>
					<div class="form-group">
						{!! Form::label('promovible', 'Promovible:') !!}
						{!! Form::text('promovible') !!}
					</div>
					<div class="form-group">
						{!! Form::label('req_cursada', 'Requiere Cursada:') !!}
						{!! Form::text('req_cursada') !!}
					</div>
					<div class="form-group">
						{!! Form::label('permite_libres', 'Permite Libres:') !!}
						{!! Form::text('permite_libres') !!}
					</div>
					<div class="form-group">
						{!! Form::label('carga_horaria_total', 'Carga Horaria Total:') !!}
						{!! Form::text('carga_horaria_total') !!}
					</div>
					<div class="form-group">
						{!! Form::label('tipo_periodo', 'Tipo Periodo:') !!}
						{!! Form::text('tipo_periodo') !!}
					</div>
					<div class="form-group">
						{!! Form::label('horas_semanales', 'Horas Semanales:') !!}
						{!! Form::text('horas_semanales') !!}
					</div>

					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
			            </div>
			            <div class="btn-group">
  				        	{!!link_to_route('catedras', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
						</div>
		            </div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection