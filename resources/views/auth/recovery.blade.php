@extends('auth.contenido_recovery')

@section('recovery')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper" >
      <div class="content-wrapper d-flex align-items-center auth auth-img-bg">
        <div class="row flex-grow" >
            <div class="auth-form-transparent text-left p-3" id="login_cont">
              <div class="brand-logo text-center">
                <img src="../../../../images/departamentos/Logo_CNE.png" id="logo_cne" alt="logo">
              </div>
              @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                      <p class="mb-0">{{ $error }}</p>
                  @endforeach
                </div>
              @endif
              @if(session('alert'))
                <div class="alert alert-success" role="alert">
                  <p class="mb-0">Se ha enviado un correo.</p>
                </div>
              @endif
              @if(session('exito'))
                <div class="alert alert-success" role="alert">
                  <p class="mb-0">Se ha cambiado la contraseña con exito.</p>
                </div>
              @endif
              <form class="pt-2" method="POST" action="{{route('password.create')}}" style="padding: 0px 20px;">
                  {{ csrf_field() }}
                <div class="form-group">
                  <div class="text-center">       
                    <div class="alert alert-info" role="alert">
                      <p class="mb-0"> 
                        <label>Para recuperar la contraseña, registre el correo electrónico asociado.</label> 
                      </p>
                    </div>
                  </div>
                  <div class="input-group{{$errors->has('email' ? 'is-invalid' : '')}}">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-4">
                        <i class="fa fa-at fa-2x" style="color:#0172B2" aria-hidden="true"></i>
                      </span>
                    </div>
                    <input type="text" class="input-group-text form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo Electrónico">
                    {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}
                  </div>
                </div>
                <div class="my-3">
                  <button type="submit" class="btn btn-info btn-md btn-block" id="btn_ingresar">Enviar</button>
                </div>
                @if(session('exito'))
                  <div class="alert alert-success" role="alert">
                    <p class="mb-0">Se ha cambiado la contraseña con exito.</p>
                  </div>
                @endif
                <div class="text-center mt-4 font-weight-light">
                  Volver a iniciar sesión <a class="text-info" style="color: #1e69da !important;" href="/">Click Aqui</a>
                </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
</div>


<div>
    
</div>

@endsection