<?php

namespace App\Validation;

use App\Interfaces\IValidationParams;

class UsuarioValidation implements IValidationParams {
    public static function ValidationParams(): array {
        return [
            //nome
            'nome.required' => 'O nome deve ser preenchido.',

            //sobrenome
            'sobrenome.required' => 'O sobrenome deve ser preenchido.',

            //email
            'email.required' => 'O email deve ser preenchido.',
            'email.email' => 'E-mail inválido.',

            //cpf
            'cpf.required' => 'O CPF deve ser preenchido.',
            'cpf.min' => 'O CPF deve conter ao menos :min caracteres.',
            'cpf.max' => 'O CPF deve conter no máximo :max caracteres.',

            //telefone
            'telefone.required' => 'O telefone deve ser preenchido.',
            'telefone.min' => 'O telefone deve conter ao menos :min caracteres.',
            'telefone.max' => 'O telefone deve conter no máximo :max caracteres.',

            //senha
            'senha.required' => 'A senha deve ser preenchida.',
            'senha.min' => 'A senha deve conter ao menos :min caracteres.',
            'senha.max' => 'A senha deve conter no máximo :max caracteres.',

            //hash
            'hash.required' => 'O hash é obrigatório',
            'hash.min' => 'O hash deve conter 6 caracteres',
            'hash.max' => 'O hash deve conter 6 caracteres'
        ];
    }
}