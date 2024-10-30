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

            CREATE TRIGGER delete_lines_after_booking_cancel
            BEFORE DELETE ON reservations
            FOR EACH ROW
            BEGIN
                DELETE FROM reservationlignes WHERE reservation_id = OLD.id;
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
            AFTER DELETE ON reservationlignes
            FOR EACH ROW
            BEGIN
                UPDATE users 
                SET points_fidelite = points_fidelite - 1
                WHERE id = (SELECT user_id FROM reservations WHERE id = OLD.reservation_id);
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
