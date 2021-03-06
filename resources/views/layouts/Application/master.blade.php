<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela! | </title>
    <!-- Datatable-->
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="{{URL::to('jquery-ui/css/jquery-ui.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{URL::to('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::to('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::to('nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{URL::to('iCheck/skins/flat/green.css')}}" rel="stylesheet">

     
    <!-- bootstrap-progressbar -->
    <link href="{{URL::to('bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{URL::to('jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{URL::to('bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    
    <link href="{{URL::to('build/css/custom.min.css')}}" rel="stylesheet">

    <!-- bootstrap-datetimepicker -->
    <link href="{{URL::to('bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
    <!-- Latest compiled and minified CSS  bootstrap-select --> 
    <link rel="stylesheet" href="{{URL::to('bootstrap-select-1.13.2/css/bootstrap-select.min.css')}}">

    <link href="{{URL::to('Application/app.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"> <span>Taxi Puntual</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido(a),</span>
                <h2>Diego Reyes</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Produccion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/Produccion">Indicadores</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Administracion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/Administracion/MacroPago">Pago Macro</a></li>
                      <li><a href="/Administracion/Flota">Flota</a></li>
                      <li><a href="/Administracion/CFacturacion">Control Facturacion</a></li>
                      <li><a href="/Administracion/Clientes">Clientes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Gerencia<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/Gerencia/EstCli">Estadistica Clientes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Sistema <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/Sistema/CargaServicios">Carga Servicios</a></li>
                      <li><a href="/Sistema/CargaDescuentos">Carga Descuentos</a></li>
                      <li><a href="/Sistema/Servicios">Servicios</a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        
        <!-- page content -->
        @yield('content')
        <!-- /page content -->


        {{-- <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content --> --}}
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{URL::to('jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery-ui -->
    <script src="{{URL::to('jquery-ui/js/jquery-ui.min.js')}}"></script>    
    <!-- Bootstrap -->
    <script src="{{URL::to('bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::to('fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{URL::to('nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{URL::to('Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{URL::to('gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{URL::to('bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{URL::to('iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{URL::to('skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{URL::to('Flot/jquery.flot.js')}}"></script>
    <script src="{{URL::to('Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::to('Flot/jquery.flot.time.js')}}"></script>
    <script src="{{URL::to('Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{URL::to('Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{URL::to('flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{URL::to('flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{URL::to('flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{URL::to('DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{URL::to('jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{URL::to('jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{URL::to('jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{URL::to('moment/min/moment.min.js')}}"></script>
    <script src="{{URL::to('bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- validator -->
    <script src="{{URL::to('validator/validator.js')}}"></script>
    
    <!-- Latest compiled and minified JavaScript bootstrap-select -->
    <script src="{{URL::to('bootstrap-select-1.13.2/js/bootstrap-select.min.js')}}"></script>
    
    <!-- Datatables -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    


    <!-- Custom Theme Scripts -->
    <script src="{{URL::to('build/js/custom.min.js')}}"></script>
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
    @yield("scripts")
	
  </body>
</html>
