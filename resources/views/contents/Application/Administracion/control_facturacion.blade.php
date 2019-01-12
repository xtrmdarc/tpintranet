@extends('layouts.Application.master')

@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Control Facturación</h3>
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
      
      <div class="row" style="margin-bottom:1em;">
        <div class="col-sm-5"></div>
        <div class="col-sm-3" >
            <ul class="nav nav-pills" id="myTab" role="tablist" style="margin:auto;">
                <li class="nav-item active">
                    <a class="nav-link active" id="cred-tab" data-toggle="pill" href="#cf-cred" role="tab" aria-controls="home" aria-selected="true">Crédito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cont-tab" data-toggle="pill" href="#cf-cont" role="tab" aria-controls="profile" aria-selected="false">Contado</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-4"></div>
      </div>
    
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
           <div class="x_content">

                <div id="cf-cred" role="tabpanel"  class="tab-pane fade in active">

                    @foreach ($clientes_cred as $cliente)
                    <div id="cf-cred-cliente-{{$cliente->IdCliente}}" class="cf-cred-cliente row"   >
                            <a  data-toggle="collapse" href="#cf-cred-body-{{$cliente->IdCliente}}">
                                <div class="cf-cred-cliente-header col-xs-12">
                                    <h2 class="title">{{$cliente->NombreCliente}}</h2>
                                    <p class="text-secondary-gray" style="display:inline-block">{{count($cliente->servicios) }} servicios por facturar</p> 
                                </div>
                            </a>
                            
                            <div id="cf-cred-body-{{$cliente->IdCliente}}" class="cf-cred-cliente-body collapse" >
                                <table class="table clearfix ">
                                    <thead>
                                    <tr>
                                        <th>Num. Vale</th>
                                        <th>Fecha Servicio</th>
                                        <th style="width:40%">Usuario</th>
                                        <th></th>
                                        <th class="text-right" >Monto</th>
                                        <th class="text-center" ><input type="checkbox"  id="cf_cred_cliente_checkbox_{{$cliente->IdCliente}}" onclick="cliente_checked({{$cliente->IdCliente}})"></th>
                                        
                                    </tr>
                                    </thead>
                                        
                                    <tbody >
                                        @foreach ($cliente->servicios as $servicio)
                                            <tr>
                                                <td>{{$servicio->NumVale}}</td>  
                                                <td>{{$servicio->FechaServicio}}</td>
                                                <td>{{$servicio->NombreUsuario}}</td>
                                                <td></td>
                                                <td class="text-right" >{{'S/. '.$servicio->MontTotalCredito}}</td>
                                                <td class="text-center" ><input type="checkbox" id="cf_cred_serv_checkbox_{{$servicio->IdServicioSistema}}" onclick="servicio_checked({{$cliente->IdCliente}},{{$servicio->IdServicioSistema}})"></td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td ></td>  
                                            <td></td>
                                            <td></td>
                                            <td><b>Sub Total</b></td>
                                            <td id="cf_cred_subtotal_{{$cliente->IdCliente}}" class="text-right" >S/. 0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>  
                                            <td></td>
                                            <td></td>
                                            <td ><b>IGV</b></td>
                                            <td id="cf_cred_igv_{{$cliente->IdCliente}}" class="text-right" >S/. 0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>  
                                            <td></td>
                                            <td></td>
                                            <td ><b>Total</b></td>
                                            <td id="cf_cred_total_{{$cliente->IdCliente}}" class="text-right" >S/. 0.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>  
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right" > <button class="btn btn-primary" id="cf_cred_btn_procesar_{{$cliente->IdCliente}}" style="margin:0px;" value="Procesar" onclick="preProcesarComprobanteCredito({{$cliente->IdCliente}})">Procesar</button> </td> 
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                    
                                </table>
                                
                            </div>
                        </div>    
                    @endforeach
                    

                </div>
                
                <div id="cf-cont" role="tabpanel" class="tab-pane fade"> </div>

            </div>
          </div>
        </div>
        </div>

      </div>
    </div>
  </div>

    <div id="mdl-procesar-comprobante" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mdl-carga-servicios-title">Nuevo Comprobante</h4>
            </div>
            <div class="modal-body">

                <form id="frm-procesar-comprobante" class="cf-cred-cliente-body">
                    <input type="hidden" id="es_credito" />
                    <input type="hidden" id="id_cliente" />
                    
                    <div class="form-group row">
                        <label for="cliente_cb" class="col-sm-3 col-form-label ">Cliente</label>
                        <div class="col-sm-9">
                        <select type="text" title="Ingrese Cliente" class="form-control selectpicker" data-live-search="true" id="cliente_cb" placeholder="AQUAPRODUCT" required>
                            @foreach ($clientes as $c)
                                <option value="{{$c->IdClienteSistema}}" >{{$c->NombreCliente}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="comprobante_cb" class="col-sm-3 col-form-label">Comprobante</label>
                        <div class="col-sm-9">
                        <select  class="form-control" id="comprobante_cb" placeholder="Password" required>
                            @foreach ($tipo_comprobantes as $tc)
                                <option value="{{$tc->IdTipoComprobante}}" > {{$tc->DescTipoComprobante}} </option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="identificador_comprobante" class="col-sm-3 col-form-label">Identificador</label>
                        <div class="col-sm-9">
                        <input type="text"  class="form-control" id="identificador_comprobante" placeholder="Ingrese Identificador"  required/>
                        </div>
                    </div>
                    <table id="table-mdl-comprobante" class="table clearfix table-mdl-comprobante">
                        <thead>
                            <tr>
                                <th>Num. Vale</th>
                                <th>Fecha Servicio</th>
                                <th style="width:30%">Usuario</th>
                                <th></th>
                                <th class="text-right" >Monto</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td ></td>  
                                <td></td>
                                <td></td>
                                <td><b>Sub Total</b></td>
                                <td id="cf_cred_mdl_subtotal" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>IGV</b></td>
                                <td id="cf_cred_mdl_igv" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>Total</b></td>
                                <td id="cf_cred_mdl_total" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td class="text-right"  colspan="2" style="padding:0px"> <button class="btn btn-primary" id="cf_cred_btn_procesar_{{$cliente->IdCliente}}" style="margin:0px;width:100%" value="Procesar">Procesar</button> </td> 
                                
                            </tr>
                        </tfoot>
                    </table>
                    
                    <!-- <button type="button" class="btn btn-primary">Procesar</button> !-->
                    
                </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                
                
            </div>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{URL::to('Application/Administracion/ControlFacturacion.js')}}"></script> 
    <script type="text/javascript">

    $(function(){
//        console.log({!! json_encode($clientes_cred) !!});
        console.log(@json($clientes_cred));
        CargarClientesFacturar(@json($clientes_cred));
        $('#mdl-procesar-comprobante').modal('show');
    });

</script>

@endsection

