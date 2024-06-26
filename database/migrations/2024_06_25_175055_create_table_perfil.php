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
        Schema::create('perfis', function (Blueprint $table) {
            $table->string('guid')->unique();
            $table->text('cnpj')->nullable(false);
            $table->text('razaoSocial')->nullable(false);
            $table->text('telefone')->nullable(false);
            $table->text('email')->nullable(false);
            $table->text('cep')->nullable(false);
            $table->text('logadouro')->nullable(false);
            $table->text('bairro')->nullable(false);
            $table->text('cidade')->nullable(false);
            $table->text('estado')->nullable(false);              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfis');
    }
};
