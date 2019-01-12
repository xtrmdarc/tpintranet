@extends('layouts.Application.master')

@section('content')

<style>

.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<link href="{{URL::to('dropzone/dist/min/dropzone.min.css')}}" rel="stylesheet">
    <!-- page content -->
  <div class="right_col" role="main">

    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Carga Descuentos </h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Zona de carga</h2>
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
            <form action="/Sistema/CargarDescuentosRequest" class="dropzone" id="dzCargarServicios">
              @csrf
            <div class="row">
                <div class="col-sm-3">
                    <label > Escoge el periodo</label>
                    <div class="form-horizontal">
                    <fieldset>
                      <div class="control-group">
                        <div class="controls">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text"  name="daterangepicker" id="periodo_descuentos" class="form-control " value="{{Request()->daterangepicker?Request()->daterangepicker :''}}" />
                            </div>
                        </div>
                      </div>
                    </fieldset>
                    </div>
                </div>
                <div class="col-sm-5">
                    <label>&nbsp;</label>
                    <p style="margin:auto;"><strong style="color:red;"> Antes de subir el archivo seleccione el periodo para la aplicación de los descuentos</strong></p>
                </div>
            </div>
            <div class="x_content">
              <p>Cargue un archivo csv que contenga los datos de los descuentos de los conductores para las semanas especificadas arriba</p>
              
                  
                  <div class="dz-message">Arrastre el archivo de descuentos hasta aquí para subirlo al servidor o haga click aquí.</div>
              
              <br />
              <br />
              <br />
              <br />
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="mdl-carga-servicios" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="mdl-carga-servicios-title">Esto podría tomar tiempo..</h4>
          
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-12">
              <div id="servicios_carga_loader" class="loader text-center" style="display:block;margin-left:auto;margin-right:auto;"></div>
              
              <div id="respuesta_servicios" style="display:none;"> 
              
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
  <script src="{{URL::to('dropzone/dist/min/dropzone.min.js')}}"></script>
  <script src="{{URL::to('Application/Sistema/CargaDescuentos.js')}}"></script>
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
