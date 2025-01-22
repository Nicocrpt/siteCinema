<?php

namespace Database\Seeders;

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
        User::factory(50)->create();

        User::create([
            'nom' => 'admin',
            'email' => 'admin@solaris.fr',
            'password' => Hash::make('JeNeSaisPas'),
            'prenom' => 'admin',
            'is_admin' => 1,
            'telephone' => '0606060606'
        ]);
    }
}
