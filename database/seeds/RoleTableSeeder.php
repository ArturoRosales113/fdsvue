<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roles')->insert([
          'name' => 'admin',
          'display_name' => 'Adminsitrador',
          'description' => 'El usuario tiene acceso a todas las funciones del sistema',
      ]);
      DB::table('roles')->insert([
         'name' => 'manager',
         'display_name' => 'Gerente',
         'description' => 'El usuario tiene acceso a las funciones de usuarios, sucursales y ordenes',
     ]);
     DB::table('roles')->insert([
        'name' => 'employee',
        'display_name' => 'Empleado',
        'description' => 'El usuario tiene acceso solo para atender las ordenes y reservaciones de los clientes',
    ]);

    }
}
