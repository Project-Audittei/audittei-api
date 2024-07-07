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
        Schema::table('escritorios', function(Blueprint $table) {
            $table->text('numero')->nullable(false);
            $table->text('complemento')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('escritorios', function(Blueprint $table) {
            $table->removeColumn('numero');
            $table->removeColumn('complemento');
        });
    }
};
