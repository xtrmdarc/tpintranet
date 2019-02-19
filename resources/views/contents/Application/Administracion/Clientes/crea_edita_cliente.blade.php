@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3 class="title text-primary">Cliente</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>{{isset($cliente->IdConductorSistema)?$cliente->NombreCliente:''}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="/Administracion/Clientes/GuardarCliente" method="POST" >
                     @csrf
                    <input type="hidden" name="id_cliente" value="{{isset($cliente)?$cliente->IdClienteSistema:''}}" >
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Contumov</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="nombre_contumov" type="text" value="{{$cliente->NombreCliente}}" class="form-control" placeholder="Nombre Contumov">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Id Contumov</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="id_contumov"  value="{{$cliente->IdCliente}}" type="text" class="form-control" placeholder="Identificador">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">RUC</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="ruc" value="{{$cliente->RUC}}"  type="text" class="form-control" placeholder="RUC">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Empresa</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="slc_empresa" id="" class="form-control">
                                <option value="" > Seleccionar </option>
                                @foreach ($empresas as $e)
                                    <option  value="{{$e->IdEmpresa}}" {{$e->IdEmpresa==$cliente->IdEmpresa?'selected':''}}>{{$e->NombreEmpresa}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facturación</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="slc_es_credito" id="" class="form-control">
                                <option value="" > Seleccionar </option>
                                <option value="1" {{$cliente->EsCredito==1?'selected':''}} > Crédito </option>
                                <option value="0" {{$cliente->EsCredito==0?'selected':''}} > Contado </option>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick="window.location.replace('/Administracion/Clientes')">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                    </div>
    
                </form>
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