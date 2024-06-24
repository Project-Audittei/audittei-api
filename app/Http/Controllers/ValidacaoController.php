<?php

namespace App\Http\Controllers;

use App\Configs\AppConfig;
use App\Constants\TipoCodigoValidacao;
use App\Models\ValidationControl;
use App\Traits\ExpiravelTrait;
use Illuminate\Http\Request;

use function App\Helpers\GenerateConfirmationCode;

class ValidacaoController extends Controller
{
    use ExpiravelTrait;

    public static function GerarCodigoValidacao(string $guid, TipoCodigoValidacao $tipo) {
        $validacao = new ValidationControl();

        $validacao->guid_usuario = $guid;
        $validacao->hash_validacao = GenerateConfirmationCode();
        $validacao->tipo = $tipo;
        $validacao->expires = self::_obterDataExpiracao();

        $validacao->save();
        
        return $validacao->hash_validacao;
    }

    public static function GerarCodigoRedefinicaoSenha(string $guid) {
        $validacao = new ValidationControl();

        $validacao->guid_usuario = $guid;
        $validacao->hash_validacao = GenerateConfirmationCode();
        $validacao->tipo = TipoCodigoValidacao::REDEFINIR_SENHA;
        $validacao->expires = self::_obterDataExpiracao();

        return $validacao->save();
    }

    public static function ObterValidacao(string $hash, TipoCodigoValidacao $tipo) {
        $validacao = self::_obterValidacao($hash);

        if(!$validacao) throw new \Exception("O código de validação expirou.");
        self::_checarValidateHash($validacao->expires);

        if($validacao->tipo != $tipo) throw new \Exception("O código de validação informado não é válido");

        return self::_obterValidacao($hash);
    }

    public static function _obterValidacao(string $hash) {
        return ValidationControl::where('hash_validacao', $hash)->first();
    }
}
