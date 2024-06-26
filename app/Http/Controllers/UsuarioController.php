<?php

namespace App\Http\Controllers;

use App\Constants\TipoCodigoValidacao;
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Models\User;
use App\Services\UsuarioService;
use App\Services\ValidacaoService;
use App\Traits\EnviarResponseTrait;
use App\Validation\UsuarioValidation;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    use EnviarResponseTrait;

    public static function CadastrarUsuario(Request $request) {
        $usuario = new User($request->validate([
            'nomeCompleto' => 'required',
            'telefone' => 'required|min:10|max:11',
            'email' => 'required|email',
            'senha' => 'required|min:8|max:30',
        ], UsuarioValidation::ValidationParams()));

        if ($result = UsuarioService::SalvarUsuario($usuario)) {
            return self::EnviarResponse($result, success: true, message: "Cadastrado com sucesso!", statusCode: 201);
        }
    }

    public static function ConfirmarConta(Request $request) {
        $request->validate([
            'hash' => 'required|min:6|max:6'
        ], [
            'hash.required' => 'O hash é obrigatório',
            'hash.min' => 'O hash deve conter 6 caracteres',
            'hash.max' => 'O hash deve conter 6 caracteres'
        ]);

        $validacao = ValidacaoController::ObterValidacao($request->hash, TipoCodigoValidacao::CONFIRMAR_CONTA);
        $usuario = UsuarioService::ObterUsuarioPorGUID($validacao->guid_usuario);

        if(!$usuario) throw new UsuarioNaoEncontradoException();

        UsuarioService::ValidarConta($usuario);
        ValidacaoService::DeletarValidacao($validacao);

        return self::EnviarResponse(message: 'Conta validada com sucesso!');
    }

    public static function Login(Request $request)
    {
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
    }

    public static function EnviarEmailRecuperacaoSenha(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ], UsuarioValidation::ValidationParams());

        $usuario = UsuarioService::ObterUsuarioPorEmail($request->email);

        if(!$usuario) throw new UsuarioNaoEncontradoException();

        ValidacaoController::GerarCodigoValidacao($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);

        return self::EnviarResponse(
            message: 'O E-mail de confirmação foi enviado com sucesso!.'
        );
    }

    public static function RedefinirSenha(Request $request)
    {
        $request->validate([
            'hash' => 'required',
            'senha' => 'required|min:8'
        ], UsuarioValidation::ValidationParams());

        if(UsuarioService::AlterarSenha($request->hash, $request->senha)) {
            return self::EnviarResponse(message: 'Senha alterada com sucesso!');
        }
        
        return self::EnviarResponse( statusCode: 500, message: 'Não foi possível redefinir sua senha.');     
    }
}
