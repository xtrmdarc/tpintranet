@extends('layouts.Application.master')
@section ("content")

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>KeyTable example <small>Users</small></h2>
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
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
                    </p>

                    <table id="datatable-keytable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Nombre Completo</th>
                          <th>IDRol</th>
                          <th>FechaDeIngreso</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach ($usuarios as $usuario)
                       <tr>
                       <td>{{$usuario->DNIUsuario}}</td>
                       <td>{{$usuario->NombreUsuario.$usuario->ApellidoUsuario}}</td>
                       <td>{{$usuario->IDRol}}</td>
                       <td>{{$usuario->FechaDeIngresoUsuario}}</td>
                       </tr>
                       @endforeach
                      </tbody>
                    </table>
                    <div class="row" style="float:right">
                        {{ $usuarios->links() }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
@endsection
