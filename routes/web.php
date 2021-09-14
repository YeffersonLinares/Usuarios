<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParametrizarMenusController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\CentralizadoController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\DepartamentoCentralizadoController;
use App\Http\Controllers\ParametrizarRutasVueController;
use App\Http\Controllers\PasswordResetControllerWeb;
use App\Http\Middleware\ChangeDb;
use App\Http\Middleware\CheckSesion;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\ValidateSesion;

Route::get('/user', [UserController::class, 'index']);

Route::get('/', [LoginController::class,'showLoginForm'])->name('showlogin')->middleware('validateSesion')->middleware('CheckSesion');
Route::post('/login', [LoginController::class,'login'])->name('login');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
Route::get('/recovery', [LoginController::class,'recovery'])->name('recovery');
Route::view('/menu_gob', 'auth.menu_gob');
Route::get('/token/{error}', [LoginController::class,'showLoginFormRedirect']);
Route::get('autoLoginRedirect/{conexion}',[CentralizadoController::class,'loginRedirect'])->name('autoLoginRedirect');

Route::post('web/create', [PasswordResetControllerWeb::class,'create'])->name('password.create');
Route::get('web/password/find/{token}', [PasswordResetControllerWeb::class,'find']);
Route::post('web/reset', [PasswordResetControllerWeb::class,'reset'])->name('password.reset');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('autologin/{userId}/{conexion}/{token}',[CentralizadoController::class,'change']);
});

