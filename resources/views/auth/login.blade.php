@extends('auth.contenido')

@section('login')
@php 
    $equivalencias = new App\Helpers\Equivalencias; 
@endphp
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper" >
    <div class="content-wrapper d-flex align-items-center auth auth-img-bg">
      <div class="row flex-grow" >
          <div class="auth-form-transparent text-left p-3" id="login_cont">
            <div class="brand-logo text-center">
              <img src="../../../../images/departamentos/Logo_CNE.png" id="logo_cne" alt="logo">
            </div>
            @if(session('error'))
              <div class="text-center">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{!! session()->get('error') !!}</p>
                  </div>
              </div>
            @endif
            @if(session('error_token'))
              <div class="text-center">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{!! session()->get('error_token') !!}</p>
                  </div>
              </div>
            @endif         
            @if(session('ingreso_incorrecto'))
              <div class="text-center">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{!! session()->get('ingreso_incorrecto') !!}</p>
                  </div>
              </div>
            @endif
            @if(isset($_GET['token']))
              <div class="text-center">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">Error en el token de seguridad para Acceder</p>
                  </div>
              </div>
            @endif
            @if(session('sesion_finalizada'))
              <div class="text-center">       
                  <div class="alert alert-info" role="alert">
                    <p class="mb-0">{!! session()->get('sesion_finalizada') !!}</p>
                  </div>
              </div>
            @endif
            <form class="pt-2" method="POST" action="{{ route('login') }}" style="padding: 0px 20px;">
                {{ csrf_field() }}
              <div class="form-group">
                <div class="input-group{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-4">
                      <i class="fa fa-user-circle fa-2x" style="color:#0172B2" aria-hidden="true"></i>
                    </span>
                  </div>
                  <input type="text" class="input-group-text form-control" id="usuario" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus placeholder="Usuario / Correo Electrónico">
                  {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                </div>
              </div>
              <div class="form-group{{$errors->has('password' ? 'is-invalid' : '')}}">
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="typcn typcn-lock-closed-outline" style="font-size: 1.5em; color:#0172B2;margin-left: -11%;margin-top: -20%; margin-bottom: -18%;"></i>
                    </span>
                  </div>
                  <input type="password" class="input-group-text form-control" id="password" name="password" required autocomplete="current-password" placeholder="Contraseña">                        
                  {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                </div>
              </div>
              <div class="my-3">
                <button type="submit" class="btn btn-info btn-md btn-block" id="btn_ingresar">Ingresar</button>
              </div>
              @if(session('exito'))
                <div class="alert alert-success" role="alert">
                  <p class="mb-0">Se ha cambiado la contraseña con exito.</p>
                </div>
              @endif
              <div class="text-center mt-4 font-weight-light">
                 <a class="text-info" style="color: #1e69da !important;" href="{{ route('recovery') }}">Recuperar Contraseña</a>
              </div>
              <br>
              <div class="text-center">       
                <div class="alert alert-info" role="alert">
                  <p class="mb-0">
                    Consulta Ciudadana de información <a href="{{$equivalencias::urlFondo()}}informes/cne#/">Aqui</a>
                   <!--  <button class="btn btn-info btn-sm">Consultar</button> -->
                  </p>
                </div>
              </div>
            </div>
            </form>
          </div>
      </div>
    </div>
  </div>
  <div class="container">
  </div>
</div>
  
@endsection
