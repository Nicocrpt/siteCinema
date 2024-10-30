<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservationlignes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations');
            $table->foreignId('place_id')->constrained('places');
            $table->decimal('prix');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['reservation_id', 'place_id']);
            $table->index('reservation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationlignes');
    }
};
