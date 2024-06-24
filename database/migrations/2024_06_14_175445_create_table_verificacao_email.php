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
        Schema::create('hash_verificacao', function (Blueprint $table) {
            $table->id();
            $table->string('guid_usuario')->unique()->nullable(false);
            $table->string('hash_validacao')->unique()->nullable(false);
            $table->string('tipo')->unique()->nullable(false);
            $table->dateTime('expires')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hash_verificacao');
    }
};
