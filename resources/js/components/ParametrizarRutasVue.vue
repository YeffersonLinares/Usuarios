<template>
    <main class="main col-12">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item" v-for="ruta in arrayRuta" :key="ruta">
                <router-link :to="{name:ruta.componente}">
                    <span v-if="ruta.nombre != ''">{{ruta.nombre}}</span>
                    <span v-else>{{ruta.componente}}</span>
                </router-link>
            </li>
        </ol>

        <div class="container-fluid">
            <!-- Tabla Listado -->
            <template v-if="listado==1">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Parametrizar Rutas Vue
                        <div v-permiso="'add_parametrizar_menus'">
                            <template>                     
                                <button type="button" @click="ingresarRuta('ruta','create')" class="btn btn-secondary">
                                    <i class="icon-plus"></i> Nuevo
                                </button>
                            </template>
                        </div>
                    </div>
                    <template>
                        <div  v-permiso="'view_parametrizar_menus'">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select class="form-control col-md-3" v-model="criterio">
                                                <option value="name">Nombre</option>
                                                <option value="component">Nombre Ruta Componente</option>
                                            </select>
                                            <input type="text" v-model="buscar" @keyup="listarRuta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                            <button type="submit" @click="listarRuta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group table-responsive">
                                    <div class="spinner" style="display: none">
                                        <div class="sk-chase">
                                            <div class="sk-chase-dot"></div>
                                            <div class="sk-chase-dot"></div>
                                            <div class="sk-chase-dot"></div>
                                            <div class="sk-chase-dot"></div>
                                            <div class="sk-chase-dot"></div>
                                            <div class="sk-chase-dot"></div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Opciones</th>
                                                <th>Nombre</th>
                                                <th>Path</th>
                                                <th>Componente</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-if="arrayRutas.length != 0">
                                                    <tr v-for="ruta in arrayRutas" :key="ruta.id">  
                                                    <td>
                                                        <template >
                                                            <button type="button" title="Editar" @click="ingresarRuta('ruta','update',ruta)" class="btn btn-inverse-warning btn-sm">
                                                            <i class="typcn typcn-edit"></i>
                                                            </button> &nbsp;
                                                        </template>
                                                        <template>
                                                            <template v-if="ruta.estado" class="preview">
                                                                <button type="button" title="Inactivar" class="btn btn-inverse-danger btn-sm" @click="cambiarEstado(ruta.id, ruta.estado)">
                                                                    <i class="typcn typcn-trash"></i>
                                                                </button>
                                                            </template>
                                                            <template v-else>
                                                                <button type="button" title="Activar" class="btn btn-inverse-success btn-sm" @click="cambiarEstado(ruta.id, ruta.estado)">
                                                                    <i class="typcn typcn-tick-outline"></i>
                                                                </button>
                                                            </template>
                                                        </template>
                                                    </td>
                                                    <td v-text="ruta.name"></td>
                                                    <td v-text="ruta.path"></td>
                                                    <td v-text="ruta.component"></td>
                                                    <td>
                                                        <div v-if="ruta.estado">
                                                            <span class="badge badge-outline-success">Activo</span>
                                                        </div>
                                                        <div v-else>
                                                            <span class="badge badge-outline-danger">Inactivo</span>
                                                        </div>
                                                    </td>
                                                </tr> 
                                            </template>   
                                            <template v-else>
                                                <tr>
                                                    <td colspan="5"><span>No se encontraron resultados</span></td>
                                                </tr>    
                                            </template>                           
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" v-if="pagination.current_page > 1">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                            </li>
                                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                            </li>
                                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
            <!-- Fin Tabla Listado -->
            <!-- Formulario de Ingreso y Actualizacion--> 
            <template v-if="listado==2">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title" v-text="tituloFormulario"></h4>
                        <p class="card-description">
                            Datos Basicos
                        </p>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" v-model="nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label>Path de la ruta 
                                    <small class="form-text text-muted" >
                                        Ej. sin parametros(  <span class="no_coinciden" >/usuarios</span> )<br>
                                        Ej. con parametros(  <span class="no_coinciden" >/user/:username/post/:post_id</span> )
                                    </small>
                                </label>
                                <input type="text" v-model="path" class="form-control" placeholder="Componente">
                                <small class="form-text text-muted" >
                                        Ruta (  <span class="no_coinciden" v-text="ruta+'/'+path"></span> )
                                </small>
                            </div>  
                            <div class="form-group">
                                <label>Nombre Componente
                                    <small class="form-text text-muted" >
                                       Ej: (  <span class="no_coinciden">Usuarios</span> )
                                    </small>
                                </label>
                                <input type="text" v-model="componente" class="form-control" placeholder="Componente">
                            </div>  
                            <div v-show="errorFormulario" class="row justify-content-center">       
                                <div class="alert alert-danger col-md-10  " role="alert">
                                <p class="mb-0"  v-for="error in errorMensajesFormularios" :key="error" v-text="error"></p>
                                </div>
                            </div>                         
                            <div class="form-group" >
                                <div  class="col-md-6" >
                                    <button v-if="tipoAccion==1" @click="createRuta()" type="button" class="btn btn-primary mr-2">Guardar</button>
                                    <button v-if="tipoAccion==1" class="btn btn-light" @click="cancelarIngreso()">Cancelar</button>
                                </div>
                                <div  class="col-md-6" >
                                    <button v-if="tipoAccion==2" @click="updateRuta()" type="button" class="btn btn-primary mr-2">Actualizar</button>
                                    <button v-if="tipoAccion==2" class="btn btn-light" @click="cancelarIngreso()">Cancelar</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </template>
            <!-- Fin Formulario de Asignacion de Permisos -->
        </div>
    </main>
