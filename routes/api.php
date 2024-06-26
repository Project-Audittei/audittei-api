<?php

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function App\Helpers\EnviarResponse;
use function App\Helpers\GerarGUID;

Route::get('/api-info', function () {
    return response()->json([
        'version' => '1.0.0',
        'status' => 'Running'
    ]);
});

Route::get('/guid', function(Request $request) {
    return EnviarResponse(
        content: [ 'guid' => GerarGUID() ]
    );
});

Route::get('/usuario/obterDados', function(Request $request) {
    return EnviarResponse(
        content: $request->user(),
        message: 'Consulta realizada com sucesso.'
    );
});

Route::middleware(['jwt.auth'])->group(function() {
    Route::post('/perfil/cnpj', [ PerfilController::class, 'ObterCNPJ' ]);
    Route::post('/perfil/cadastro', [ PerfilController::class, 'CadastrarPerfil' ]);
    Route::get('/perfil', [ PerfilController::class, 'ObterPerfisUsuario' ]);
    Route::get('/perfil/usuarios', [ PerfilController::class, 'ObterUsuariosDoPerfil' ]);
});

Route::post('/auth/cadastro', [ UsuarioController::class, 'CadastrarUsuario' ]);
Route::post('/auth/login', [ UsuarioController::class, 'Login' ]);
Route::post('/auth/confirmar-conta', [ UsuarioController::class, 'ConfirmarConta' ]);
Route::post('/auth/esqueci-senha', [ UsuarioController::class, 'EnviarEmailRecuperacaoSenha' ]);
Route::post('/auth/redefinir-senha', [ UsuarioController::class, 'RedefinirSenha' ]);