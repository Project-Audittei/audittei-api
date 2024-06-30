<?php

namespace App\Validation;

class EscritorioValidation extends Validacao {    
    public static function CadastroEscritorio() {
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
    
    public static function UsuariosDoEscritorio() {
        return [ 'escritorio_id' => 'required' ];
    }
}