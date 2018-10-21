@extends('layouts.Application.master')  

@section('content')



<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Flota</h3>
        </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2></h2>
              <form id="frm-exportar-excel" method="GET" action="/Administracion/ExportarTarifarioExcel" target="_blank">
                <button id="btn_excel_export" class=" btn excel-export navbar-right">Excel</button>
              </form>
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
            <div class="card container"  >

              <form id="frm-buscar-tarifa" method="POST" action="/Administracion/BuscarTarifa">
                @csrf
                  <div class="form-group row">
                    <label for="direccion_origen" class="col-sm-2 col-form-label" style="padding-top:5px;">Ingrese dirección</label>
                    <div class="col-sm-6">
                      <input id="direccion_origen" class="form-control" type="text" placeholder="Av. Ejemplo 110" name="direccion_origen">
                    </div>
                    <div class="col-sm-4">
                      <input id="submit-buscar-tarifa"  type="button" class="btn btn-primary mb-2" value="Buscar"/>
                    </div>
                  </div>
              </form> 

              <div id="buscar_tarifa_loader" class="loader" style="margin:auto;display:none;margin-top:12.5%;margin-bottom:12.5%"  >

              </div>

              <table id="table_tarifario" class="table"  style="margin:auto;display:none;" >
                  <thead>
                    <tr>
                      <th>origen</th>
                      <th>zona_destino</th>
                      <th>destino</th>
                      <th>kilometraje</th>
                      <th>distancia (m)</th>
                      <th>duracion</th>
                      <th>costo sugerido (S/.)</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                    
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
    <script src="{{URL::to('Application/Administracion/TarifarioMatriz.js')}}"></script>
  @endsection