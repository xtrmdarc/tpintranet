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
            <form class="form-horizontal" action="/Administracion/ObtenerMacrosPago" target="_blank" method="POST">
                @csrf
                <div class="col-sm-4">
                    <label > Escoge el periodo</label>
                    
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
                </div>
                <div class="col-sm-4">
                    <label for="">Escoge la empresa </label>
                    <select name="id_empresa" class="form-control" id="empresa_cb">
                        <option value="1" selected>Taxi Puntual</option>
                        <option value="2">Puntual</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="">&nbsp;</label>
                    <input type="submit" class="form-control btn btn-primary" value="obtener">
                </div>
            </form>
        </div>

        

    </div>
</div>
@endsection

@section('scripts')
    
    <script src="{{URL::to('Application/Administracion/MacroPago.js')}}"></script> 
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

