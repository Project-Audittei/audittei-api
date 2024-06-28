<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Constants\TipoCodigoValidacao;
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Models\User;
use App\Services\UsuarioService;
use App\Services\ValidacaoService;
use App\Traits\EnviarResponseTrait;
use App\Validation\UsuarioValidation;
use Illuminate\Http\Request;
use RuntimeException;

class UsuarioController extends Controller
{
    #[ValidarRequest(UsuarioValidation::class, 'CadastroParametros')]
    public static function CadastrarUsuario(Request $request) {
        $usuario = new User($request->json()->all());

        if ($result = UsuarioService::SalvarUsuario($usuario)) {
            return self::EnviarResponse($result, success: true, message: Mensagens::USUARIO_CADASTRO_SUCESSO->value, statusCode: 201);
        }
    }

    #[ValidarRequest(UsuarioValidation::class, 'ConfirmarContaParametros')]
    public static function ConfirmarConta(Request $request) {
        $validacao = ValidacaoService::ObterValidacao($request->hash, TipoCodigoValidacao::CONFIRMAR_CONTA);
        $usuario = UsuarioService::ObterUsuarioPorGUID($validacao->guid_usuario);

        if(!$usuario) throw new UsuarioNaoEncontradoException();

        UsuarioService::ValidarConta($usuario);
        ValidacaoService::DeletarValidacao($validacao);

        return self::EnviarResponse(message: Mensagens::USUARIO_CONTA_VALIDADA->value);
    }

    #[ValidarRequest(UsuarioValidation::class, 'LoginParametros')]
    public static function Login(Request $request)
    {
        if ($result = UsuarioService::AutenticarUsuario($request->email, $request->senha)) {
            $result['usuario'] = $request->user();

            if(!$result['usuario']->email_verified_at) throw new RuntimeException(MensagensValidacao::VALIDACAO_EMAIL_NAO_VERIFICADO->value);

            return self::EnviarResponse($result, success: true, message: Mensagens::USUARIO_LOGIN_SUCESSO->value);
        }

        return self::EnviarResponse($result, success: false, message: Mensagens::USUARIO_LOGIN_ERRO->value, statusCode: 401);
    }

    #[ValidarRequest(UsuarioValidation::class, 'RecuperarSenhaParametros')]
    public static function EnviarEmailRecuperacaoSenha(Request $request) {
        $usuario = UsuarioService::ObterUsuarioPorEmail($request->email);

        if(!$usuario) throw new UsuarioNaoEncontradoException();

        ValidacaoService::GerarCodigoValidacao($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);

        return self::EnviarResponse(
            message: Mensagens::EMAIL_ENVIADO_REDEFINICAO_SENHA->value
        );
    }

    #[ValidarRequest(UsuarioValidation::class, 'RedefinirSenhaParametros')]
    public static function RedefinirSenha(Request $request)
    {
        if(UsuarioService::AlterarSenha($request->hash, $request->senha)) {
            return self::EnviarResponse(message: Mensagens::SENHA_ALTERADA_SUCESSO->value);
        }
        
        return self::EnviarResponse( statusCode: 500, message: Mensagens::USUARIO_SENHA_ALTERADA_ERRO->value);     
    }

    public static function ObterDadosUsuario(Request $request) {
        return self::EnviarResponse(
            content: $request->user()
        );
    }
}
