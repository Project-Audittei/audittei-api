<?php

use App\Http\Controllers\ResetSenhaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ValidationCodeController;
use App\Validation\UsuarioValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function App\Helpers\EnviarResponse;

Route::post('/auth/cadastro', [ UsuarioController::class, 'CadastrarUsuario' ]);
Route::post('/auth/login', [ UsuarioController::class, 'Login' ]);
Route::post('/auth/confirmar-conta', function (Request $request) {
    
});

Route::post('/auth/esqueci-senha', function (Request $request) {
    try {
        $request->validate([
            'email' => 'required|email'
        ], UsuarioValidation::ValidationParams());

        if(ResetSenhaController::GerarCodigoAlteracaoSenha($request->email)) {
            return EnviarResponse(message: 'E-mail de confirmação de conta enviado!');
        }
        
        return EnviarResponse( statusCode: 500, message: 'Não foi possível reenviar o e-mail de confirmação.');
    } catch (\Exception $ex) {
        return EnviarResponse(
            success: false,
            statusCode: 500, 
            message: $ex->getMessage()
        );
    }
});

Route::post('/auth/redefinir-senha', function (Request $request) {
    try {
        $request->validate([
            'hash' => 'required',
            'senha' => 'required|min:8'
        ], UsuarioValidation::ValidationParams());

        if(UsuarioController::AlterarSenha($request->hash, $request->senha)) {
            return EnviarResponse(message: 'Senha alterada com sucesso!');
        }
        
        return EnviarResponse( statusCode: 500, message: 'Não foi possível redefinir sua senha.');
    } catch (\Exception $ex) {
        return EnviarResponse(
            success: false,
            statusCode: 500, 
            message: $ex->getMessage()
        );
    }
});

Route::post('/auth/reenviar-confirmar-conta', function (Request $request) {
    try {
        $dados = $request->validate([
            'email' => 'required|email'
        ], UsuarioValidation::ValidationParams());

        $usuario = UsuarioController::ObterUsuarioPorEmail($dados['email']);

        if(ValidationCodeController::AtualizarCodigoValidacao($usuario->guid)) {
            return EnviarResponse(message: 'E-mail de confirmação de conta enviado!');
        }
        
        return EnviarResponse( statusCode: 500, message: 'Não foi possível reenviar o e-mail de confirmação.');
    } catch (\Exception $ex) {
        return EnviarResponse(
            success: false,
            statusCode: 500, 
            message: $ex->getMessage()
        );
    }
});