</template>

<script>
    import { createPopper } from '@popperjs/core';

    export default {
        props: ['ruta'],
        data (){ // Resive los Datos que llegan
            return {
                // Inicialización de Variables
                idRuta : 0,
                arrayRutas : [],
                listado : 1,
                tituloFormulario : '',
                tipoAccion : 0,
                bandera : 0,
                errorFormulario : 0,
                errorMensajesFormularios : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'name',
                buscar : '',
                nombre: '',
                componente: '',
                path: '',
                arrayRuta: []
            }
        },
        components:{},
        computed:{ // Almacenamos en Chache la Paginación
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             
            },   
        },
        methods : {
            cambiarPagina(page,buscar,criterio){ // Metodo encargado de realizar el cambio de pagina
                //Actualiza la página actual
                this.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                this.listarRuta(page,buscar,criterio);
            },
            listarRuta (page,buscar,criterio){ // Metodo encargado de enviar los datos al listado
                $('.spinner').css('display', 'block');

                var url= this.ruta + '/rutasVue?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then((response)  => {
                    this.arrayRutas = response.data.rutas.data;
                    this.pagination= response.data.pagination;

                    $('.spinner').css('display', 'none');

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cancelarIngreso(){ // Metodo encargado de cancelar las acciones en los formularios
                this.listado=1;
                this.tituloFormulario = "";
                this.componente = '';
                this.nombre = '';     
                this.path = '';      
            },
            ingresarRuta (modelo, accion, data = []){ // Metodo encargado de cargar los formularios de crear y actualizar
                this.listado=2;
                console.log(accion);
                switch(modelo){
                    case "ruta":
                    {
                        switch(accion){
                            case 'create':
                            {   
                                this.tituloFormulario = "Registrar Ruta Vue";
                                this.nombre = '';
                                this.componente = '';
                                this.path = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':
                            {
                                this.tituloFormulario = "Actualizar la Ruta Vue";
                                this.idRuta = data['id'];
                                this.nombre = data['name'];
                                this.path = data['path'];
                                this.componente = data['component'];
                                this.tipoAccion = 2;
                                break;
                            }
                          
                        }
                    }
                }
            },
            cambiarEstado(id, estado) { // Metodo encargado de desactivar los registros 
                var title = estado == 1 ? 'Inactivar' : 'Activar';
                var title_es = estado == 1 ? 'Desactivado' : 'Activado';
                var estado_enviar = estado == 1 ? 0 : 1;

                Swal.fire({
                    title: 'Esta seguro de '+title+' este Menu?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.value) {
                            var url= this.ruta  + '/rutasVue/cambiarEstado';
                            axios.put(url,{
                                'id': id,
                                'estado': estado_enviar
                            }).then((response) => {
                                this.listarRuta(1,'','nombre');
                                Swal.fire(
                                title_es+'!',
                                'La Ruta ha sido '+title_es+' con éxito.',
                                'success'
                                )
                            }).catch(function (error) {
                                console.log(error);
                            });
                        } else if (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            
                        }
                    }) 
            },
            createRuta() { // Metodo encargado de realizar el envio de datos para la creacion
                if(this.validacionFormulario()){
                    return;
                }
                
                var url=  this.ruta + '/rutasVue/create';
                axios.post(url,{
                    'name' : this.nombre,
                    'component' : this.componente,
                    'path' : this.path,
                }).then((response) => {
                    this.cancelarIngreso();
                    this.listarRuta(1,'','nombre');
                     if(response.data.status){
                        swal.fire({
                            icon: 'success',
                            title: 'Ruta creada Exitosamente!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }else{
                        swal.fire({
                            icon: 'error',
                            title: 'Path ya existe!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }
                })
                .catch(function (error) {
                     if(error.response.status == 422){

                        let mensaje = '';
                        let respuesta = error.response.data.errors;

                        if(respuesta.name != undefined){
                            for(let err in respuesta.name){
                                mensaje += respuesta.name[err]+', ';
                            }
                        }
                        if(respuesta.path != undefined){
                            for(let err in respuesta.path){
                                mensaje += respuesta.path[err]+', ';
                            }
                        }
                         if(respuesta.component != undefined){
                            for(let err in respuesta.component){
                                mensaje += respuesta.component[err]+', ';
                            }
                        }
                  
                        swal.fire({
                            icon: 'error',
                            title: 'Error al agregar Ruta!',
                            text: mensaje 
                        });
                    }
                });
            },
            updateRuta() { // Metodo encargado de realizar el envio de datos para la actualizacion
                if(this.validacionFormulario()){
                    return;
                }
               
                var url= this.ruta  + '/rutasVue/update';
                axios.put(url,{
                    'name' : this.nombre,
                    'component' : this.componente,
                    'path' : this.path,
                    'id' : this.idRuta
                }).then((response) =>  {
                    this.cancelarIngreso();
                    this.listarRuta(1,'','nombre');
                    if(response.data.status){
                        swal.fire({
                            icon: 'success',
                            title: 'Ruta actualizada Exitosamente!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }else{
                        swal.fire({
                            icon: 'error',
                            title: 'Error al actualizar ruta!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }
                })
                .catch(function (error) {
                     if(error.response.status == 422){

                        let mensaje = '';
                        let respuesta = error.response.data.errors;

                        if(respuesta.name != undefined){
                            for(let err in respuesta.name){
                                mensaje += respuesta.name[err]+', ';
                            }
                        }
                        if(respuesta.path != undefined){
                            for(let err in respuesta.path){
                                mensaje += respuesta.path[err]+', ';
                            }
                        }
                         if(respuesta.component != undefined){
                            for(let err in respuesta.component){
                                mensaje += respuesta.component[err]+', ';
                            }
                        }
                  
                        swal.fire({
                            icon: 'error',
                            title: 'Error al actualizar Ruta!',
                            text: mensaje 
                        });
                    }
                });
            },
            validacionFormulario() { // Metodo encargado de la validacion de los campos de los formularios
                this.errorFormulario = 0;
                this.errorMensajesFormularios = [];
                if(!this.nombre) this.errorMensajesFormularios.push("El campo Nombre de la Ruta es Obligatorio.");
                if(!this.componente) this.errorMensajesFormularios.push("El campo Nombre del Componente es Obligatorio.");
                if(!this.path) this.errorMensajesFormularios.push("El campo Path de la Ruta es Obligatorio.");
                if(this.nombre.includes(" ")) this.errorMensajesFormularios.push("El campo Nombre no puede contener espacios");
                if(this.componente.includes(" ")) this.errorMensajesFormularios.push("El campo Componente no puede contener espacios");
                if(this.path.includes(" ")) this.errorMensajesFormularios.push("El campo Path no puede contener espacios");
                if(this.errorMensajesFormularios.length) this.errorFormulario = 1;               
                return this.errorFormulario;
            },
        },
         mounted() { // Se llama el Metodo de listar para que se renderice cada vez que se cargue el componente
            this.listarRuta(1,this.buscar,this.criterio);
            axios.get('/menus/getRutaRelativa?ruta='+this.$route.name).then((response) => { this.arrayRuta = response.data; });         
        }
    }
</script>
<style>
select {
  font-family: 'FontAwesome', 'sans-serif';
}
.no_coinciden{
    color:#144ef3;
}
</style>
