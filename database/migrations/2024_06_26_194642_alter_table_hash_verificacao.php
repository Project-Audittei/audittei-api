<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('hash_verificacao', function (Blueprint $table) {
            $table->dropUnique('hash_verificacao_tipo_unique');
            $table->string('tipo')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hash_verificacao', function (Blueprint $table) {
            $table->unique('tipo');
        });
    }
};
