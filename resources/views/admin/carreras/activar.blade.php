@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">¡Listado de Carreras Inactivas!
                    {{!! Form::open(['action' => 'CarrerasController@activar','method' => 'POST'])!!}

                    <div class="input-group mb-3">
					<div class="input-group-prepend">
					    <label class="input-group-text" for="carrera_id">Carreras:</label>
					  </div>
					  {!! Form::select('carrera_id',$carreras, null,['id'=>'carreras','placeholder'=>'Seleccione una carrera'] ) !!}
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