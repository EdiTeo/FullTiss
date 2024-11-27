<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear permisos
        Permission::create(['name' => 'view-admin']);
        Permission::create(['name' => 'view-estudiante']);
        Permission::create(['name' => 'view-docente']);
        Permission::create(['name' => 'view-proyecto']);

        // Crear rol super-admin si no existe
        $role = Role::firstOrCreate(['name' => 'super-admin']);

        // Crear usuario
        $user = User::create([
            'name' => 'Amilces',
            'email' => 'amilces7@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        // Asignar rol al usuario
        $user->assignRole($role);

        // Asignar permiso view-admin al rol super-admin
        $role->givePermissionTo('view-admin');
    }


    
}
