<?php

namespace App\Validation;

use App\Language\MensagensValidacao;

abstract class Validacao {
    public static array $parametros = [
        'cnpj' => 'required',
        'razaoSocial' => 'required',
        'telefone' => 'required|min:10|max:11',
        'email' => 'required|email',
        'cep' => 'required',
        'logadouro' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'nomeCompleto' => 'required',
        'senha' => 'required|min:8|max:30',
        'hash' => 'required|min:6|max:6'
    ];

    public static function ObterParametro(string $nome) {
        return self::$parametros[$nome];
    }

    public static function ValidacaoMensagens(): array
    {
        return [
            //nome
            'nomeCompleto.required' => MensagensValidacao::VALIDACAO_NOME_OBRIGATORIO->value,

            //sobrenome
            'sobrenome.required' => MensagensValidacao::VALIDACAO_SOBRENOME_OBRIGATORIO->value,

            //email
            'email.required' => MensagensValidacao::VALIDACAO_EMAIL_OBRIGATORIO->value,
            'email.email' => MensagensValidacao::VALIDACAO_EMAIL_OBRIGATORIO->value,

            //cpf
            'cpf.required' => MensagensValidacao::VALIDACAO_CPF_OBRIGATORIO->value,
            'cpf.min' => MensagensValidacao::VALIDACAO_CPF_MIN->value,
            'cpf.max' => MensagensValidacao::VALIDACAO_CPF_MAX->value,

            //telefone
            'telefone.required' => MensagensValidacao::VALIDACAO_TELEFONE_OBRIGATORIO->value,
            'telefone.min' => MensagensValidacao::VALIDACAO_TELEFONE_MIN->value,
            'telefone.max' => MensagensValidacao::VALIDACAO_TELEFONE_MAX->value,

            //senha
            'senha.required' => MensagensValidacao::VALIDACAO_SENHA_OBRIGATORIO->value,
            'senha.min' => MensagensValidacao::VALIDACAO_SENHA_MIN->value,
            'senha.max' => MensagensValidacao::VALIDACAO_SENHA_MAX->value,

            //hash
            'hash.required' => MensagensValidacao::VALIDACAO_HASH_OBRIGATORIO->value,
            'hash.min' => MensagensValidacao::VALIDACAO_HASH_MINMAX->value,
            'hash.max' => MensagensValidacao::VALIDACAO_HASH_MINMAX->value,

            //razaoSocial
            'razaoSocial.required' => MensagensValidacao::VALIDACAO_RAZAO_SOCIAL_OBRIGATORIO->value,

            //cnpj
            'cnpj.required' => MensagensValidacao::VALIDACAO_CNPJ_OBRIGATORIO->value,
            'cnpj.min' => MensagensValidacao::VALIDACAO_CNPJ_MIN->value,
            'cnpj.max' => MensagensValidacao::VALIDACAO_CNPJ_MAX->value,

            //CEP
            'cep.required' => MensagensValidacao::VALIDACAO_CEP_OBRIGATORIO->value,
            'cep.min' => MensagensValidacao::VALIDACAO_CEP_MINMAX->value,
            'cep.max' => MensagensValidacao::VALIDACAO_CEP_MINMAX->value,

            //Logadouro
            'logadouro.required' => MensagensValidacao::VALIDACAO_LOGRADOURO_OBRIGATORIO->value,
            'logadouro.min' => MensagensValidacao::VALIDACAO_LOGRADOURO_MINMAX->value,
            'logadouro.max' => MensagensValidacao::VALIDACAO_LOGRADOURO_MINMAX->value,

            //Bairro
            'bairro.required' => MensagensValidacao::VALIDACAO_BAIRRO_OBRIGATORIO->value,
            'bairro.min' => MensagensValidacao::VALIDACAO_BAIRRO_MINMAX->value,
            'bairro.max' => MensagensValidacao::VALIDACAO_BAIRRO_MINMAX->value,

            //Cidade
            'cidade.required' => MensagensValidacao::VALIDACAO_CIDADE_OBRIGATORIO->value,
            'cidade.min' => MensagensValidacao::VALIDACAO_CIDADE_MINMAX->value,
            'cidade.max' => MensagensValidacao::VALIDACAO_CIDADE_MINMAX->value,

            //Estado
            'estado.required' => MensagensValidacao::VALIDACAO_ESTADO_OBRIGATORIO->value,
            'estado.min' => MensagensValidacao::VALIDACAO_ESTADO_MINMAX->value,
            'estado.max' => MensagensValidacao::VALIDACAO_ESTADO_MINMAX->value,
        ];
    } 
}