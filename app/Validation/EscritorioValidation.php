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
            'logradouro' => self::ObterParametro('logradouro'),
            'bairro' => self::ObterParametro('bairro'),
            'cidade' => self::ObterParametro('cidade'),
            'uf' => self::ObterParametro('uf')
        ];
    }
    
    public static function EditarEscritorio() {
        return [
            'guid' => self::ObterParametro('guid'),
            'telefone' => self::ObterParametro('telefone'),
            'email' => self::ObterParametro('email'),
            'cep' => self::ObterParametro('cep'),
            'logradouro' => self::ObterParametro('logradouro'),
            'bairro' => self::ObterParametro('bairro'),
            'cidade' => self::ObterParametro('cidade'),
            'uf' => self::ObterParametro('uf')
        ];
    }

    public static function CNPJConsultaParametros() {
        return [ 'cnpj' => self::ObterParametro('cnpj') ];
    }
    
    public static function UsuariosDoEscritorio() {
        return [ 'escritorio_id' => 'required' ];
    }
}