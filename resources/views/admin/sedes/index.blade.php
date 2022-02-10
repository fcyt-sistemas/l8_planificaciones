@extends('layouts.app')
@section('content')

<div class="container">
     @include('admin.sedes.modal')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between">¡Listado de Sedes!
                    {!! Form::open(['route'=>'sedes','method'=>'GET','class'=>'form-inline','role'=>'search']) !!}
                    <div class="button">
		        		{!!link_to_route('sedes.create', $title = 'Agregar un Plan...', $parameters = null, $attributes = ['class'=>'btn btn-secondary'])!!}
	             	</div>
                    <div class="form-inline">
                        {!! Form::text('sedes',null,['type'=>'search','name'=>'sedes','class'=>'form-control mr-sm-2','placeholder'=>'Buscar Sede']) !!}    
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
                            <div class="col"><b>Sedes</b></div>
                          </div> 
		                </li>
                      @foreach($sedes as $r)
                    <li class="list-group-item"> 
		              <div class="row">
                            <div class="col">{{$r->sedes}}</div>
                        <div class="col">
                        <div class="btn-group">
                                 {!!link_to_action('SedeController@edit', $title = 'Editar', $parameters = $r, $attributes = ['class'=>'btn btn-secondary'])!!}
                                 {!!Form::open(['route'=>['sedes.destroy',$r['id']],'method'=>'DELETE','class' =>'form-inline form-delete'])!!}
								 {!!Form::submit('Deshabilitar!',['class'=>'btn btn-danger delete','name' => 'delete_modal'])!!}
				                 {!!Form::close()!!}
                        </div>
                        </div>
                      </div> 
		            </li>
                       @endforeach
                       <li class="list-group-item">{{$sedes->links()}}</li>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection