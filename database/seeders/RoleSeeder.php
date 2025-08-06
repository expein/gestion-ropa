<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear rol de administrador
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        // Crear rol de vendedor
        $vendedorRole = Role::create(['name' => 'vendedor']);
    }
} 