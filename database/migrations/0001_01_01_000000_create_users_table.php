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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telephone');
            $table->string('adresse')->nullable()->default(null);
            $table->string('code_postal')->nullable()->default(null);
            $table->string('ville')->nullable()->default(null);
            $table->foreignId('pays_id')->nullable()->constrained('payss');
            $table->boolean('statut_abo')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            //$table->timestamps();

            //Indexes et contraintes
            $table->unique('email');
            $table->unique('telephone');
            $table->unique(['nom', 'prenom']);
            $table->index('code_postal');
            $table->index('pays_id');
            $table->index('statut_abo');
            $table->index('ville');

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
