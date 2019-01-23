@extends('layouts.Application.master')
@section ("content")
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Form Validation</h3>
              </div>

              {{-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div> --}}
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- <div class="x_panel">
                  <div class="x_title">
                    <h2>Form validation <small>sub title</small></h2>
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
                  <div class="x_content"> --}}

                    <form method="POST" class="form-horizontal form-label-left" action="/RegistroClienteRequest" >
                      @csrf
                      <p>For alternative validation library <code>parsleyJS</code> check out in the <a href="form.html">form page</a>
                      </p>
                      <span class="section">Personal Info</span>
                      <input type="hidden" name="id_cliente" value="{{$id_cliente?$id_cliente:''}}" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idcliente">ID Cliente <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="idcliente" type="number" class="form-control col-md-7 col-xs-12"  name="idcliente" required="required" value="{{$cliente?$cliente->IdCliente:''}}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombrecliente">Nombre del Cliente<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nombrecliente" class="form-control col-md-7 col-xs-12"  name="nombrecliente" required="required" type="text" value="{{$cliente?$cliente->NombreCliente:''}}">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idempresa">ID Empresa <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="idempresa" name="idempresa" required="required" class="form-control col-md-7 col-xs-12" value="{{$cliente?$cliente->IdEmpresa:''}}">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="RUC">RUC <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="RUC" name="RUC" required="required" class="form-control col-md-7 col-xs-12" value="{{$cliente?$cliente->RUC:''}}">
                        </div>
                      </div>
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" onclick="window.location.replace('/ListaClientes')">Cancel</button>
                           <input id="send" type="submit" class="btn btn-success" value="Enviar"/>
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

         @endsection
    
          @section("scripts")
    <script src="{{URL::to('Application/EditarUsuarios.js')}}"></script>
         @endsection 