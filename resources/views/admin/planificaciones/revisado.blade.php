@extends('adminlte::page')
@section('content')

<div class="container">
  @include('admin.planificaciones.modal')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header form-inline">
          <h4 class="col-md-9">¡Planificaciones Revisadas!</h4>
        </div>
    
        <div class="card-header justify-content-between">
          <form name="add-blog-post-form" id="add-blog-post-form" method="GET" action="{{url('revisado')}}">
          </div>
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
          {{Session::get('message')}}
        </div>
        @endif
        <div class="card-body" data-form="deleteForm">
          <ul class="list-group list-group-flush">
            @if(($revisado) === 0)
              <div class="alert alert-success" role="alert">
                No hay elementos cargados
              </div>
            @endif
            @foreach($revisado as $p)
                Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b></br>
                <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})</br>
                <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                {{strip_tags($p->equipo_docente)}}</br>
                <div align="right">
                  <div class="btn-group" role="group">
                    <div class="btn-group">
                      <a href="{{ route('boton.ver', $p->id) }}">Ver</a>
                      <a href="{{ route('boton.revisar', $p->id) }}">Revisar</a>
                      @csrf 
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
            <li class="list-group-item">{{$revisado->appends(Request::only(['sede','carrera','asignatura','profesor','entregadas','aprobadas','revisadas', 'anio_academico']))->links()}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>

@endsection