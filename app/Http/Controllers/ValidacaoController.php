<?php

namespace App\Http\Controllers;

use App\Constants\TipoCodigoValidacao;
use App\Models\User;
use App\Models\ValidationControl;
use App\Services\ValidacaoService;
use App\Traits\ExpiravelTrait;

class ValidacaoController extends Controller
{
    use ExpiravelTrait;

    public static function GerarCodigoValidacao(User $usuario, TipoCodigoValidacao $tipo) {
        $hash = "";

        if(!self::ChecarSeUsuarioPossuiHashAtivo($usuario, $tipo)) {
            $hash = ValidacaoService::GerarCodigoValidacao($usuario, $tipo);
        } else {
            $hash = ValidacaoService::AtualizarCodigoValidacao($usuario, $tipo);
        }

        return self::_enviarEmail($usuario, $tipo, $hash);
    }

    public static function ChecarSeUsuarioPossuiHashAtivo(User $usuario, TipoCodigoValidacao $tipo) {
        $hash = ValidationControl::where('guid_usuario', $usuario->guid)->where('tipo', $tipo)->first();
        return $hash ? true : false;
    }

    public static function ObterValidacao(string $hash, TipoCodigoValidacao $tipo) {
        $validacao = ValidationControl::where('hash_validacao', $hash)->where('tipo', $tipo)->first();

        if(!$validacao) throw new \Exception("Código de verificação não encontrado");
    
        self::_checarValidateHash($validacao->expires);

        return $validacao;
    }

    private static function _enviarEmail(User $usuario, TipoCodigoValidacao $tipo, string $hash) {
        switch($tipo) {
            case TipoCodigoValidacao::CONFIRMAR_CONTA:
                return EmailController::EnviarEmailConfirmacaoConta($usuario, $hash);
            case TipoCodigoValidacao::REDEFINIR_SENHA:
                return EmailController::EnviarEmailResetSenha($usuario, $hash);
        }
    }
}
