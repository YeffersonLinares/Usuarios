<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ env('APP_NAME')}}</title>
    <link rel="stylesheet" href="../../../css/template.css">
    <link rel="shortcut icon" href="../../../../images/sin_escudo.png" />     
</head>
<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper" >
          <div class="content-wrapper d-flex align-items-center auth auth-img-bg">
            <div class="row flex-grow" >
                <div class="auth-form-transparent text-left p-3" id="login_cont">
                  <div class="brand-logo text-center">
                    <img src="../../../../images/departamentos/Logo_CNE.png" id="logo_cne" alt="logo">
                  </div>
                  <div class="alert alert-danger alert-change-danger" role="alert" style="display: none">
                    <p class="mb-0">Las contraseñas no coinciden.</p>
                    </div>
                  <form class="pt-3" method="post" id="form-change-password"action="<?php echo route($ruta) ?>" style="padding: 0px 20px;">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <div class="input-group{{$errors->has('email' ? 'is-invalid' : '')}}">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fa fa-at fa-2x" style="color:#0172B2" aria-hidden="true"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control form-control-lg border-left-0" id="email" name="email" value="{{ $email }}" required autocomplete="email" autofocus placeholder="Contraseña">
                        {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="token" value="{{$token}}">
                      <div class="input-group{{ $errors->has('password1' ? 'is-invalid' : '') }}">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fa fa-key fa-2x" style="color:#0172B2" aria-hidden="true"></i>
                          </span>
                        </div>
                        <input type="password" class="form-control form-control-lg border-left-0" id="password1" name="password1" value="{{ old('password1') }}" required autocomplete="password1" autofocus placeholder="Contraseña">
                        {!!$errors->first('password1','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group{{ $errors->has('password2' ? 'is-invalid' : '') }}">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fa fa-key fa-2x" style="color:#0172B2" aria-hidden="true"></i>
                          </span>
                        </div>
                        <input type="password" class="form-control form-control-lg border-left-0" id="password2" name="password2" value="{{ old('password2') }}" required autocomplete="password2" autofocus placeholder="Confirmar Contraseña">
                        {!!$errors->first('password2','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                    </div>
                    <div class="my-3">
                      <button type="button"  id="btn_ingresar" class="btn btn-info btn-md btn-block" >Cambiar</button>
                    </div>
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

    <!-- End custom js for this page-->
    <script src="../../../js/template.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn_ingresar').click(function(){
                var password1 = $('#password1').val(); 
                var password2 = $('#password2').val(); 
                console.log(password1,'hhh');
                if((password1 == password2) && (password1 != '' && password2 != ''))
                {
                    $('.alert-change-danger').css('display', 'none');
                    $('#form-change-password').submit();
                }
                else
                {
                    if(password1 == '' && password2 == '')
                    {
                        $('.alert-change-danger').css('display', 'block');
                        $('.alert-change-danger').text('Por favor complete las contraseñas');
                    }

                    if(password1 != password2)
                    {
                        $('.alert-change-danger').css('display', 'block');
                        $('.alert-change-danger').text('Las contraseñas no coinciden');
                    }
                }
            })
        });

    </script>
</body>
</html>