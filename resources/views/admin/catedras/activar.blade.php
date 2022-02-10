@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">¡Listado de Materias Inactivas!
                   {!! Form::open(['action' => 'CatedraController@activar','method' => 'POST'])!!}
                                
                    <div class="input-group mb-3">
						<div class="input-group-prepend">
					    	<label class="input-group-text" for="catedra_id">Materias:</label>
						</div>
					  	{!! Form::select('catedra_id', $catedras,null, ['id'=>'catedras', 'placeholder'=>'Seleccione una cátedra']) !!}
					</div>

					<div class="btn-group" role="group">
  			        	<div class="btn-group">
                        	{!! Form::submit('Guardar cambios', ['class'=>'btn btn-primary']) !!}
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