@section('content')
@extends('layaouts')
@extends('adminlte::page')
<div class="container">
     @include('admin.revisores.modal')
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">¡Usuarios Revisores!
                    <div class="button">
                        <a href="{{ route('revisores.create') }}" class="small-box-footer">Agregar Usuario Revisor <i class="fas fa-arrow-circle-right"></i></a>
	             	</div>
                    <form action="{{route('RevisorController::Class')}}" method="GET"> 
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                        {{Session::get('message')}}
                    </div>
                    @endif
                    <div class="card-body" data-form="deleteForm">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> 
                                <div class="row">
                                  <div class="col"><b>Sede</b></div>
                                  <div class="col"><b>Carrera</b></div>
                                  <div class="col"><b>Docente</b></div>
                                  <div class="col"><b>Anio Academico</b></div>
                                  <div class="col"><b>Acción</b></div>
                                </div> 
                            </li>
                            @foreach($revisores as $r)
                            <li class="list-group-item"> 
		                    <div class="row">
                              <div class="col">{{$r->sede->nombre}}</div>
                              <div class="col">{{$r->carrera->nombre}}</div>
                              @if (empty($r->docente))
                                    @php echo $r->id @endphp
                                @else
                              <div class="col">{{$r->docente->apellidos}}, {{$r->docente->nombres}}</div>
                              @endif
                              <div class="col">
                                    <div class="btn-group">
                                    <a href="{{ route('edit') }}" class="small-box-footer">Editar <i class="fas fa-arrow-circle-right"></i></a> 
                                    <a href="{{ route('destroy') }}" class="small-box-footer" method=>'DELETE'> Eliminar <i class="fas fa-arrow-circle-right"></i></a>      
                                    </div>
                                </div>
                            </div> 
		                   </li>
                            @endforeach
                            <li class="list-group-item">{{$revisores->links()}}</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection