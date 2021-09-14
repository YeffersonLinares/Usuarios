<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\PersonaCentralizado;
use App\Models\DepartamentoUsuario;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            [
                [
                    'nombre'              => 'Super Administrador',
                    'apellido'            => '',
                    'tipo_documento'      => '1',
                    'numero_documento'    => '1',
                    'estado'              => '1'
                ],
                [
                    'id_persona'          => '1',
                    'usuario'             => 'super_administrador',
                    'email'               => 'super_administrador@turrisystem.com',
                    'password'            => bcrypt('Turri123*'),
                    'observaciones'       => 'Super Administrador General del Sistema',
                    'estado'              => '1',
                    'super_administrador' => '1'
                ],
            ]
        ];

        $deptos = [
            // [
                [
                    'id_departamento'     => '1',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '2',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '3',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '4',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '5',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '6',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '7',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ],
                [
                    'id_departamento'     => '8',
                    'id_usuario'          => '1',
                    'estado'              => '1',
                ]
            // ]
        ];

        $roles_array = Rol::rolesDefault();

        foreach($usuarios as $usuario => $user)
        {
            //se Guarda la persona
            PersonaCentralizado::create($user[0]);
            //se guarda el usuario
            User::create($user[1]);
            //se registra en el departamento
            
        }

        foreach($deptos as $depto => $dep)
        {
            //se registra en el departamento
            DepartamentoUsuario::create($dep);
            
        }
    }
}
