@extends('adminlte::page')
@section('content')
<div class="container">
  @include('admin.planificaciones.modal')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header form-inline">
          <h4 class="col-md-9">Listado de planificaciones Entregadas!</h4>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="sede_id">Carrera:</label>
            </div>
            <select name='carrera' class='custom-select' id='carreras' placeholder= 'Seleccione una carrera'></select>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="anio_academico">Año Academico:</label>
            </div>
            <select name='anio_academico' class='custom-select' id='anio_academico' placeholder='Seleccione un año academico'></select>
          </div>
          <div class="form-inline">
            <form text='asignatura' type='search' class='form-control mr-sm-3' placeholder='Asignatura'>
            <form text='profesor' type='search' class='form-control mr-sm-3' placeholder='Apellido profesor'>
                <button class="btn btn-default my-3 my-sm-0" type="submit">Buscar</button>
            </form>
            </form>
          </div>
      </div>

        <div class="card-header justify-content-between">
          <form name="add-blog-post-form" id="add-blog-post-form" method="GET" action="{{url('planificacion')}}"></form>
        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <a class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
          {{Session::get('message')}}
        </div>
        @endif
        <div class="card-body" data-form="deleteForm">
          <ul class="list-group list-group-flush">
            @if(count($planificaciones) === 0)
            <div class="alert alert-success" role="alert">
              No hay elementos cargados
            </div>
            @endif
            @foreach($planificaciones as $p)
            <li class="list-group-item">
                <form action="{{url(PlanificacionController::class,'show')}}" title = 'ENTREGADA' class='entreg' parameters = $p->id></form>
              <br>
              Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b><br>
              <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})<br>
              <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b><br>
              {{strip_tags($p->equipo_docente)}}<br>
              <div align="right">
                <div class="btn-group" role="group">
                  <div class="btn-group">
                  <form action="{{url(PlanificacionController::class,'show')}}" title = 'Ver' class='btn btn-secondary' $parameters = $p->id></form>
                  <form action="{{url(PlanificacionController::class,'revisar')}}" title = 'Revisar!' class='btn btn-success' $parameters = $p->id></form>
                  </div>
                </div>
              </div>
            </li>
            @endforeach
            <li class="list-group-item">{{$planificaciones->appends(Request::only(['sede','carrera','asignatura','profesor','entregadas','aprobadas','revisadas', 'anio_academico']))->links()}}
        </div>
      </div>
    </div>
  </div>
</div>