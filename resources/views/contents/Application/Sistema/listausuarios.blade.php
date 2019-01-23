@extends('layouts.Application.master')
@section ("content")

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
               <h2>Usuarios Sistema{{-- <small>Usuarios Sistema</small>--}}</h2> --}}
              {{-- <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/EditorUsuario">Crear Usuario</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul> --}}
              <button class="btn btn-primary" onclick="window.location.replace('/EditorUsuario')" role="button" style="float:right">Registrar Usuario</button>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                    {{-- <p class="text-muted font-13 m-b-30">
                     
                    </p> --}}

                    <table id="datatable-keytable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>DNI</th>
                          <th>Nombre Completo</th>
                          <th>IDRol</th>
                          <th>FechaDeIngreso</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach ($usuarios as $usuario)
                        
                          <tr>
                          <td>{{$usuario->DNIUsuario}}</td>
                          <td>{{$usuario->NombreUsuario.$usuario->ApellidoUsuario}}</td>
                          <td>{{$usuario->IDRol}}</td>
                          <td>{{$usuario->FechaDeIngresoUsuario}}</td>
                          <td>
                            <button class="btn btn-primary" onclick="window.location.replace('Usuarios/EditarUsuario/{{$usuario->IDUsuarioSis}}')" >Editar </button>
                            <button class="btn btn-secondary" onclick="window.location.replace('Usuarios/EliminarUsuario/{{$usuario->IDUsuarioSis}}')" >Eliminar </button>
                          </td>
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
