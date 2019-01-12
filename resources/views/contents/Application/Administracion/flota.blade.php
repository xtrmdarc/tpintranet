@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="title text-primary">Flota</h3>
      </div>

      <div class="clearfix"></div>
      <form id="frm-buscar-flota" action="/Administracion/BuscarFlota" method="POST">
        @csrf
         
          <div class="form-group col-sm-3">
            <label for="vehiculo_id">Escoge la Móvil</label>
            <input type="hidden" name="ac_movil_id"  id="ac_movil_id" value="{{Request()->ac_movil_id?Request()->ac_movil_id :''}}">
            <input type="text" name="ac_movil" id="ac_movil" class="form-control" placeholder="M020" value="{{Request()->ac_movil?Request()->ac_movil:''}}">
          </div>
          <div class="form-group col-sm-3">
            <label for="vehiculo_id">Escoge el tipo de Asociación</label>
            <select name="slc_tipo_asoc" class="form-control" id="slc_tipo_asoc">
                  <option value="" selected>Cualquiera</option>
              @foreach ($tipo_asoc as $ta)
                  <option value="{{$ta->IdTipoAsociacion}}">{{$ta->DescTipoAsociacion}} </option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-sm-3">
            <label> &nbsp; </label>
            <input type="submit" id="btn_buscar_servicios" class="btn btn-primary form-control" value="Buscar">
          </div>
      </form>
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

            <table id="table_flota" class="table">
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
                          <td>{{$conductor->DescTipoConductor}}</td>
                          <td class="text-center" >
                              <span class="label label-{{$conductor->Estado=='Activo'?'success':'danger'}} sticker-tabla">{{$conductor->Estado}}</span>
                          </td>
                          <td class="text-center" >{{$conductor->Inactividad}}</td>
                          <td class="text-center"  >
                            <button class="btn btn-primary" onclick="detalle_piloto({{'\''. $conductor->IdConductorSistema.'\''}})" >Detalles</button>
                            <a class="btn btn-success" href="/Administracion/Flota/{{$conductor->IdConductorSistema}}" >Editar</a>
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
<!-- Modal detalle del piloto -->
<div id="mdl-detalle-piloto" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="mdl-carga-servicios-title">Detalle Piloto</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-sm-12">
            <div id="servicios_carga_loader" class="loader text-center" style="display:block;margin-left:auto;margin-right:auto;"></div>

            <div id="content-detalle" style="display:none">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                  <a class="nav-link active" id="conductor-tab" data-toggle="tab" href="#conductor-tab-content" role="tab" aria-controls="home" aria-selected="true">Conductor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="vehiculo-tab" data-toggle="tab" href="#vehiculo-tab-content" role="tab" aria-controls="profile" aria-selected="false">Vehiculo</a>
                </li>
                
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade in  active" id="conductor-tab-content" role="tabpanel" aria-labelledby="conductor-tab">
                  <h4>Nombre</h4>
                  <p id="mdl-txt-nombre-conductor">Alan Vasquez</p>
                  <h4 >Tipo Piloto</h4>
                  <p id="mdl-txt-tipo-piloto">Permanente</p>
                  <h4>Tipo Facturacion</h4>
                  <p id="mdl-txt-tipo-asociacion">Flota Propia</p>
                  <h4>Turno</h4>
                  <p id="mdl-txt-turno">A</p>
                  <h4>Estado</h4>
                  <p id="mdl-txt-estado">Inactivo</p>
                  <h4>Inactividad</h4>
                  <p id="mdl-txt-inactividad">0 Semanas</p>

                </div>
                <div class="tab-pane fade in " id="vehiculo-tab-content" role="tabpanel" aria-labelledby="vehiculo-tab">
                  <h4>Placa</h4>
                  <p id="mdl-txt-placa">C1I-389</p>
                  <h4>Tipo SOAT</h4>
                  <p id="mdl-txt-tipo-soat">Prima</p>
                  <h4>Fecha Venc. SOAT</h4>
                  <p id="mdl-txt-fecha-soat">20/07/2019</p>
                  <h4>Fecha Venc. R. Técnica</h4>
                  <p id="mdl-txt-fecha-tecnica">20/10/2019</p>
                </div>
               
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
          <button class="btn"  data-dismiss="modal" >Cerrar</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
  <script src="{{URL::to('Application/Administracion/Flota.js')}}"></script> 
  <script>
    flota_table = $('#table_flota').DataTable({
              'searching':false,
              'language':{
                  url:'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
              } 
            });
    
  </script>
@endsection