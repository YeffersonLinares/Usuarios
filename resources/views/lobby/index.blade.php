{{-- @extends('auth.contenido') --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ env('APP_NAME')}}</title>
    <link rel="stylesheet" href="css/template.css">
    <link rel="shortcut icon" href="../../../../images/sin_escudo.png" />
  </head>
  <body>
  <div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
      <div class="row flex-grow">
        <div class="auth-form-transparent col-md-8 text-center">        
          <div id="menu_goberna">
            <div class="offset-3 col-md-6 brand-logo text-center">
              <img src="../../../../images/departamentos/Logo_CNE.png" id="logo_cne2" alt="logo">
              @if(session('sin_permisos'))
                <div class="text-center" style="margin-top: 2%;">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{!! session()->get('sin_permisos') !!}</p>
                  </div>
              </div>
              @endif
              @if(session('activeDepto'))
                <div class="text-center" style="margin-top: 2%;">       
                  <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{!!  session()->get('activeDepto') !!}</p>
                  </div>
                </div>
              @endif
              @if(isset($_GET['error_token']))
                <div class="text-center">       
                    <div class="alert alert-danger" role="alert">
                      <p class="mb-0">{!! $_GET['error_token'] !!}</p>
                    </div>
                </div>
              @endif
            </div>
            <div class="row col-md-12" style="margin: auto;">
              
              @foreach($data as $key)
                <div class=" col-lg-3 col-md-4 col-sm-4 col-xs-12">
                  <a type="button" href="{{ route('autoLoginRedirect',[$key->id]) }}" class="link_app" >
                    <div class="card" id="card-cuerpo">
                      @if($key->url_logo != '')
                        <img src="{{$key->url_logo}}" class="img img-responsive card-img-top img-card" > 
                      @else
                        <img src="images/auth/sin_escudo.png" class="img img-responsive card-img-top img-card"> 
                      @endif
                        <h3  class="link_app_h3">{{ $key->nombre}}</h3> 
                    </div>
                  </a>       
                </div>
              @endforeach
            </div>
              <div class="row" style="padding-bottom: 1rem;">
                <div class="offset-lg-2 offset-md-2 offset-xs-3  offset-sm-3 offset-xl-3 col-md-4 col-lg-4 col-xl-3 col-xs-6  col-sm-6">
                  <a id="btn_administracion" type="button" href="{{ route('administracion') }}" class="btn btn-outline-light  btn-block">
                    <h3 class="h3_btn">Administración</h3> 
                  </a>
                </div>  
                <div class="col-md-4 col-lg-4 col-xs-6  col-sm-6 col-xl-3 col-xxl-3">
                  <a id="btn_salir" type="button" href="{{ route('logout') }}"  class="btn btn-outline-light btn-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                    <h3 class="h3_btn"><i class="fa fa-sign-out" style="font-size: 1.2em;" aria-hidden="true"></i> Cerrar Sesión</h3>
                  </a>         
                </div> 
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">    
                {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
  
  </html>

