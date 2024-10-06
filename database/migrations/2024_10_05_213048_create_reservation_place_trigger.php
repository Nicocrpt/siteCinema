<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        DB::unprepared('
            CREATE TRIGGER after_
        
        ');

        DB::unprepared('
            CREATE TRIGGER after_reservationLigne_insert
            AFTER INSERT ON reservationlignes
            FOR EACH ROW
            BEGIN
                UPDATE seances
                SET nombre_places_disponibles = nombre_places_disponibles - 1
                WHERE id = (SELECT seance_id FROM reservations WHERE id = NEW.reservation_id);
            END
            
        ');

        DB::unprepared('
            CREATE TRIGGER after_reservationLigne_delete
            AFTER DELETE ON reservationlignes
            FOR EACH ROW
            BEGIN
                UPDATE seances
                SET nombre_places_disponibles = nombre_places_disponibles + 1
                WHERE id = (SELECT seance_id FROM reservations WHERE id = OLD.reservation_id);
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_reservation_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_reservation_delete');


    }
};
