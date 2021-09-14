<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutasVueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('centralizado')->table('rutas_vue')->insert([
        	[
	        	'id'		=> '1',
	        	'path' 	    => '/',
	        	'name'      => 'home',
	        	'component' => 'Home',
	        ],
            [
	        	'id'		=> '2',
	        	'path' 	    => '/usuarios',
	        	'name'      => 'usuarios',
	        	'component' => 'Usuarios',
	        ],
            [
	        	'id'		=> '3',
	        	'path' 	    => '/roles',
	        	'name'      => 'roles',
	        	'component' => 'Rol',
	        ],
            [
	        	'id'		=> '4',
	        	'path' 	    => '/parametrizar_menus',
	        	'name'      => 'parametrizar_menus',
	        	'component' => 'ParametrizarMenus',
	        ],
            [
	        	'id'		=> '5',
	        	'path' 	    => '/permisos',
	        	'name'      => 'permisos',
	        	'component' => 'Permisos',
	        ],
            [
	        	'id'		=> '6',
	        	'path' 	    => '/departamentos',
	        	'name'      => 'departamentos',
	        	'component' => 'Departamento',
	        ],
            [
	        	'id'		=> '7',
	        	'path' 	    => '/ciudades',
	        	'name'      => 'ciudades',
	        	'component' => 'Ciudad',
	        ],
            [
	        	'id'		=> '8',
	        	'path' 	    => '/tipos_documentos',
	        	'name'      => 'tipo_documento',
	        	'component' => 'TipoDocumento',
	        ],
            [
	        	'id'		=> '9',
	        	'path' 	    => '/agregarDepartamento',
	        	'name'      => 'agregar_departamento',
	        	'component' => 'AgregarDepartamento',
	        ],
            [
	        	'id'		=> '10',
	        	'path' 	    => '/parametrizar_rutas_vue',
	        	'name'      => 'parametrizar_rutas_vue',
	        	'component' => 'ParametrizarRutasVue',
	        ],
        ]);
    }
}
