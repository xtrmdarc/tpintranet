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
          <h3>Form Upload </h3>
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

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Dropzone multiple file uploader</h2>
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
              <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
              <form action="/Sistema/CargarServiciosRequest" class="dropzone" id="dzCargarServicios">
                  @csrf
                  <div class="dz-message">Arrastre el archivo de servicios hasta aquí para subirlo al servidor o haga click aquí.</div>
              </form>
              <br />
              <br />
              <br />
              <br />
            </div>
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
  <script src="{{URL::to('Application/Sistema/CargaServicios.js')}}"></script>
@endsection
