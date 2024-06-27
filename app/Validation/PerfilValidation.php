<?php

namespace App\Validation;

use App\Interfaces\IValidacaoRequest;
use App\Interfaces\IValidationParams;

class PerfilValidation extends Validacao {    
    public static function CadastroParametros() {
        return [
            'cnpj' => self::ObterParametro('cnpj'),
            'razaoSocial' => self::ObterParametro('razaoSocial'),
            'telefone' => self::ObterParametro('telefone'),
            'email' => self::ObterParametro('email'),
            'cep' => self::ObterParametro('cep'),
            'logadouro' => self::ObterParametro('logadouro'),
            'bairro' => self::ObterParametro('bairro'),
            'cidade' => self::ObterParametro('cidade'),
            'estado' => self::ObterParametro('estado')
        ];
    }

    public static function CNPJConsultaParametros() {
        return [ 'cnpj' => self::ObterParametro('cnpj') ];
    }
    
    public static function UsuariosDoPerfil() {
        return [ 'perfil_id' => 'required' ];
    }
}