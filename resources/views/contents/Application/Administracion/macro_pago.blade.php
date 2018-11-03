@extends('layouts.Application.master')

@section('content')

<div class="right_col" role="main" >
    <div class="container">

        
        <div class="row">
            <div class=" col-sm-12">
               
                <h3 class="title text-primary">Macro Pago</h3>
            
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
                                        <th style="width:30%">Nombre Cliente</th>
                                        <th>Tipo Comprobante</th>
                                        <th>Num. Comprobante</th>
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

@php
    /*
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
    */
@endphp


@endsection

@section('scripts')
    
    <script src="{{URL::to('Application/Administracion/Facturados.js')}}"></script> 
    <script type="text/javascript">
        $(function(){
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

