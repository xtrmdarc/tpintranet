@extends('layouts.Application.master')
@section ("content")

        <!-- page content -->
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
               <h2>Clientes{{-- <small>Usuarios Sistema</small>--}}</h2>
               <button class="btn btn-primary" onclick="window.location.replace('/EditorCliente')" role="button" style="float:right">Registrar Cliente</button>.
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>ID Cliente</th>
                                    <th>Nombre de Cliente</th>
                                    <th>Empresa</th>
                                    <th>RUC</th>
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
          
          
                                <tbody>
                                  @foreach ($clientes as $cliente)
                                  
                                    <tr>
                                    <td>{{$cliente->IdCliente}}</td>
                                    <td>{{$cliente->NombreCliente}}</td>
                                    <td>{{$cliente->IdEmpresa}}</td>
                                    <td>{{$cliente->RUC}}</td>
                                    <td>
                                      <button class="btn btn-primary" onclick="window.location.replace('Cliente/EditarCliente/{{$cliente->IdClienteSistema}}')" >Editar </button>
                                      <button class="btn btn-secondary" onclick="window.location.replace('Cliente/EliminarCliente/{{$cliente->IdClienteSistema}}')" >Eliminar </button>
                                    </td>
                                    </tr>
                                 @endforeach
                                 
                                </tbody>
                              </table>
                              <div class="row" style="float:right">
                                  {{ $clientes->links() }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
          @endsection