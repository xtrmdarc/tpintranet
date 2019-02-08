@extends('layouts.Application.master')

@section('content')
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3 class="title text-primary">Estadistica de Clientes</h3>
        </div>
        <button class="btn btn-primary" style="float:right;" onclick="indicadores_pdf(2)">PDF</button>
        <div class="clearfix"></div>
        <form id="frm-buscar-flota" action="/Administracion/BuscarFlota" method="POST">
          @csrf
           
          
        </form>
      </div>
  
      <div class="clearfix"></div>
      
      <div id="est_cli_div" class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">

                <div class="row" style="margin-top:20px;margin-bottom:20px;">
                    
                    <table class="table table-responsive table-indicadores table-bordered" >
                        <thead>
                            @for($i = 0; $i <  count(array_count_values(array_column($crec_semanal,'semana'))); $i++  )
                                <th style="text-align:center">{{(array_keys(array_count_values(array_column($crec_semanal,'semana'))))[$i] }} </th>
                            @endfor
                            <th> Consumo Total</th>
                            <th> Consumo Promedio Ant.</th>
                            <th> Variación</th>
                        </thead>
                        <tbody>
                            @for($i = 0 ; $i< count($crec_semanal);$i++)
                                <td> {{'S/. '.number_format($crec_semanal[$i]->Consumo,2) }} </td>
                            @endfor
                            <td >{{'S/. '.number_format($crec_semanal[0]->ConsumoTotal,2) }}</td>
                            <td >{{'S/. '.number_format($crec_semanal[0]->ConsumoProm,2) }}</td>
                            <td class="{{$crec_semanal[ count($crec_semanal)-1]->DiferenciaPorc> 0?'td-objetivo-rango-superior':'td-objetivo-rango-inferior'}}" > {{number_format($crec_semanal[count($crec_semanal)-1]->DiferenciaPorc *100,2) }}%</td>
                        </tbody>
                    </table>
                    
                    
                            
                </div>
            
            <!--Servicios hechos en los turnos !-->
            <div class="x_title">
                <h2>Variación porcentual de última semana por Cliente </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="est_cli_table" class="table table-bordered table-responsive table-indicadores"  style="width:100%">
                    <thead class="thead-inverse">
                        <tr>
                            <th rowspan="2" style="text-align:center;vertical-align:center">Cliente</th>
                            <th colspan="{{count(array_count_values(array_column($est_cli,'semana'))) }}" style="text-align:center">Semanas</th>
                            <th colspan="3">Desempeño</th>
                        </tr>
                        <tr>
                            
                                @for($i = 0; $i <  count(array_count_values(array_column($est_cli,'semana'))); $i++  )
                                    <th>{{(array_keys(array_count_values(array_column($est_cli,'semana'))))[$i] }} </th>        
                                @endfor
                                <th>Cons. Tot.</th>
                                <th>Cons. Prom. Ant.</th>
                                <th>Variación</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @for($i = 0; $i <  count($est_cli); $i++  )
                          
                                @if((isset($est_cli[$i+1]) && $est_cli[$i]->IdCliente != $est_cli[$i+1]->IdCliente) || $i==  count($est_cli))
                                <tr>
                                    <th>{{$est_cli[$i]->NombreCliente }}</th>
                                    @php
                                        $cont = 0
                                    @endphp
                                    @for($k = 0 ; $k < count(array_count_values(array_column($est_cli,'semana'))); $k++)
                                        @php
                                            $cont1 = 0
                                        @endphp
                                        @foreach($est_cli as $cliente)
                                                @if($cliente->IdCliente == $est_cli[$i]->IdCliente && (array_keys(array_count_values(array_column($est_cli,'semana'))))[$k] == $cliente->semana )

                                                    <td  >{{$cliente->Cons_Semana}} </td>
                                                    @php
                                                        $cont++;
                                                        $cont1++;
                                                    @endphp
                                                @endif
                                        
                                            {{-- @if($serv->DescTurno == $prod_prom_semana_tc[$i]->DescTurno   )
                                                <td  @if($serv->Cumplimiento == 2) class="td-objetivo-rango-superior" @elseif($serv->Cumplimiento == 0) class="td-objetivo-rango-inferior" @else class="td-objetivo-rango-normal" @endif    >
                                                    {{$serv->PromedioSemanal}}
                                                
                                                </td>
                                            @endif --}}
                                        @endforeach
                                        @if($cont1 == 0)
                                            <td>0.00</td>
                                        @endif
                                    @endfor           
                                    
                                    {{-- @for($j = $cont; $j < count(array_count_values(array_column($est_cli,'semana')));$j++ )
                                            <td> 0.00 </td>
                                    @endfor --}}
                                        <td>{{$est_cli[$i]->Cons_Total}}</td>
                                        <td>{{$est_cli[$i]->Cons_Prom}}</td>
                                        <td class="{{$est_cli[$i]->DiferenciaPorc>0?'td-objetivo-rango-superior':'td-objetivo-rango-inferior' }}">{{number_format(round( $est_cli[$i]->DiferenciaPorc * 100,2),'2','.','') }}%</td>
                                    {{-- <td >< {{$prod_prom_semana_tc[$i]->RangoInferior}}</td>
                                    <td>{{$prod_prom_semana_tc[$i]->RangoSuperior}} <</td> --}}
                                </tr>    
                                @endif                   
                          @endfor  
                    
                        
                    </tbody>
                </table>
             </div>

       

           
            

          </div>
        </div>
  
  
        
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{URL::to('Application/Gerencia/est_cli.js')}}"></script>
    <script src="{{URL::to('html2canvas/html2canvas.min.js')}}"></script>
    <script src="{{URL::to('jsPdf/jspdf.min.js')}}"></script>
    <script>
        est_cli_table = $('#est_cli_table').DataTable({
            
            'language': {
                  url:'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
              } 
        });
    </script>
@endsection