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
        Schema::create('perfil_user', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_guid')->nullable(false);
            $table->string('perfil_guid')->nullable(false);
            $table->timestamps();

            $table->foreign('usuario_guid')->references('guid')->on('usuarios');
            $table->foreign('perfil_guid')->references('guid')->on('perfis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_user');
    }
};
