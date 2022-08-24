<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list ingresos']);
        Permission::create(['name' => 'view ingresos']);
        Permission::create(['name' => 'create ingresos']);
        Permission::create(['name' => 'update ingresos']);
        Permission::create(['name' => 'delete ingresos']);

        Permission::create(['name' => 'list allpedidos']);
        Permission::create(['name' => 'view allpedidos']);
        Permission::create(['name' => 'create allpedidos']);
        Permission::create(['name' => 'update allpedidos']);
        Permission::create(['name' => 'delete allpedidos']);

        Permission::create(['name' => 'list solicitantes']);
        Permission::create(['name' => 'view solicitantes']);
        Permission::create(['name' => 'create solicitantes']);
        Permission::create(['name' => 'update solicitantes']);
        Permission::create(['name' => 'delete solicitantes']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
