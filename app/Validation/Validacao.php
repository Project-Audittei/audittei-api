<?php

namespace App\Validation;

use App\Interfaces\IValidacaoRequest;
use App\Language\MensagensValidacao;

abstract class Validacao implements IValidacaoRequest {
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
            'razaoSocial.required' => 'A razão social deve ser preenchida.',

            //cnpj
            'cnpj.required' => 'O CNPJ deve ser preenchido.',
            'cnpj.min' => 'O CNPJ deve conter ao menos :min caracteres.',
            'cnpj.max' => 'O CNPJ deve conter no máximo :max caracteres.',

            //CEP
            'cep.required' => 'O CEP é obrigatório',
            'cep.min' => 'O CEP deve conter 6 caracteres',
            'cep.max' => 'O CEP deve conter 6 caracteres',

            //Logadouro
            'logadouro.required' => 'O logadouro é obrigatório',
            'logadouro.min' => 'O logadouro deve conter 6 caracteres',
            'logadouro.max' => 'O logadouro deve conter 6 caracteres',

            //Bairro
            'bairro.required' => 'O bairro é obrigatório',
            'bairro.min' => 'O bairro deve conter 6 caracteres',
            'bairro.max' => 'O bairro deve conter 6 caracteres',

            //Cidade
            'cidade.required' => 'O cidade é obrigatório',
            'cidade.min' => 'O cidade deve conter 6 caracteres',
            'cidade.max' => 'O cidade deve conter 6 caracteres',

            //Estado
            'estado.required' => 'O estado é obrigatório',
            'estado.min' => 'O estado deve conter 6 caracteres',
            'estado.max' => 'O estado deve conter 6 caracteres',
        ];
    } 
}