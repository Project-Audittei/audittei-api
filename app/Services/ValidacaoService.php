<?php

namespace App\Services;

use App\Constants\TipoCodigoValidacao;
use App\Models\User;
use App\Models\ValidationControl;
use App\Traits\ExpiravelTrait;
use Exception;

use function App\Helpers\GenerateConfirmationCode;

class ValidacaoService {
    use ExpiravelTrait;

    public static function GerarCodigoValidacao(User $usuario, TipoCodigoValidacao $tipo) : string {
        $validacao = new ValidationControl();

        $validacao->guid_usuario = $usuario->guid;
        $validacao->tipo = $tipo;
        $validacao->hash_validacao = GenerateConfirmationCode();
        $validacao->expires = self::_obterDataExpiracao();

        $validacao->save();
        
        return $validacao->hash_validacao;
    }

    public static function AtualizarCodigoValidacao(User $usuario, TipoCodigoValidacao $tipo) {
        $validacao = ValidationControl::where('guid_usuario', $usuario->guid)->where('tipo', $tipo)->first();

        if(!$validacao) throw new Exception("Validação não encontrada");

        $validacao->hash_validacao = GenerateConfirmationCode();
        $validacao->expires = self::_obterDataExpiracao();

        $validacao->save();
        
        return $validacao->hash_validacao;
    }

    public static function DeletarValidacao(ValidationControl $validacao) {
        return $validacao->delete();
    }
}