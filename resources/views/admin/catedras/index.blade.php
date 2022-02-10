@extends('layouts.app')
@section('content')
<div class="container">
     @include('admin.catedras.modal')
     @include('admin.catedras.activar')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">¡Listado de Materias!
                    {!! Form::open(['route'=>'catedras','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                    <div class="button">
		        		{!!link_to_route('catedras.create', $title = 'Agregar una Materia...', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
	             	</div>
                    <div class="btn-group">
                        {!!link_to_route('catedras.activar', $title = 'Activar una Materia...', $parameters = $p->id, $attributes = ['class'=>'btn btn-success'])!!} 
                    </div>
                    <div class="form-inline">
                        {!! Form::text('catedras',null,['type'=>'search','name'=>'catedras','class'=>'form-control mr-sm-2','placeholder'=>'Buscar Materia']) !!}
                    </div>
                    
                    <button class="btn btn-default my-2 my-sm-0"type="submit">Buscar</button>
                    {!! Form::close() !!}
                </div>


                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                  {{Session::get('message')}}
                </div>
                @endif
                <div class="card-body" data-form="deleteForm">
                        <li class="list-group-item"> 
                          <div class="row">
                            <div class="col"><b>Materias</b></div>
                          </div> 
		                </li>
                      @foreach($catedras as $r)
                    <li class="list-group-item"> 
		              <div class="row">
                        <div class="col">
                            <div class="btn-group">
                                 {!!link_to_action('CatedraController@edit', $title = 'Editar', $parameters = $r, $attributes = ['class'=>'btn btn-secondary'])!!}
								 {!!link_to_action('CatedraController@desactivar', $title = 'Desactivar!', $parameters = $p->id, $attributes = ['class'=>'btn btn-success'])!!}	
                            </div>
                        </div>
                      </div> 
		            </li>
                       @endforeach
                       <li class="list-group-item">{{$catedras->links()}}</li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection