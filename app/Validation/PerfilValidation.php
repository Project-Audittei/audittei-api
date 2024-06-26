<?php

namespace App\Validation;

use App\Interfaces\IValidationParams;

class PerfilValidation implements IValidationParams {
    public static function ValidationParams(): array {
        return [
            //razaoSocial
            'razaoSocial.required' => 'A razão social deve ser preenchida.',

            //email
            'email.required' => 'O email deve ser preenchido.',
            'email.email' => 'E-mail inválido.',

            //cnpj
            'cnpj.required' => 'O CNPJ deve ser preenchido.',
            'cnpj.min' => 'O CNPJ deve conter ao menos :min caracteres.',
            'cnpj.max' => 'O CNPJ deve conter no máximo :max caracteres.',

            //telefone
            'telefone.required' => 'O telefone deve ser preenchido.',
            'telefone.min' => 'O telefone deve conter ao menos :min caracteres.',
            'telefone.max' => 'O telefone deve conter no máximo :max caracteres.',

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