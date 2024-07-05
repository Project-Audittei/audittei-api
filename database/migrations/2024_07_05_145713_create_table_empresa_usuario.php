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
        Schema::create('empresa_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('empresa_guid')->nullable(false);
            $table->string('usuario_guid')->nullable(false);

            $table->foreign('empresa_guid')->references('guid')->on('empresas');
            $table->foreign('usuario_guid')->references('guid')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_empresa_usuario');
    }
};
