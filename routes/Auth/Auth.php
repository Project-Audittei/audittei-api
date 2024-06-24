<?php

use App\Http\Controllers\ResetSenhaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ValidationCodeController;
use App\Models\User;
use App\Validation\UsuarioValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function App\Helpers\EnviarResponse;

Route::post('/auth/cadastro', function (Request $request) {
    try {
        $usuario = new User($request->validate([
            'nomeCompleto' => 'required',
            'telefone' => 'required|min:10|max:11',
            'email' => 'required|email',
            'senha' => 'required|min:8|max:30',
        ], UsuarioValidation::ValidationParams()));

        if ($result = UsuarioController::CadastrarUsuario($usuario)) {
            return EnviarResponse($result, success: true, message: "Cadastrado com sucesso!", statusCode: 201);
        }
    } catch (\Exception $erro) {
        return EnviarResponse(success: false, message: $erro->getMessage(), statusCode: 500);
    }
});

Route::post('/auth/login', function (Request $request) {
    try {
        $usuario = $request->validate([
            'email' => 'required|email',
            'senha' => 'required'
        ], UsuarioValidation::ValidationParams());

        if ($result = UsuarioController::Login($usuario)) {
            $result['usuario'] = $request->user();

            if(!$result['usuario']->email_verified_at) {
                return EnviarResponse(
                    content: null, 
                    success: false, 
                    message: "Email não verificado",
                    statusCode: 401
                );
            }

            return EnviarResponse($result, success: true, message: "Autenticado com sucesso!");
        }

        return EnviarResponse($result, success: false, message: "Usuário/senha incorreto", statusCode: 401);
    } catch (\Exception $erro) {
        return EnviarResponse(success: false, message: $erro->getMessage(), statusCode: 500);
    }
});

Route::post('/auth/confirmar-conta', function (Request $request) {
    try {
        $request->validate([
            'hash' => 'required|min:6|max:6'
        ], [
            'hash.required' => 'O hash é obrigatório',
            'hash.min' => 'O hash deve conter 6 caracteres',
            'hash.max' => 'O hash deve conter 6 caracteres'
        ]);

        if(ValidationCodeController::ValidarConta($request->hash)) {
            return EnviarResponse(message: 'Conta validada com sucesso!');
        }
        
        return EnviarResponse( statusCode: 500, message: 'Não foi possível validar a conta.');
    } catch (\Exception $ex) {
        return EnviarResponse(
            success: false,
            statusCode: 500, 
            message: $ex->getMessage()
        );
    }
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