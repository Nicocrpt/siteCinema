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
            $table->string('url_backdrop')->nullable();
            $table->string('url_trailer')->nullable();
            $table->string('url_logo')->nullable();
            $table->string('duree');
            $table->text('synopsis');
            $table->string('tagline')->nullable();
            $table->foreignId('langue_id')->constrained('langues');
            $table->foreignId('certification_id')->constrained('certifications');
            $table->boolean('dolby_compatible');
            $table->string('date_sortie');
            $table->boolean('a_laffiche')->default(true);
            $table->foreignId('statut_id')->constrained('statuts');
            $table->boolean('est_favori')->default(false);
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
