<?php

namespace App\Services;

use App\Constants\TipoCodigoValidacao;
use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Models\User;
use App\Models\ValidationControl;

class ValidacaoService {
    public static function GerarCodigoValidacao(User $usuario, TipoCodigoValidacao $tipo) {
        $validacao = ValidationControl::where('guid_usuario', $usuario->guid)
                                        ->where('tipo', $tipo)
                                        ->first();

        if(!$validacao) {
            $validacao = new ValidationControl();

            $validacao->guid_usuario = $usuario->guid;
            $validacao->tipo = $tipo;
            $validacao->hash_validacao = self::_generateConfirmationCode();
            $validacao->expires = self::_obterDataExpiracao();
            
            $validacao->save();
        } else {
            $validacao->hash_validacao = self::_generateConfirmationCode();
            $validacao->expires = self::_obterDataExpiracao();
    
            $validacao->save();
        }
        return self::_enviarEmail($usuario, $validacao->hash_validacao, $tipo);
    }

    public static function ObterValidacao(string $hash, TipoCodigoValidacao $tipo) : ValidationControl {
        $validacao = ValidationControl::where('hash_validacao', $hash)->where('tipo', $tipo)->first();

        if(!$validacao) throw new ExcecaoBasica(Mensagens::CODIGO_VERIFICACAO_NAO_ENCONTRADO);
    
        self::_checarValidateHash($validacao->expires);

        return $validacao;
    }
    
    public static function ObterValidacaoPorUsuario(User $usuario, TipoCodigoValidacao $tipo) : ValidationControl {
        $validacao = ValidationControl::where('guid_usuario', $usuario->guid)->where('tipo', $tipo)->first();

        if(!$validacao) throw new ExcecaoBasica(Mensagens::CODIGO_VERIFICACAO_NAO_ENCONTRADO);
    
        self::_checarValidateHash($validacao->expires);

        return $validacao;
    }

    public static function DeletarValidacao(ValidationControl $validacao) {
        return $validacao->delete();
    }

    public static function _generateConfirmationCode($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $confirmationCode = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = random_int(0, $charactersLength - 1);
            $confirmationCode .= $characters[$randomIndex];
        }
    
        return $confirmationCode;
    }

    private static function _enviarEmail(User $usuario, string $hash, TipoCodigoValidacao $tipo) {
        switch($tipo) {
            case TipoCodigoValidacao::CONFIRMAR_CONTA:
                return EmailService::EnviarEmailConfirmacaoConta($usuario, $hash);
            case TipoCodigoValidacao::REDEFINIR_SENHA:
                return EmailService::EnviarEmailResetSenha($usuario, $hash);
        }
    }

    public static function _obterDataExpiracao() {
        $currentDate = new \DateTime();

        return $currentDate->add(new \DateInterval('PT2H'))->format('Y-m-d H:i:s');
    }

    private static function _checarValidateHash($expires) {
        $date1 = date_timestamp_get(date_create($expires));
        $date2 = date_timestamp_get(new \DateTime());
        $diff = $date1 - $date2;

        if($diff <= 0) throw new ExcecaoBasica(Mensagens::CODIGO_VERIFICACAO_EXPIROU);
    }
}