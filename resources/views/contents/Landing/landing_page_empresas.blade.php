@extends('layouts.Landing.master')

@section('content')
<style>
    body {
        font-family: 'Open Sans', sans-serif;
       
    }

    @media (min-width: 768px){
        .visible-sm{
            display:block;
        }
    }
    @media (max-width: 768px){
        .visible-sm{
            display:none;
        }
    }
    .bg-secondary{
        background-color: #163410 !important;
    }
    .why-us h3{
        font-size: 1.2rem;
        color: white;
        font-weight: 800;
        margin-top: 20px;
    }
    .why-us img{
        width:80px;
    }
    .why-us p{
        color: white;
        font-weight: 300;
    }
    .filter-white{
        filter: brightness(0) invert(1);
    }
    .logos{
        align-content: center;
        vertical-align: middle;
        align-items: center;
    }
    .logos div{
        padding-top:15px;
        padding-bottom: 15px;
    }
    #above-the-fold{
        background-image: url('Landing/img/background-atf.png')    
    }
</style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800|Pacifico" rel="stylesheet">

    <div class="container-fluid">
        {{-- Header --}}
        <div class="row">
            <div class="col-sm-12 pt-2">
                <div class="nav-bar">
                    <img src="{{URL::to('Landing/img/tp_logo.png')}} " alt="logo_taxi_puntual" width="100px">
                </div>  
            </div>
        </div>    
        {{-- Main above the fold --}}
        <div class="row p-3 pt-5 pb-5" id="above-the-fold">
            <div class="col-md-7" >
                <div class="wrapper pl-4">
                    <h1 style="font-weight:800;font-size:2.5rem">
                        TRANSPORTE <br> CORPORATIVO
                    </h1>
                    <h2 class="mt-4" style="font-weight:300;font-size:2rem">
                        Movilidad privada para las 
                        empresas <br> que mueven
                        la industría.
                    </h2>
                    <div class="visible-sm mt-5">
                        &nbsp;
                    </div>
                    <h2 class="mx-auto mt-5 mb-4" style="display:block;font-family: 'Pacifico', sans-Serif;"> 
                        20 años transportando a <br> las empresas de Lima
                    </h2>
                </div>
                
            </div>
            <div class="col-sm-10 col-md-5 col-lg-4 mx-auto" >
                <div class="col-sm-11 col-md-12 col-lg-12 text-center center-block mx-auto" style="align-items: center;" >
                    <div class="card" style="padding:1em;background-color:#373737;color:white;" >
                        <p ><span style="font-weight:700" > ¿Quieres que transportemos a tu 
                                empresa? </span><span style="font-weight:300" >Rellena el formulario y 
                                obtén tu </span> <span style="font-weight:700" > tarifario gratis. </span></p>
    
                        <form class="form mt-2 p-2" id="form-solicitud"   method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email"  required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Empresa"  required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="distrito" id="distrito" placeholder="Distrito" required>
                            </div>
                            <div class="form-group">
                                <select name="medio" id="medio" class="form-control" >
                                    <option value="" disabled selected>¿Cómo nos conociste?</option>
                                    <option value="1">Buscando en google</option>
                                    <option value="2">Facebook</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <input id="btn_submit" type="submit" class="btn btn-block btn-primary border-0" value="SOLICITAR"   style="background-color:#157802">
                            </div>
                            <p  id="gracias" style="display:none"> Gracias! Nos pondremos en contacto contigo.</p>
                        </form>
                    </div>
                </div>
                

                

            </div>
        </div>
        {{-- Why us ? --}}
        <div class="row bg-secondary p-4 pt-5 why-us" style="color:white;">
            <div class="col-md-6">
                <h2  style="font-weight:800;font-size:2.5rem">
                    ¿POR QUÉ LAS EMPRESAS <br> NOS PREFIEREN?
                </h2>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <img src="{{URL::to('Landing/img/tarifario.png')}} " alt="tarifario" class="img-fluid" >
                        <h3> TARIFAS FLAT</h3>
                        <p>Cobramos las tarifas acordadas en tu tarifario. <b style="font-weight:800">SIEMPRE.</b></p>
                    </div>
                    <div class="col-sm-6  mb-4">
                        <img src="{{URL::to('Landing/img/credito_corp.png')}} " alt="credito corporativo" class="img-fluid" >
                        <h3> CRÉDITO CORPORATIVO</h3>
                        <p>Nos adpatamos a tu ritmo. Movilízate ahora, paga cuando quieras. <b style="font-weight:800">OFRECEMOS FACTURA.</b> </p>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <img src="{{URL::to('Landing/img/seguridad.png')}} " alt="seguridad" class="img-fluid" >
                        <h3> SEGURIDAD</h3>
                        <p>Nuestros conductores pasan un exigente filtro. </p>
                    </div>   
                    <div class="col-sm-6 mb-4">
                        <img src="{{URL::to('Landing/img/soporte.png')}} " alt="soporte" class="img-fluid" >
                        <h3> SOPORTE 24/7</h3>
                        <p>Llama a nuestro call center en cualquier momento. Una voz humana te atenderá. </p>
                    </div>   
                    
                </div>
            </div>
        </div>
        {{-- Trust --}}
        <div class="row bg-secondary p-4 pt-5 " style="color:white;">
            <div class="col-sm-12">
                <h2 class="text-center" style="font-weight:800;font-size:2.5rem">ELLOS ESTAN CONFIANDO EN NOSOTROS</h2>
            </div>
            <div class="col-sm-12 pt-5">
                <div class="row text-center logos">
                    <div class="col-sm-3 mx-auto">
                        <img src="{{URL::to('Landing/img/everis_logo.png')}}" class="filter-white img-fluid" alt="everis_logo">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{URL::to('Landing/img/pcent_logo.png')}}"  class="filter-white img-fluid" alt="pcent_logo">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{URL::to('Landing/img/hym_logo.png')}}" class="filter-white img-fluid"  alt="hym_logo">
                    </div>
                    <div class="col-sm-3">
                        <img src="{{URL::to('Landing/img/anixter_logo.png')}}"  class="filter-white img-fluid" alt="anixter_logo">
                    </div>
    
                </div>
            </div>
            
            
        </div>
    </div>
    


