<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Capturista']);

        Permission::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permisos', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Logs', 'area' => 'Logs'])->syncRoles([$role1]);

        Permission::create(['name' => 'Área de captura', 'area' => 'Captura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Ver predio', 'area' => 'Captura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Lista de predios', 'area' => 'Captura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Crear predio', 'area' => 'Captura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Editar predio', 'area' => 'Captura'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Borrar predio', 'area' => 'Captura'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'Área de consulta', 'area' => 'Consulta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'Consulta', 'area' => 'Consulta'])->syncRoles([$role1, $role2]);

    }
}
