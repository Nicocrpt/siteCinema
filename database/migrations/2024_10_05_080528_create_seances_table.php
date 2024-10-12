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
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->foreignId('salle_id')->constrained('salles')->onDelete('cascade');
            $table->foreignId('film_id')->constrained('films')->onDelete('cascade');
            $table->boolean('vf')->default(true);
            $table->boolean('dolby_atmos')->default(false);
            $table->boolean('dolby_vision')->default(false);
            $table->dateTime('datetime_seance');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->unique(['salle_id', 'datetime_seance']);
            $table->index('salle_id');
            $table->index('film_id');
            $table->index('vf');
            $table->index('datetime_seance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
