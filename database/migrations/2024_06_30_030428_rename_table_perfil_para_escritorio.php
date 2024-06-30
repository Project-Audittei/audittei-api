<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('perfis', 'escritorios');

        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('escritorio_id')->nullable(true);

            $table->foreign('escritorio_id')->references('guid')->on('escritorios');
        }); 

        DB::table('perfil_user')->orderBy('id')->chunk(100, function ($perfisUsuarios) {
            foreach($perfisUsuarios as $perfilUsuario) {
                DB::table('usuarios')
                    ->where('guid', $perfilUsuario->usuario_guid)
                    ->update([ 'escritorio_id' => $perfilUsuario->perfil_guid ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('usuarios')
            ->update([ 'escritorio_id', null ]);

        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['escritorio_id']);
            $table->dropColumn('escritorio_id');
        }); 

        Schema::rename('escritorios', 'perfis');
    }
};