Route::middleware('auth')->group(function () {          
    
    Route::get('centralizado',[CentralizadoController::class,'index'])->name('centralizado')->middleware('validateSesion');
    Route::get('centralizadoRedirect',[CentralizadoController::class,'getViewCentralizado'])->middleware('validateSesion');
    Route::get('centralizado/{conexion}',[CentralizadoController::class,'change'])->name('changeDb');
    Route::get('administracion',[CentralizadoController::class,'redirectAdmin'])->name('administracion');

    Route::group(["middleware" => ["CheckDepto","ChangeDb","validateSesion"]],function ()  {

        Route::get('/main',[MainController::class, 'index'])->name('main');
        Route::get('/rol', [RolController::class,'index']);
        Route::post('/rol/create', [RolController::class,'store']);
        Route::put('/rol/update', [RolController::class,'update']);
        Route::put('/rol/updatePermisos', [RolController::class,'updatePermisos']);
        Route::put('/rol/inactivar', [RolController::class,'inactivar']);
        Route::put('/rol/activar', [RolController::class,'activar']);
        Route::get('/rol/getrol', [RolController::class,'getRoles']);
        Route::get('/rol/obtenerRolPermisos', [RolController::class,'obtenerRolPermisos']);
        Route::get('/permission', [PermisosController::class,'index']);
        Route::post('/permission/create', [PermisosController::class,'store']);
        Route::put('/permission/update', [PermisosController::class,'update']);
        Route::put('/permission/cambiarEstado', [PermisosController::class,'cambiarEstado']);
        Route::get('/permission/obtenerPermisos', [PermisosController::class,'obtenerPermisos']);
        Route::get('/tipoDoc/gettipodoc',[UserController::class,'getTipoDoc']);

        Route::get('/usuarios', [UserController::class,'index']);
        Route::post('/usuarios/create', [UserController::class,'store']);
        Route::put('/usuarios/update', [UserController::class,'update']);
        Route::put('/usuarios/inactivar', [UserController::class,'inactivar']);
        Route::put('/usuarios/activar', [UserController::class,'activar']);
        Route::get('/usuarios/usuarioActivo', [UserController::class,'getUsuarioActivo']);
        Route::get('/usuarios/cambiarEstadoNoti', [UserController::class,'cambiarEstadoNoti']);
        Route::put('/usuarios/cambiarcontraseña', [UserController::class,'cambiarContraseña']);
        Route::get('/usuarios/getDeptoUser/{id}', [UserController::class,'getDeptoUser']);
        Route::get('/usuarios/getUserCentralizado', [UserController::class,'getUserCentralizado']);
              
        Route::get('/menus', [ParametrizarMenusController::class,'index']);
        Route::post('/menus/create', [ParametrizarMenusController::class,'store']);
        Route::put('/menus/update', [ParametrizarMenusController::class,'update']);
        Route::put('/menus/cambiarEstado', [ParametrizarMenusController::class,'cambiarEstado']);
        Route::get('/menus/consultarMenuPadre/{id}', [ParametrizarMenusController::class,'consultarMenuPadre']);
        Route::get('/menus/consultarPermisosPadre',  [ParametrizarMenusController::class,'consultarPermisosPadre']);
        Route::get('/menus/getMenus', [ParametrizarMenusController::class,'getMenus']);
        Route::get('/menus/verificaUltimoHijo',  [ParametrizarMenusController::class,'verificaUltimoHijo']);
        Route::get('/menus/getRutaRelativa',[ParametrizarMenusController::class,'getRutaRelativa']);
        Route::get('/menus/getRutasVue',[ParametrizarMenusController::class,'getRutasVue']);
        Route::get('/menus/getRutasVueMenu',[ParametrizarMenusController::class,'getRutasVueMenu']);

        Route::put('/permisos/asignarPermisos',  [PermisoController::class,'asignarPermisos']);

        Route::get('/departamentos/selectDepartamento', [DepartamentoController::class,'selectDepartamento']);
        Route::get('/ciudades/selectCiudad/{id}',[CiudadController::class,'selectCiudad']);

        Route::get('/departamentosCentralizado', [DepartamentoCentralizadoController::class,'index']);
        Route::post('/departamentosCentralizado/create', [DepartamentoCentralizadoController::class,'store']);
        Route::post('/departamentosCentralizado/update', [DepartamentoCentralizadoController::class,'update']);
        Route::put('/departamentosCentralizado/cambiarEstado', [DepartamentoCentralizadoController::class,'cambiarEstado']);
        Route::get('/departamentosCentralizado/getDepartamentos', [DepartamentoCentralizadoController::class,'getDepartamentos']);

        Route::get('/ciudad',[CiudadController::class,'index']);
        Route::post('/ciudad/store',[CiudadController::class,'store']);
        Route::put('/ciudad/update',[CiudadController::class,'update']);
        Route::put('/ciudad/inactivar', [CiudadController::class,'inactivar']);
        Route::put('/ciudad/activar', [CiudadController::class,'activar']);

        Route::get('/departamento',[DepartamentoController::class,'index']);
        Route::post('/departamento/store',[DepartamentoController::class,'store']);
        Route::put('/departamento/update',[DepartamentoController::class,'update']);
        Route::put('/departamento/inactivar', [DepartamentoController::class,'inactivar']);
        Route::put('/departamento/activar', [DepartamentoController::class,'activar']);
        Route::get('/departamento/selectDepartamento', [DepartamentoController::class,'seleccioneDepartamento']);

        Route::get('/tipoDocumento',[TipoDocumentoController::class,'index']);
        Route::post('/tipoDocumento/create', [TipoDocumentoController::class,'store']);
        Route::put('/tipoDocumento/update', [TipoDocumentoController::class,'update']);
        Route::put('/tipoDocumento/inactivar', [TipoDocumentoController::class,'inactivar']);
        Route::put('/tipoDocumento/activar', [TipoDocumentoController::class,'activar']);

        Route::get('/rutasVue', [ParametrizarRutasVueController::class,'index']);
        Route::post('/rutasVue/create', [ParametrizarRutasVueController::class,'store']);
        Route::put('/rutasVue/update', [ParametrizarRutasVueController::class,'update']);
        Route::put('/rutasVue/cambiarEstado', [ParametrizarRutasVueController::class,'cambiarEstado']);
   
    });
});