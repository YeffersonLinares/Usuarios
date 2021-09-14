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
                        <i class="fa fa-align-justify"></i> Agregar Modulo
                        <template>
                            <button type="button" @click="ingresarDepartamento('departamento','create')" class="btn btn-secondary">
                                <i class="icon-plus"></i> Nuevo
                            </button>
                        </template>
                    </div>
                    <template>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterio">
                                            <option value="name">Nombre</option>
                                            <option value="component">Componente</option>
                                            <option value="permiso">Permiso</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup="listarMenu(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarMenu(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                            <th>Nombre DataBase</th>
                                            <th>Url Producción</th>
                                            <th>Logo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="arrayDepartamentos.length != 0">
                                                <tr v-for="departamento in arrayDepartamentos" :key="departamento.id">  
                                                <td>
                                                     <template >
                                                        <button type="button" title="Editar" @click="ingresarDepartamento('departamento','update',departamento)" class="btn btn-inverse-warning btn-sm">
                                                        <i class="typcn typcn-edit"></i>
                                                        </button> &nbsp;
                                                    </template>
                                                    <template>
                                                        <template v-if="departamento.status" class="preview">
                                                            <button type="button" title="Inactivar" class="btn btn-inverse-danger btn-sm" @click="cambiarEstado(departamento.id, departamento.estado)">
                                                                <i class="typcn typcn-trash"></i>
                                                            </button>
                                                        </template>
                                                        <template v-else>
                                                            <button type="button" title="Activar" class="btn btn-inverse-success btn-sm" @click="cambiarEstado(departamento.id, departamento.estado)">
                                                                <i class="typcn typcn-tick-outline"></i>
                                                            </button>
                                                        </template>
                                                    </template>
                                                </td>
                                                <td v-text="departamento.nombre"></td>
                                                <td v-text="departamento.nombre_db"></td>
                                                <td v-text="departamento.url_produccion"></td>
                                                <td><img :src="departamento.url_logo" alt="" class="img img-responsive"></td>
                                                <td>
                                                    <div v-if="departamento.estado">
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
                                                <td colspan="7"><span>No se encontraron resultados</span></td>
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
                            <input type="text" v-model="nombre" class="form-control" placeholder="Nombre Modulo">
                        </div>
                        <div class="form-group">
                            <label>Nombre de la base de datos</label>
                            <input type="text" v-model="nombre_db" class="form-control" placeholder="Nombre base de datos">
                        </div>      
                        <div class="form-group">
                            <label>Url Producción</label>
                            <input type="text" v-model="url_produccion" class="form-control" placeholder="Url Produccion">
                        </div>                                     
                        <div class="form-group">
                            <label>Imagen</label>
                            <input type="file" accept="image/*" @change="uploadImage($event)" id="file-input">
                        </div>     
                        <div v-show="errorFormulario" class="form-group text-center">
                            <div class="badge badge-warning col-md-10">
                                <div v-for="error in errorMensajesFormularios" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                        <template>
                            <button v-if="tipoAccion==1" @click="createDepartamento()" type="button" class="btn btn-primary mr-2">Guardar</button>
                        </template>
                        <template>
                            <button v-if="tipoAccion==2" @click="updateDepartamento()" type="button" class="btn btn-primary mr-2">Actualizar</button>
                        </template>
                        <button class="btn btn-light" @click="cancelarIngreso()">Cancelar</button>
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

    export default {
        props : ['ruta'],
        data (){ // Resive los Datos que llegan
            return {
                // Inicialización de Variables
                idDepto: 0,
                arrayDepartamentos : [],
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
                nombre_db: '',
                imagen: null,
                nombre: '', 
                url_produccion: '',
                arrayRuta: [],             
            }
        },
        components:{
        },
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
            }
        },
        methods : {
            cambiarPagina(page,buscar,criterio){ // Metodo encargado de realizar el cambio de pagina
                //Actualiza la página actual
                this.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                this.listarDepartamento(page,buscar,criterio);
            },
            listarDepartamento (page,buscar,criterio){ // Metodo encargado de enviar los datos al listado
                $('.spinner').css('display', 'block');

                var url=  this.ruta +  '/departamentosCentralizado?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then((response) => {
                    this.arrayDepartamentos = response.data.departamentos.data;
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
                this.nombre = '';
                this.nombre_db = '';
                this.url_produccion = '';
                this.imagen = '';
            },
            ingresarDepartamento (modelo, accion, data = []){ // Metodo encargado de cargar los formularios de crear y actualizar
                this.listado = 2;
                switch(modelo){
                    case "departamento":
                        {
                            switch(accion){
                            case 'create':
                                {   
                                this.tituloFormulario = "Registrar Modulo";
                                this.nombre = '';
                                this.imagen = '';
                                this.nombre_db = '';
                                this.url_produccion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'update':
                            {
                                this.tituloFormulario = "Actualizar el Modulo";
                                this.idDepto = data['id'];
                                this.nombre = data['nombre'];
                                this.nombre_db = data['nombre_db'];
                                this.imagen = data['url_logo'];   
                                this.url_produccion = data['url_produccion'];               
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
                        var url= this.ruta +  '/departamentosCentralizado/cambiarEstado';
                        axios.put(url,{
                            'id': id,
                            'estado': estado_enviar
                        }).then((response) => {
                            this.listarDepartamento(1,'','nombre');
                            Swal.fire(
                                title_es+'!',
                                'El Menú ha sido '+title_es+' con éxito.',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel){                       
                    }
                }) 
            },
            createDepartamento() { // Metodo encargado de realizar el envio de datos para la creacion
                if(this.validacionFormulario()){
                    return;
                }               
                let url=  this.ruta +  '/departamentosCentralizado/create';

                var data = new  FormData();
                data.append('nombre', this.nombre);
                data.append('nombre_db', this.nombre_db);
                data.append('url_produccion', this.url_produccion);
                data.append('imagen', this.imagen);
      
                axios.post(url,data, {
                        headers: { "Content-Type": "multipart/form-data" }
                }).then((response) => {
                    if(response.data.status){
                        swal.fire({
                            icon: 'success',
                            title: 'Departamento Creado Exitosamente!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }
                    this.cancelarIngreso();
                    this.listarDepartamento(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateDepartamento() { // Metodo encargado de realizar el envio de datos para la actualizacion
                if(this.validacionFormulario()){
                    return;
                }
                let url=   this.ruta + '/departamentosCentralizado/update';

                var data = new  FormData();
                data.append('nombre', this.nombre);
                data.append('nombre_db', this.nombre_db);
                data.append('url_produccion', this.url_produccion);
                data.append('imagen', this.imagen);
                data.append('id',this.idDepto);

                axios.post(url,data,{
                    headers: { "Content-Type": "multipart/form-data" }
                }).then( (response) => {
                    this.cancelarIngreso();
                    this.listarDepartamento(1,'','nombre');
                    if(response.data.status){
                        swal.fire({
                            icon: 'success',
                            title: 'Departamento Actualizado Exitosamente!',
                            showConfirmButton: false,
                            timer: 1750
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            validacionFormulario() { // Metodo encargado de la validacion de los campos de los formularios
                this.errorFormulario = 0;
                this.errorMensajesFormularios = [];
                if(!this.nombre) this.errorMensajesFormularios.push("El campo Nombre del Departamento es Obligatorio.");
                if(!this.nombre_db) this.errorMensajesFormularios.push("El campo Nombre de la Base de datos es Obligatorio.");
                if(!this.nombre_db) this.errorMensajesFormularios.push("El campo Url Producción es Obligatorio.");
                if(this.errorMensajesFormularios.length) this.errorFormulario = 1;            
                return this.errorFormulario;
            },
            uploadImage(event) {
                this.imagen = event.target.files[0];
            },
        },
        mounted() { // Se llama el Metodo de listar para que se renderice cada vez que se cargue el componente
            this.listarDepartamento(1,this.buscar,this.criterio);
            axios.get(this.ruta +'/menus/getRutaRelativa?ruta='+this.$route.name).then((response) => { this.arrayRuta = response.data; }); 
        }
    }
</script>
<style>
select {
  font-family: 'FontAwesome', 'sans-serif';
}
</style>
