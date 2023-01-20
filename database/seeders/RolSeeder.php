<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $admin = Role::create(['name' => 'Administrador']);
         $inve = Role::create(['name' => 'Inventario']);

        Permission::create(['name' => 'admin.dashboard', 'detail' => 'Ver Dashboard'])->syncRoles([$admin, $inve]);
        Permission::create(['name' => 'admin.usuarios.index', 'detail' => 'Ver Lista de usuarios'])->syncRoles([$admin, $inve]);
        Permission::create(['name' => 'admin.usuarios.store', 'detail' => 'Crear Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.usuarios.update', 'detail' => 'Editar Usuarios'])->syncRoles([$admin]);

        //Permission::create(['name' => 'admin.usuarios.create', 'detail' => ''])->syncRoles([$admin]);
        //Permission::create(['name' => 'admin.usuarios.edit', 'detail' => ''])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.usuarios.destroy', 'detail' => 'Eliminar usuarios'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.roles.index', 'detail' => 'Ver Lista de Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.store', 'detail' => 'Crear Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.edit', 'detail' => 'Editar Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.roles.destroy', 'detail' => 'Eliminar Roles'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.oficinas.index', 'detail' => 'Ver Lista de Oficinas'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.oficinas.store', 'detail' => 'Crear Oficinas'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.oficinas.edit', 'detail' => 'Editar Oficinas'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.oficinas.destroy', 'detail' => 'Eliminar Oficinas'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.bienes.index', 'detail' => 'Ver bienes'])->syncRoles([$admin, $inve]);
        Permission::create(['name' => 'admin.bienes.store', 'detail' => 'Registro de bienes'])->syncRoles([$admin, $inve]);
        Permission::create(['name' => 'admin.bienes.edit', 'detail' => 'Modificar un bien'])->syncRoles([$admin, $inve]);
        Permission::create(['name' => 'admin.bienes.destroy', 'detail' => 'Eliminar bienes'])->syncRoles([$admin, $inve]);


    }
}
