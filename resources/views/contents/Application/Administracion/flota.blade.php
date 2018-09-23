@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Flota</h3>
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
              <h2>Tabla de conductores</h2>
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
                    <th>Conductor</th>
                    <th>Nombres</th>
                    <th>Tipo</th>
                    <th class="text-center" >Estado</th>
                    <th class="text-center" >Inactividad</th>
                    <th class="text-center"  >Acciones</th>
                  </tr>
                </thead>

                <tbody>
                    @foreach ($flota as $conductor)
                        <tr>
                            <td>{{$conductor->IdVehiculo}}</td>
                            <td>{{$conductor->NombreConductor}}</td>
                            <td >{{$conductor->DescTipoConductor}}</td>
                            <td class="text-center" >
                                <span class="label label-{{$conductor->Estado=='Activo'?'success':'danger'}} sticker-tabla">{{$conductor->Estado}}</span>
                            </td>
                            <td class="text-center" >{{$conductor->Inactividad}}</td>
                            <td class="text-center"  ><button class="btn btn-primary">Detalles</button></td>
                            
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="row" style="float:right">
                {{ $flota->links() }}
              </div>
              
            </div>
          </div>
        </div>


        
      </div>
    </div>
  </div>
  <!-- /page content -->

@endsection