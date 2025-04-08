<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(200)->create();

        User::create([
            'nom' => 'admin',
            'email' => 'admin@solaris.fr',
            'password' => Hash::make('JeNeSaisPas'),
            'prenom' => 'admin',
            'role' => Role::Admin->value,
        ]);
    }
}
