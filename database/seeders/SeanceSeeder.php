<?php

namespace Database\Seeders;

use App\Models\Seance;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seance::factory(20)->create();

        DB::table('seances')->insert([
            'reference' => '12345678',
            'salle_id' => 1,
            'film_id' => 3,
            'datetime_seance' => '2025-02-05 09:00:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '23456789',
            'salle_id' => 2,
            'film_id' => 5,
            'datetime_seance' => '2025-02-05 11:10:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '34567890',
            'salle_id' => 3,
            'film_id' => 7,
            'datetime_seance' => '2025-02-05 13:50:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '45678901',
            'salle_id' => 1,
            'film_id' => 10,
            'datetime_seance' => '2025-02-05 16:00:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '56789012',
            'salle_id' => 2,
            'film_id' => 2,
            'datetime_seance' => '2025-02-05 19:00:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '67890123',
            'salle_id' => 3,
            'film_id' => 12,
            'datetime_seance' => '2025-02-05 21:10:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        
        DB::table('seances')->insert([
            'reference' => '89012345',
            'salle_id' => 2,
            'film_id' => 9,
            'datetime_seance' => '2025-02-06 09:10:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '90123456',
            'salle_id' => 3,
            'film_id' => 11,
            'datetime_seance' => '2025-02-06 11:30:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '01234567',
            'salle_id' => 1,
            'film_id' => 4,
            'datetime_seance' => '2025-02-06 14:00:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '11234567',
            'salle_id' => 2,
            'film_id' => 8,
            'datetime_seance' => '2025-02-06 17:00:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '21234567',
            'salle_id' => 3,
            'film_id' => 1,
            'datetime_seance' => '2025-02-06 19:30:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '31234567',
            'salle_id' => 1,
            'film_id' => 7,
            'datetime_seance' => '2025-02-06 21:50:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);

        
        DB::table('seances')->insert([
            'reference' => '51234567',
            'salle_id' => 3,
            'film_id' => 10,
            'datetime_seance' => '2025-02-07 09:00:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '61234567',
            'salle_id' => 1,
            'film_id' => 12,
            'datetime_seance' => '2025-02-07 11:20:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '71234567',
            'salle_id' => 2,
            'film_id' => 5,
            'datetime_seance' => '2025-02-07 14:10:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '81234567',
            'salle_id' => 3,
            'film_id' => 4,
            'datetime_seance' => '2025-02-07 16:40:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '91234567',
            'salle_id' => 1,
            'film_id' => 9,
            'datetime_seance' => '2025-02-07 19:00:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '01324567',
            'salle_id' => 2,
            'film_id' => 3,
            'datetime_seance' => '2025-02-07 21:20:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        
        DB::table('seances')->insert([
            'reference' => '21324567',
            'salle_id' => 1,
            'film_id' => 8,
            'datetime_seance' => '2025-02-08 09:00:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '31324567',
            'salle_id' => 2,
            'film_id' => 2,
            'datetime_seance' => '2025-02-08 11:40:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '41324567',
            'salle_id' => 3,
            'film_id' => 1,
            'datetime_seance' => '2025-02-08 14:20:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '51324567',
            'salle_id' => 1,
            'film_id' => 7,
            'datetime_seance' => '2025-02-08 16:40:00',
            'vf' => 1,
            'dolby_atmos' => 1,
            'dolby_vision' => 1,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '61324567',
            'salle_id' => 2,
            'film_id' => 6,
            'datetime_seance' => '2025-02-08 19:50:00',
            'vf' => 0,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
        DB::table('seances')->insert([
            'reference' => '71324567',
            'salle_id' => 3,
            'film_id' => 10,
            'datetime_seance' => '2025-02-08 22:30:00',
            'vf' => 1,
            'dolby_atmos' => 0,
            'dolby_vision' => 0,
        ]);
        
    }
}
