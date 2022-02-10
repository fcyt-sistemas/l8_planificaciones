<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Programa de contenidos extraído de la Planinificación de cátedra</title>
        <img src="data:image/png;base64,{{ $image }}">
    </head>
<body>

<div class="container">
    <br><br>
    <div class="card">    
        <div class="card-body" data-form="deleteForm">
                     <ul class="list-group list-group-flush">
                      @if(count($planificaciones) === 0)
                          <div class="alert alert-success" role="alert">
                            No hay elementos cargados
                          </div>
                      @endif  
                      @foreach($planificaciones as $p)
                        <li class="list-group-item"> 
                               Docente: <b><i>{{$p->docente->apellidos}}, {{$p->docente->nombres}}</i></b></br>
                               <b>{{$p->carrera->nombre}}</b> (Plan {{$p->plan->nombre}}, Resol {{$p->plan->nro_resolucion}})</br>
                               <b>{{$p->catedra->nombre}}, {{$p->anio_academico}}</b></br>
                               {{strip_tags($p->equipo_docente)}}</br>
		                </li>
                       @endforeach
                    </ul>
            </div>
    </div>
</div>
</body>
</html>