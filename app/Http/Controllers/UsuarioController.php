<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UsuarioService;
use App\Traits\EnviarResponseTrait;
use App\Validation\UsuarioValidation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsuarioController extends Controller
{
    use EnviarResponseTrait;

    public static function CadastrarUsuario(Request $request, Response $response) {
        try {
            $usuario = new User($request->validate([
                'nomeCompleto' => 'required',
                'telefone' => 'required|min:10|max:11',
                'email' => 'required|email',
                'senha' => 'required|min:8|max:30',
            ], UsuarioValidation::ValidationParams()));

            if ($result = UsuarioService::SalvarUsuario($usuario)) {
                return self::EnviarResponse($result, success: true, message: "Cadastrado com sucesso!", statusCode: 201);
            }
        } catch (\Exception $erro) {
            return self::EnviarResponse(success: false, message: $erro->getMessage(), statusCode: 500);
        }
    }

    public static function ConfirmarConta(Request $request, Response $response) {
        try {
            $request->validate([
                'hash' => 'required|min:6|max:6'
            ], [
                'hash.required' => 'O hash é obrigatório',
                'hash.min' => 'O hash deve conter 6 caracteres',
                'hash.max' => 'O hash deve conter 6 caracteres'
            ]);
    
            if(ValidationCodeController::ValidarConta($request->hash)) {
                return self::EnviarResponse(message: 'Conta validada com sucesso!');
            }
            
            return self::EnviarResponse( statusCode: 500, message: 'Não foi possível validar a conta.');
        } catch (\Exception $ex) {
            return self::EnviarResponse(
                success: false,
                statusCode: 500, 
                message: $ex->getMessage()
            );
        }
    }

    public static function Login(Request $request, Response $response)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'senha' => 'required'
            ], UsuarioValidation::ValidationParams());
    
            if ($result = UsuarioService::AutenticarUsuario($request->email, $request->senha)) {
                $result['usuario'] = $request->user();
    
                if(!$result['usuario']->email_verified_at) {
                    return self::EnviarResponse(
                        content: null, 
                        success: false, 
                        message: "Email não verificado",
                        statusCode: 401
                    );
                }
    
                return self::EnviarResponse($result, success: true, message: "Autenticado com sucesso!");
            }
    
            return self::EnviarResponse($result, success: false, message: "Usuário/senha incorreto", statusCode: 401);
        } catch (\Exception $erro) {
            return self::EnviarResponse(success: false, message: $erro->getMessage(), statusCode: 500);
        }
    }

    public static function AlterarSenha(string $hash, string $senha)
    {
        return UsuarioService::AlterarSenha($hash, $senha);
    }

    public static function ObterUsuarioPorGuid(string $guid)
    {
        return UsuarioService::ObterUsuarioPorGUID($guid);
    }

    public static function ObterUsuarioPorEmail(string $email)
    {
        return UsuarioService::ObterUsuarioPorEmail($email);
    }
}
