@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Servicios</h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Tabla de servicios</small></h2>
              @php
              /*
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              */
              @endphp
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <table class="table">
                <thead>
                  <tr>
                    <th>Num. Vale</th>
                    <th>Conductor</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Contado</th>
                    <th>Credito</th>
                    
                    <th>Empresa</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{$servicio->NumVale}}</td>
                            <td>{{$servicio->IdVehiculo}}</td>
                            <td>{{$servicio->NombreCliente}}</td>
                            <td>{{$servicio->Tipo}}</td>
                            <td>{{$servicio->MontContado}}</td>
                            <td>{{$servicio->MontTotalCredito}}</td>
                            @php
                                /*
                                <td><button class="{{'btn-text'.($servicio->IdEmpresa!= 1?'-non':'').'-selected'}}" >Taxi Puntual</button> <button class="{{'btn-text'.($servicio->IdEmpresa!= 2?'-non':'').'-selected'}}">Puntual</button></td>    
                                */ 
                            @endphp
                            <td>
                                <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                                    <li class="nav-item {{$servicio->IdEmpresa!=1?'':'active'}}">
                                        <a class="nav-link {{$servicio->IdEmpresa!=1?' btn-text-non-selected ':'active '}}" href="#" id="pills-home-tab" onclick="setIdEmpresaXServicio(this,{{$servicio->IdServicioSistema}},1)" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true">Taxi Puntual</a>
                                    </li>
                                    <li class="nav-item {{$servicio->IdEmpresa!=2?'':'active'}}">
                                        <a class="nav-link {{$servicio->IdEmpresa!=2?'btn-text-non-selected ':'active'}}" href="#" id="pills-profile-tab" onclick="setIdEmpresaXServicio(this,{{$servicio->IdServicioSistema}},2)" data-toggle="pill"  role="tab" aria-controls="pills-profile" aria-selected="false">Puntual</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="row" style="float:right">
                {{ $servicios->links() }}
              </div>
              
            </div>
          </div>
        </div>


        
      </div>
    </div>
  </div>
  <!-- /page content -->

@endsection

@section('scripts')
    <script src="{{URL::to('Application/Sistema/Servicios.js')}}"></script>
@endsection