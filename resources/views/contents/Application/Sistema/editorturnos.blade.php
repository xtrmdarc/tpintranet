@extends('layouts.Application.master')
@section ("content")
    <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Turnos</h3>
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
                    <div class="clearfix"></div>S
                  </div>
                  <div class="x_content"> --}}

                    <form method="POST" class="form-horizontal form-label-left" action="/RegistroTurnoRequest" >
                      @csrf
                     
                      </p>
                      <span class="section">Editor de Turnos</span>
                      <input type="hidden" name="idturno" value="{{$idturno?$idturno:''}}" >
                      

                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Hora de Inicio <span class="required">*</span>
                          </label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group date" id="horainicio">
                                    <input name="horainicio" type="text" class="form-control" value="{{$turno?$turno->HoraInicio:''}}">
                                    <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                      </div>


                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Hora de Fin <span class="required">*</span>
                          </label>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group date" id="horafin">
                                    <input name="horafin" type="text" class="form-control" value="{{$turno?$turno->HoraFin:''}}">
                                    <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                          </div>
                      </div>

                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Descripción</nav> <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="descturno" class="form-control col-md-7 col-xs-12"  name="descturno" required="required" type="text" value="{{$turno?$turno->DescTurno:''}}">
                        </div>
                      </div>

                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Tipo de Turno <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{-- <input id="Rol" name="rol" class="optional form-control col-md-7 col-xs-12" > --}}
                            <select class="form-control" name="idtturno" >
                              @foreach ($tipoturno as $tturno)
                                <option value="{{$tturno->IdTipoTurnoSistema}}"> {{$tturno->DesTipoTurno}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      {{-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Email <span class="required">*</span>
                        </label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>--}}
                      
                      {{-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Nombre de Usuario <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="url" id="website" name="website" required="required" placeholder="Ej: DReyes" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div> --}}
                      
                      {{-- <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repetir contraseña <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div> --}}

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button class="btn btn-primary" onclick="window.location.replace('/ListaTurnos')">Cancel</button>
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
    {{-- <script src="{{URL::to('Application/EditarUsuarios.js')}}"></script> --}}
         @endsection