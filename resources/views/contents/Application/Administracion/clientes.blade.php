@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="title text-primary">Clientes</h3>
      </div>

      <div class="clearfix"></div>
      <form id="frm-buscar-cliente" action="/Administracion/BuscarFlota" method="POST">
        @csrf
         
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

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tabla de clientes</h2>
            @php
            /*
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            */
            @endphp
            <a class="btn btn-success pull-right" onclick="window.location.replace()" href="/Administracion/Clientes/NuevoCliente"  > Nuevo Cliente</a>
            <div class="clearfix"></div>
            
          </div>
          <div class="x_content">

            <table id="table_cliente" class="table">
              <thead>
                <tr>
                  <th>Id Contumov</th>
                  <th>RUC</th>
                  <th>Nombre</th>
                
                  <th class="text-center"  >Acciones</th>
                </tr>
              </thead>

              <tbody>
                  @foreach ($clientes as $cliente)
                      <tr>
                          <td>{{$cliente->IdCliente}}</td>
                          <td>{{$cliente->RUC}}</td>
                          <td>{{$cliente->NombreCliente}}</td>
                          <td class="text-center"  >
                            <button class="btn btn-primary" style="display:none;" onclick="detalle_cliente({{'\''. $cliente->IdClienteSistema.'\''}})" >Detalles</button>
                            <a class="btn btn-success" href="/Administracion/Clientes/Editar/{{$cliente->IdClienteSistema}}" >Editar</a>
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
                  <a class="nav-link active" id="cliente-tab" data-toggle="tab" href="#cliente-tab-content" role="tab" aria-controls="home" aria-selected="true">cliente</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="vehiculo-tab" data-toggle="tab" href="#vehiculo-tab-content" role="tab" aria-controls="profile" aria-selected="false">Vehiculo</a>
                </li>
                
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade in  active" id="cliente-tab-content" role="tabpanel" aria-labelledby="cliente-tab">
                  <h4>Nombre</h4>
                  <p id="mdl-txt-nombre-cliente">Alan Vasquez</p>
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
  <script src="{{URL::to('Application/Administracion/Clientes.js')}}"></script> 
  <script>
    cliente_table = $('#table_cliente').DataTable({
              'searching':false,
              'language':{
                  url:'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
              } 
            });
    
  </script>
@endsection