<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;

Route::get('/api-info', function () {
    return response()->json([
        'version' => env('APP_VERSION'),
        'last_commit' => env('APP_LAST_COMMIT'),
        'last_build' => env('APP_LAST_BUILD'),
        'build_number' => env('BUILD_NUMBER'),
        'status' => 'Running'
    ]);
});

Route::middleware(['jwt.auth'])->group(function() {
    Route::post('/perfil/cnpj', [ PerfilController::class, 'ObterCNPJ' ]);
    Route::post('/perfil/cadastro', [ PerfilController::class, 'CadastrarPerfil' ]);
    Route::get('/perfil', [ PerfilController::class, 'ObterPerfisUsuario' ]);
    Route::get('/perfil/usuarios', [ PerfilController::class, 'ObterUsuariosDoPerfil' ]);

    Route::get('/usuario', [ UsuarioController::class, 'ObterDadosUsuario' ]);
});

Route::post('/auth/cadastro', [ UsuarioController::class, 'CadastrarUsuario' ]);
Route::post('/auth/login', [ UsuarioController::class, 'Login' ]);
Route::post('/auth/confirmar-conta', [ UsuarioController::class, 'ConfirmarConta' ]);
Route::post('/auth/esqueci-senha', [ UsuarioController::class, 'EnviarEmailRecuperacaoSenha' ]);
Route::post('/auth/redefinir-senha', [ UsuarioController::class, 'RedefinirSenha' ]);