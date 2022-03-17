@extends('adminlte::page')
@section('content')

<div class="container">
  @include('admin.planificaciones.modal')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header form-inline">
          <h4 class="col-md-9">¡Planificaciones cargadas!</h4>
        </div>
    
        <div class="card-header justify-content-between">
          <form name="add-blog-post-form" id="add-blog-post-form" method="GET" action="{{url('planificaciones')}}">
        </div>
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
          {{Session::get('message')}}
        </div>
        @endif
        <div class="card-body" data-form="deleteForm">
          <ul class="list-group list-group-flush">
            @if(($planificaciones) === 0)
              <div class="alert alert-success" role="alert">
                No hay elementos cargados
              </div>
            @endif
            @foreach($planificaciones as $p)
            <li class="list-group-item">
            @if($p->entregado)
              <form action="{{ url('boton.entregado', $p->id) }}" method="GET" >
                @csrf
                <button class="btn">
                  <i class="entreg" title = 'ENTREGADA'></i>
                </button>
             </form>
            @endif
            @if($p->observado)
              <form action="{{ url('boton.observado', $p->id) }}" method="GET" >
                @csrf
                <button class="btn">
                  <i class="rev"></i>
                  <i title = 'REVISADA'></i>
                </button>
              </form>
            @endif
            @if($p->aprobado)
              <form action="{{ url('boton.aprobado', $p->id) }}" method="GET" >
                @csrf
                <button class="btn">
                  <i class="aprob" title = 'APROBADA'></i>
                </button>
              </form>            
            @endif
                Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b></br>
                <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})</br>
                <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                {{strip_tags($p->equipo_docente)}}</br>
                <div align="right">
                  <div class="btn-group" role="group">
                    <div class="btn-group">
                      <form action="{{ url('boton.ver', $p->Ver) }}" title="ver" method="GET" >
                        @csrf
                        <button class="btn">
                          <i class="btn btn-success"></i>
                        </button>
                      </form>
                      <form action="{{ url('planificaciones.show', $p->Revisar) }}" method="GET" >
                        @csrf
                        <button class="btn">
                          <i class="btn btn-success" title = 'Revisar'></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach
            <li class="list-group-item">{{$planificaciones->appends(Request::only(['sede','carrera','asignatura','profesor','entregadas','aprobadas','revisadas', 'anio_academico']))->links()}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>

@endsection