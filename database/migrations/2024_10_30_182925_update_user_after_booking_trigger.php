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

            CREATE TRIGGER disable_lines_after_booking_cancel
            BEFORE UPDATE ON reservations
            FOR EACH ROW
            BEGIN
                IF OLD.is_active = 1 AND NEW.is_active = 0 THEN
                    UPDATE reservationlignes
                    SET reservationlignes.is_active = 0
                    WHERE reservation_id = OLD.id;
                END IF;
            END;


            CREATE TRIGGER update_user_after_booking
            AFTER INSERT ON reservationlignes
            FOR EACH ROW
            BEGIN
                UPDATE users 
                SET points_fidelite = points_fidelite + 1
                WHERE id = (SELECT user_id FROM reservations WHERE id = NEW.reservation_id);
            END;


            CREATE TRIGGER update_user_after_cancel_places
            AFTER UPDATE ON reservationlignes
            FOR EACH ROW
            BEGIN
                IF OLD.is_active = 1 AND NEW.is_active = 0 THEN
                    UPDATE users 
                    SET points_fidelite = points_fidelite - 1
                    WHERE id = (SELECT user_id FROM reservations WHERE id = OLD.reservation_id);
                END IF;
            END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