@endsection()
@section('scripts')
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
        $('#form-solicitud').on('submit',function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            let nombre_contacto = $('#nombre').val();
            let email = $('#email').val();
            let telefono = $('#telefono').val();
            let empresa = $('#empresa').val();
            let distrito= $('#distrito').val();
            let medio = $('#medio option:selected').text();
            $('#btn_submit').val('Enviando..');
            $('#btn_submit').prop('disabled',true);
            Email.send({
                SecureToken:"94a1538d-4e77-4474-9624-0412e613cd80",
                To : 'marketing@taxipuntual.com',
                From : "marketing@taxipuntual.com",
                Subject : "Publicidad. 1 Lead. Solicitud de Tarifario por Landing Page.",
                Body : `
                <style>
                    h1{
                        font-family: sans-Serfi;
                    }
                    p{
                        margin-bottom: 1rem;
                    }
                </style>
                <h1>Nuevo lead por landing page.</h1> 
                <h2>Nombre Contacto </h2>
                <p>`+nombre_contacto+`</p>
                <h2>Email</h2>
                <p>`+email+`</p>
                <h2>Teléfono</h2>
                <p>`+telefono+`</p>
                <h2>Empresa </h2>
                <p>`+empresa+`</p>
                <h2>Distrito </h2>
                <p>`+distrito +`</p>
                <h2>Como nos encontró</h2>
                <p>`+medio +`</p>
                `
            }).then(function(){
                
                    $('#btn_submit').val('Enviado');
                    $('#gracias').css('display','block');
                }
            );
            return false;
        });
        
    </script>

@endsection
