<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio Sesion</title>

    <!-- Bootstrap -->
    <link href="{{URL::to('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{URL::to('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{URL::to('nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{URL::to('animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{URL::to('build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="Login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form  action="/Login" method="POST">
              @csrf
              <h1>Iniciar Sesión</h1>
              <div>
                <input type="text" class="form-control" name="user" placeholder="Usuario" required/>
              </div>
              <div>
                <input type="password" class="form-control" name="pass" placeholder="Contraseña" required />
              </div>
              <div>
                <input id="send" type="submit" class="btn btn-success" value="Enviar"/>
                <a class="reset_pass" href="#">¿Olvidaste tu contraseña?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                {{-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> --}}

                <div class="clearfix"></div>
                <br />

                <div>
                  {{-- <h1>Taxi Puntual</h1>  --}}
                  <p>©2019 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        {{-- <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> --}}
      </div>
    </div>
  </body>
</html>
