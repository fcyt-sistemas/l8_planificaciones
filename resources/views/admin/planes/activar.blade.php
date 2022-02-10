@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">¡Listado de Planes Inactivos!
                    {{!! Form::open(['action' => 'PlanController@activar','method' => 'POST'])!!}

                    <div class="input-group mb-3">
					<div class="input-group-prepend">
					    <label class="input-group-text" for="carrera_id">Planes:</label>
					  </div>
					  {!! Form::select('planes_id',$planes, null,['id'=>'planes','placeholder'=>'Seleccione un Plan'] ) !!}
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