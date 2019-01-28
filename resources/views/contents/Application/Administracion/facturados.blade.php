@extends('layouts.Application.master')

@section('content')

<div class="right_col" role="main" >
    <div class="container">

        
        <div class="row">
            <div class=" col-sm-12">
               
                <h3 class="title text-primary">Comprobantes</h3>
            
            </div>
            
        </div>

        <div class="row">

                <div class="col-sm-4">
                    <label > Escoge el periodo</label>
                    <form class="form-horizontal">
                    <fieldset>
                        <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text"  name="daterangepicker" id="periodo_facturados" class="form-control " />
                            </div>
                        </div>
                        </div>
                    </fieldset>
                    </form>
                </div>

                <div class="col-sm-4">
                    <label> Escoge el cliente </label>
                    <form>
                        <div class="control-group">
                            <input type="hidden" id="ac_cliente_id" >
                            <input type="text" id="ac_cliente"  class="form-control " placeholder="Cliente" autocomplete="off" />
                        </div>
                    </form>
                </div>
            


                <div class="col-sm-4">
                    <label> &nbsp; </label>
                    <div class="control-group">
                        <button id="btn_buscar_facturados" class="btn btn-primary form-control" >Buscar</button>
                    </div>
                </div>

        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="table-responsive">
                            <table id="tabla_facturados" class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Num. Comprobante</th>
                                        <th>Tipo Comprobante</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">IGV</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>

                            </table>
                        </div>
                        <div id="facturados_carga_loader" class="loader text-center center-block" style="display:none"></div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


    <div id="mdl-servicios-factura" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                        <h4 class="modal-title col-sm-8" id="mdl-servicios-factura-title"></h4>
                        <div class="col-sm-4" >
                            <form class="form" action="/Administracion/ExportarComprobanteExcel" target="_blank" method="POST"  >
                                @csrf
                                <input type="hidden" id="id_comprobante" name="id_comprobante" />
                                <button id="" class="btn btn-success form-control" type="submit" style="float:right;"> Exportar </button>
                            </form>
                        </div>
                </div>
                
            </div>
            <div class="modal-body">

                <form id="frm-procesar-comprobante" class="cf-cred-cliente-body">
                    <input type="hidden" id="es_credito" />
                    <input type="hidden" id="id_cliente" />

                    <div id="facturados_detalle_carga_loader" class="loader text-center center-block" style="display:block"></div>
                    <table id="table-mdl-comprobante" class="table clearfix table-mdl-comprobante" style="display:none;">
                        <thead>
                            <tr>
                                <th>Num. Vale</th>
                                <th>Fecha Servicio</th>
                                <th >Usuario</th>
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
                                <td id="cp_cred_mdl_subtotal" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            <tr>    
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>IGV</b></td>
                                <td id="cp_cred_mdl_igv" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>Total</b></td>
                                <td id="cp_cred_mdl_total" class="text-right" >S/. 0.00</td>
                                
                            </tr>
                            @php
                            /*
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td class="text-right"  colspan="2" style="padding:0px"> <button class="btn btn-primary" id="cf_cred_btn_procesar_{{$cliente->IdCliente}}" style="margin:0px;width:100%" value="Procesar">Procesar</button> </td> 
                                
                            </tr>
                            */
                            @endphp
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
    
    <script src="{{URL::to('Application/Administracion/Facturados.js')}}"></script> 
    

@endsection

