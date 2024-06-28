<?php

namespace App\Validation;

class UsuarioValidation extends Validacao {
    public static function CadastroParametros(): array {
        return [
            'nomeCompleto' => self::ObterParametro('nomeCompleto'),
            'telefone' => self::ObterParametro('telefone'),
            'email' => self::ObterParametro('email'),
            'senha' => self::ObterParametro('senha'),
        ];
    }

    public static function ConfirmarContaParametros() : array {
        return [
            'hash' => self::ObterParametro('hash')
        ];
    }

    public static function LoginParametros() : array {
        return [
            'email' => self::ObterParametro('email'),
            'senha' => self::ObterParametro('senha'),
        ];
    }

    public static function RecuperarSenhaParametros() : array {
        return [
            'email' => self::ObterParametro('email'),
        ];
    }

    public static function RedefinirSenhaParametros() : array {
        return [
            'hash' => self::ObterParametro('hash'),
            'senha' => self::ObterParametro('senha'),
        ];
    }
}