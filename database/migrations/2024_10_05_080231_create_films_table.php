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
            $table->string('titre');
            $table->string('slug');
            $table->string('url_affiche');
            $table->string('duree');
            $table->text('synopsis');
            $table->foreignId('langue_id')->constrained('langues');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();


            //indexes et contraintes
            $table->unique('tmdb_id');
            $table->index('duree');
            $table->index('langue_id');
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
