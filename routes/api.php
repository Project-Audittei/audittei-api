<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EscritorioController;
use Illuminate\Support\Facades\Route;

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

    //Escritório
    Route::get('/escritorio', [ EscritorioController::class, 'ObterEscritorioUsuario' ]);
    Route::post('/escritorio/cnpj', [ EscritorioController::class, 'ObterCNPJ' ]);
    Route::post('/escritorio/cadastro', [ EscritorioController::class, 'CadastrarEscritorio' ]);
    Route::post('/escritorio/editar', [ EscritorioController::class, 'EditarEscritorio' ]);
    Route::get('/escritorio/usuarios', [ EscritorioController::class, 'ObterUsuariosDoEscritorio' ]);
    Route::get('/escritorio/empresas', [ EscritorioController::class, 'ObterEmpresasDoEscritorio' ]);

    // Empresa
    Route::get('/empresa', [ EmpresaController::class, 'ObterTodasEmpresas' ]);
    Route::post('/empresa/cadastro', [ EmpresaController::class, 'CadastroEmpresa' ]);
    Route::post('/empresa/atualizar', [ EmpresaController::class, 'AtualizarEmpresa' ]);
    Route::get('/empresa/usuarios/{guid}', [ EmpresaController::class, 'ObterUsuariosVinculadosAEmpresa' ]);
    Route::get('/empresa/{guid}', [ EmpresaController::class, 'ObterEmpresa' ]);
    
    // Usuário
    Route::get('/usuario', [ UsuarioController::class, 'ObterDadosUsuario' ]);
    Route::put('/usuario/atualizar-cadastro', [ UsuarioController::class, 'AtualizarCadastro' ]);
    Route::put('/usuario/atualizar-senha', [ UsuarioController::class, 'AtualizarSenha' ]);
});

Route::post('/auth/cadastro', [ UsuarioController::class, 'CadastrarUsuario' ]);
Route::post('/auth/login', [ UsuarioController::class, 'Login' ]);
Route::post('/auth/confirmar-conta', [ UsuarioController::class, 'ConfirmarConta' ]);
Route::post('/auth/esqueci-senha', [ UsuarioController::class, 'EnviarEmailRecuperacaoSenha' ]);
Route::post('/auth/redefinir-senha', [ UsuarioController::class, 'RedefinirSenha' ]);