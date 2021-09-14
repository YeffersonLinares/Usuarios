<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoCentralizadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('centralizado')->table('departamentos')->insert([
        	[
	        	'id'		     => '1',
	        	'nombre' 	     => 'FNFP',
	        	'nombre_db'      => 'fnfp',
	        	'url_logo' 	     => 'images/departamentos/1617726291.png',
                'url_produccion' => 'http://192.168.88.24:8081/',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '2',
	        	'nombre' 	     => 'Cabildos Abiertos',
	        	'nombre_db'      => 'cabildos_abiertos',
	        	'url_logo' 	     => 'images/departamentos/1617731314.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '3',
	        	'nombre' 	     => 'Delegados Escrutinios',
	        	'nombre_db'      => 'delegados_escrutinios',
	        	'url_logo' 	     => 'images/departamentos/1617731340.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '4',
	        	'nombre' 	     => 'Estatuto Oposición',
	        	'nombre_db'      => 'estatuto_oposicion',
	        	'url_logo' 	     => 'images/departamentos/1617731427.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '5',
	        	'nombre' 	     => 'Trashumancia',
	        	'nombre_db'      => 'trashumancia',
	        	'url_logo' 	     => 'images/departamentos/1617731454.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '6',
	        	'nombre' 	     => 'Tribunales de Garantías',
	        	'nombre_db'      => 'tribunales_garantias',
	        	'url_logo' 	     => 'images/departamentos/1617731490.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],
            [
	        	'id'		     => '7',
	        	'nombre' 	     => 'Uriel',
	        	'nombre_db'      => 'uriel',
	        	'url_logo' 	     => 'images/departamentos/1617731505.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],			
            [
	        	'id'		     => '8',
	        	'nombre' 	     => 'Veedurías Ciudadanas',
	        	'nombre_db'      => 'veedurias_ciudadanas',
	        	'url_logo' 	     => 'images/departamentos/1617731533.png',
                'url_produccion' => '',
	        	'estado' 	     => '1'
	        ],		
        ]);
    }
}
