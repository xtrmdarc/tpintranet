
@extends('layouts.Application.master')  

@section('content')

<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Indicadores</h3>
        </div>
        <button class="btn btn-primary" style="float:right;" onclick="indicadores_pdf(2)">PDF</button>
        <div class="clearfix"></div>
        <form id="frm-buscar-flota" action="/Administracion/BuscarFlota" method="POST">
          @csrf
           
          
        </form>
      </div>
  
      <div class="clearfix"></div>
  
      <div id="indicadores_div" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <!--Servicios hechos en los turnos !-->
            <div class="x_title">
                <h2>Produccion Promedio por Semana según Turno piloto</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-responsive table-indicadores" >
                    <thead class="thead-inverse">
                        <tr>
                            <th rowspan="2" style="text-align:center;vertical-align:top">Turno</th>
                            <th colspan="{{count(array_count_values(array_column($prod_prom_semana_tc,'semana'))) }}" style="text-align:center">Semanas</th>
                            <th colspan="2"  style="text-align:center">Desempeño</th>
                        </tr>
                        <tr>
                            
                                @for($i = 0; $i <  count($prod_prom_semana_tc); $i++  )
                                    @if($i == 0 )
                                        <th>{{$prod_prom_semana_tc[$i]->semana}}</th>
                                    @elseif ( $prod_prom_semana_tc[$i]->semana != $prod_prom_semana_tc[$i-1]->semana )
                                        <th>{{$prod_prom_semana_tc[$i]->semana}}</th>
                                    @endif                            
                                @endfor
                                <th>Inferior</th>
                                <th>Superior</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i <  count(array_count_values(array_column($prod_prom_semana_tc,'DescTurno'))); $i++  )
                            <tr>
                                <th>{{$prod_prom_semana_tc[$i]->DescTurno }}</th>
                                @foreach($prod_prom_semana_tc as $serv)
                                    @if($serv->DescTurno == $prod_prom_semana_tc[$i]->DescTurno   )
                                        <td  @if($serv->Cumplimiento == 2) class="td-objetivo-rango-superior" @elseif($serv->Cumplimiento == 0) class="td-objetivo-rango-inferior" @else class="td-objetivo-rango-normal" @endif    >
                                            {{$serv->PromedioSemanal}}
                                        
                                        </td>
                                    @endif
                                @endforeach
                                <td >< {{$prod_prom_semana_tc[$i]->RangoInferior}}</td>
                                <td>{{$prod_prom_semana_tc[$i]->RangoSuperior}} <</td>
                            </tr>                       
                        @endfor
                    </tbody>
                </table>
            </div>

            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Servicios por Semana según Turno operador</h2>
                <div class="clearfix"></div>
                </div>
            <div class="x_content">
                <table  class="table table-bordered table-responsive table-indicadores">
                    <thead class="thead-inverse">
                        <tr>
                            <th rowspan="2" style="text-align:center;vertical-align:top">Turno</th>
                            <th colspan="{{count(array_count_values(array_column($serv_semana_to,'semana'))) }}" style="text-align:center">Semanas</th>
                            <th colspan="2"  style="text-align:center">Desempeño</th>
                        </tr>

                        <tr>
                            
                            @for($i = 0; $i <  count($serv_semana_to); $i++  )
                                @if($i == 0 )
                                    <th>{{$serv_semana_to[$i]->semana}}</th>
                                @elseif ( $serv_semana_to[$i]->semana != $serv_semana_to[$i-1]->semana )
                                    <th>{{$serv_semana_to[$i]->semana}}</th>
                                @endif                            
                            @endfor
                            <th>Inferior</th>
                            <th>Superior</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i <  $numero_turnos_to; $i++  )
                            <tr>
                                <th>{{$serv_semana_to[$i]->DescTurno }}</th>
                                @foreach($serv_semana_to as $serv)

                                    @if($serv->DescTurno == $serv_semana_to[$i]->DescTurno   )
                                        <td @if($serv->Cumplimiento == 2) class="td-objetivo-rango-superior" @elseif($serv->Cumplimiento == 0) class="td-objetivo-rango-inferior" @else class="td-objetivo-rango-normal" @endif     >
                                            {{$serv->ServicioTurno}}
                                        </td>
                                    @endif
                                    
                                @endforeach
                                <td >< {{$serv_semana_to[$i]->RangoInferior}}</td>
                                <td>{{$serv_semana_to[$i]->RangoSuperior}} <</td>
                            </tr>                       
                        @endfor
                    </tbody>
                </table>
            
            </div>

            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Puntualidad por Semana según Turno operador</h2>
                <div class="clearfix"></div>
                </div>
            <div class="x_content">
                <table class="table table-bordered table-responsive table-indicadores ">
                    <thead class="thead-inverse">
                        <tr>
                            <th rowspan="2" style="text-align:center;vertical-align:top">Turno</th>
                            <th colspan="{{count(array_count_values(array_column($puntuaidad_semana_to,'semana'))) }}" style="text-align:center">Semanas</th>
                            <th colspan="2"  style="text-align:center">Desempeño</th>
                        </tr>
                        <tr>
                            
                            @for($i = 0; $i <  count($puntuaidad_semana_to); $i++  )
                                @if($i == 0 )
                                    <th scope="col">{{$puntuaidad_semana_to[$i]->semana}}</th>
                                @elseif ( $puntuaidad_semana_to[$i]->semana != $puntuaidad_semana_to[$i-1]->semana )
                                    <th>{{$puntuaidad_semana_to[$i]->semana}}</th>
                                @endif                            
                            @endfor
                            <th>Inferior</th>
                            <th>Superior</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i <  count(array_count_values(array_column($puntuaidad_semana_to,'DescTurno'))); $i++  )
                            <tr>
                                <th scope="row" >{{$puntuaidad_semana_to[$i]->DescTurno }}</th>
                                @foreach($puntuaidad_semana_to as $serv)

                                    @if($serv->DescTurno == $puntuaidad_semana_to[$i]->DescTurno   )
                                        <td  @if($serv->Cumplimiento == 2) class="td-objetivo-rango-superior" @elseif($serv->Cumplimiento == 0) class="td-objetivo-rango-inferior" @else class="td-objetivo-rango-normal" @endif    >
                                            {{$serv->Puntualidad}}
                                        
                                        </td>
                                    @endif
                                @endforeach
                                <td >< {{$puntuaidad_semana_to[$i]->RangoInferior}}</td>
                                <td>{{$puntuaidad_semana_to[$i]->RangoSuperior}} <</td>
                            </tr>                       
                        @endfor
                    </tbody>
                </table>
            
            </div>
            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Análisis máximos</h2>
                <div class="clearfix"></div>
                </div>
            <div class="x_content">

            
            </div>
            <!--Servicios recibidos del operador !-->
            <div class="x_title">
                <h2>Análisis mínimos</h2>
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

@section('scripts')
<script src="{{URL::to('Application/Produccion/indicadores.js')}}"></script>
<script src="{{URL::to('html2canvas/html2canvas.min.js')}}"></script>
<script src="{{URL::to('jsPdf/jspdf.min.js')}}"></script>

@endsection