<?php

namespace App\Validation;

class EmpresaValidation extends Validacao {
    public static function CadastroEmpresa() {
        return [
            'cnpj' => self::ObterParametro('cnpj'),
            'razaoSocial' => self::ObterParametro('razaoSocial'),
            'nomeFantasia' => self::ObterParametro('nomeFantasia'),
            'responsavelLegal' => self::ObterParametro('responsavelLegal'),
            'email' => self::ObterParametro('email'),
            'telefone' => self::ObterParametro('telefone'),
            'cep' => self::ObterParametro('cep'),
            'logradouro' => self::ObterParametro('logradouro'),
            'bairro' => self::ObterParametro('bairro'),
            'cidade' => self::ObterParametro('cidade'),
            'numero' => self::ObterParametro('numero'),
            'uf' => self::ObterParametro('uf'),
        ];
    }

    public static function ObterUsuariosVinculadosAEmpresa() {
        return [
            'guid' => self::ObterParametro('guid')
        ];
    }
}