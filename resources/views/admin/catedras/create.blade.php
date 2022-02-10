@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">¡Crear Materia!</div>
                  <div class="card-body">

					{!! Form::open(['action' => 'CatedraController@store','method' => 'POST'])!!}
					
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
					    <label class="input-group-text" for="tipo_materia">Tipo de Materia:</label>
					  </div>
					{!! Form::text('tipo_materia') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="promovible">Promovible:</label>
					  </div>
					{!! Form::text('promovible') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="req_cursada">Requiere Cursada:</label>
					  </div>
					{!! Form::text('req_cursada') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="permite_libres">Permite Libres:</label>
					  </div>
					{!! Form::text('permite_libres') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="carga_horaria_total">Carga Horaria Total:</label>
					  </div>
					{!! Form::text('carga_horaria_total') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="tipo_periodo">Tipo Periodo:</label>
					  </div>
					{!! Form::text('tipo_periodo') !!}
					</div>
					<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <label class="input-group-text" for="horas_semanales">Horas Semanales:</label>
					  </div>
					{!! Form::text('horas_semanales') !!}
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
					    	<label class="input-group-text" for="catedra_id">Materias:</label>
						</div>
					  	{!! Form::select('estado', $estado,null, ['id'=>'catedras', 'placeholder'=>'Seleccione estado']) !!}
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