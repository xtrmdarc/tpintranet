
@extends('layouts.Application.master')  

@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Indicadores</h3>
        </div>
  
        <div class="clearfix"></div>
        <form id="frm-buscar-flota" action="/Administracion/BuscarFlota" method="POST">
          @csrf
           
          
        </form>
      </div>
  
      <div class="clearfix"></div>
  
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <!--Servicios hechos en los turnos !-->
            <div class="x_title">
                <h2>Servicios Promedio por Semana según Turno piloto</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
  
              
            </div>

            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Servicios por Semana según Turno operador</h2>
                <div class="clearfix"></div>
                </div>
            <div class="x_content">

            
            </div>

            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Puntualidad por Semana según Turno operador</h2>
                <div class="clearfix"></div>
                </div>
            <div class="x_content">

            
            </div>

            


          </div>
        </div>
  
  
        
      </div>
    </div>
  </div>

  @endsection