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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->integer('tmdb_id');
            $table->foreignId('pays_id')->constrained('payss');
            $table->string('titre');
            $table->string('slug');
            $table->string('realisateur');
            $table->string('duree');
            $table->text('synopsis');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();


            //indexes et contraintes
            $table->unique('slug');
            $table->unique('tmdb_id');
            $table->index('pays_id');
            $table->index('realisateur');
            $table->index('duree');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
