@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Servicios</h3>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <form ></form>
          <form action="/Sistema/BuscarServicios" method="POST">
            @csrf
              <div class="col-sm-3">
                  <label > Escoge el periodo</label>
                  <div class="form-horizontal">
                  <fieldset>
                    <div class="control-group">
                      <div class="controls">
                          <div class="input-prepend input-group">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text"  name="daterangepicker" id="periodo_servicios" class="form-control " value="{{Request()->daterangepicker?Request()->daterangepicker :''}}" />
                          </div>
                      </div>
                    </div>
                  </fieldset>
                  </div>
              </div>
              <div class="form-group col-sm-3">
                <label for="vehiculo_id">Escoge la Móvil</label>
                <input type="hidden" name="ac_movil_id"  id="ac_movil_id" value="{{Request()->ac_movil_id?Request()->ac_movil_id :''}}">
                <input type="text" name="ac_movil" id="ac_movil" class="form-control" placeholder="M020" value="{{Request()->ac_movil?Request()->ac_movil:''}}">
              </div>
              <div class="form-group col-sm-3">
                <label for="vehiculo_id">Escoge el cliente</label>
                <input type="hidden" name="ac_cliente_id" id="ac_cliente_id" value="{{Request()->ac_cliente_id?Request()->ac_cliente_id :''}}">
                <input type="text" name="ac_cliente" id="ac_cliente" class="form-control" placeholder="AQUAPRODUCT" value="{{Request()->ac_cliente?Request()->ac_cliente :''}}">
              </div>
              <div class="form-group col-sm-3">
                <label> &nbsp; </label>
                <input type="submit" id="btn_buscar_servicios" class="btn btn-primary form-control" value="Buscar">
              </div>
          </form>
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

              <table id="table_servicios" class="table">
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
    <script type="text/javascript">
      $(function(){
          $('#table_servicios').DataTable({
            'searching':false,
            'language':{
                url:'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
            } 
          });
          $('input[name="daterangepicker"]').daterangepicker({
              "locale": {
                  "format": "DD/MM/YYYY",
                  "separator": " - ",
                  "applyLabel": "Aplicar",
                  "cancelLabel": "Cancelar",
                  "fromLabel": "Desde",
                  "toLabel": "Hasta",
                  "customRangeLabel": "Personalizado",
                  "daysOfWeek": [
                      "Do",
                      "Lu",
                      "Ma",
                      "Mie",
                      "Ju",
                      "Vi",
                      "Sa"
                  ],
                  "monthNames": [
                      "Enero",
                      "Febrero",
                      "Marzo",
                      "Abril",
                      "Mayo",
                      "Junio",
                      "Julio",
                      "Augosto",
                      "Septiembre",
                      "Octubre",
                      "Noviembre",
                      "Diciembre"
                  ],
                  "firstDay": 1
              }
          })
      });
  </script>
@endsection