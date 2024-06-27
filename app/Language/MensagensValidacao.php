<?php

namespace App\Language;

enum MensagensValidacao : string {
    case VALIDACAO_NOME_OBRIGATORIO = "O nome completo deve ser preenchido.";
    case VALIDACAO_SOBRENOME_OBRIGATORIO = "O sobrenome completo deve ser preenchido.";
    
    case VALIDACAO_EMAIL_OBRIGATORIO = "O e-mail deve ser preenchido.";
    case VALIDACAO_EMAIL_INVALIDO = "E-mail inválido.";
    
    case VALIDACAO_CPF_OBRIGATORIO = "O CPF deve ser preenchido.";
    case VALIDACAO_CPF_MIN = "O CPF deve conter ao menos :min caracteres.";
    case VALIDACAO_CPF_MAX = "O CPF deve conter no máximo :max caracteres.";
    
    case VALIDACAO_TELEFONE_OBRIGATORIO = "O telefone deve ser preenchido.";
    case VALIDACAO_TELEFONE_MIN = "O telefone deve conter ao menos :min caracteres.";
    case VALIDACAO_TELEFONE_MAX = "O telefone deve conter no máximo :max caracteres.";
    
    case VALIDACAO_SENHA_OBRIGATORIO = "A senha deve ser preenchido.";
    case VALIDACAO_SENHA_MIN = "A senha deve conter ao menos :min caracteres.";
    case VALIDACAO_SENHA_MAX = "A senha deve conter no máximo :max caracteres.";
    
    case VALIDACAO_HASH_OBRIGATORIO = "O hash é obrigatório.";
    case VALIDACAO_HASH_MINMAX = "O hash deve conter 6 caracteres";
}