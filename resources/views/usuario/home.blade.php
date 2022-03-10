@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Contenidos cargados por el docente {{ Auth::user()->docente->apellidos }}, {{ Auth::user()->docente->nombres }}! </div>
                  <div class="card-body">
                    <!-- Styles -->
                    <link href="{{ asset('adminlte/css/adminlte.css') }}" rel="stylesheet">
                    <link href="{{ asset('adminlte/adminlte.min.css') }}" rel="stylesheet">
                    <div class="card-header"><h5>Planificaciones</h5></div>
                  <section class="content">
                    <div class="container-fluid">
                      <!-- Small boxes (Stat box) -->
                      <div class="row">
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>{{$dashp['revisadas']}}</h3>
              
                              <p>Revisadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('admin.planificaciones.revisado') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{$dashp['aprobadas']}}<sup style="font-size: 20px"></sup></h3>
              
                              <p>Aprobadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('planificaciones.aprobado') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{$dashp['entregadas']}}</h3>
              
                              <p>Entregadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('planificaciones.entregado') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{$dashp['cargadas']}}</h3>
              
                              <p>Cargadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('planificaciones') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                  </section>

                  <div class="card-header"><h5>Memorias</h5></div>

                  <section class="content">
                    <div class="container-fluid">
                      <!-- Small boxes (Stat box) -->
                      <div class="row">
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner">
                              <h3>{{$dashp['revisadas']}}</h3>
              
                              <p>Revisadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('memorias') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{$dashp['aprobadas']}}<sup style="font-size: 20px"></sup></h3>
              
                              <p>Aprobadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('memorias') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{$dashp['entregadas']}}</h3>
              
                              <p>Entregadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('memorias') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{$dashp['cargadas']}}</h3>
              
                              <p>Cargadas</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('memorias') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                  </section>

                  </div>
            </div>
        </div>
    </div>
</div>
@endsection