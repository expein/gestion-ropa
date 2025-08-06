<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Santiago Alzate',
            'email' => 'santyalzateo05@gmail.com',
            'password' => Hash::make('santi21345'),
        ]);

        // Asignar rol de administrador
        $admin->assignRole('admin');
    }
}
