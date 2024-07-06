<?php

namespace App\Language;

enum MensagensValidacao : string {
    case VALIDACAO_GUID_OBRIGATORIO = "O GUID da entidade deve ser preenchido.";

    case VALIDACAO_NOME_OBRIGATORIO = "O nome completo deve ser preenchido.";
    case VALIDACAO_SOBRENOME_OBRIGATORIO = "O sobrenome completo deve ser preenchido.";
    
    case VALIDACAO_EMAIL_OBRIGATORIO = "O e-mail deve ser preenchido.";
    case VALIDACAO_EMAIL_INVALIDO = "E-mail inválido.";
    case VALIDACAO_EMAIL_EXISTENTE = "Email já cadastrado.";
    case VALIDACAO_EMAIL_NAO_VERIFICADO = "E-mail não verificado.";
    
    case VALIDACAO_CPF_OBRIGATORIO = "O CPF deve ser preenchido.";
    case VALIDACAO_CPF_MIN = "O CPF deve conter ao menos :min caracteres.";
    case VALIDACAO_CPF_MAX = "O CPF deve conter no máximo :max caracteres.";
    
    case VALIDACAO_TELEFONE_OBRIGATORIO = "O telefone deve ser preenchido.";
    case VALIDACAO_TELEFONE_MIN = "O telefone deve conter ao menos :min caracteres.";
    case VALIDACAO_TELEFONE_MAX = "O telefone deve conter no máximo :max caracteres.";
    case VALIDACAO_TELEFONE_EXISTENTE = "Telefone já cadastrado.";
    
    case VALIDACAO_SENHA_OBRIGATORIO = "A senha deve ser preenchido.";
    case VALIDACAO_SENHA_MIN = "A senha deve conter ao menos :min caracteres.";
    case VALIDACAO_SENHA_MAX = "A senha deve conter no máximo :max caracteres.";
    
    case VALIDACAO_HASH_OBRIGATORIO = "O hash é obrigatório.";
    case VALIDACAO_HASH_MINMAX = "O hash deve conter 6 caracteres";
    
    case VALIDACAO_RAZAO_SOCIAL_OBRIGATORIO = "A razão social deve ser preenchida.";

    case VALIDACAO_COMPLEMENTO_OBRIGATORIO = "O complemento deve ser preenchido.";

    case VALIDACAO_RESPONSAVEL_LEGAL_OBRIGATORIO = "O responsável legal deve ser preenchido.";

    case VALIDACAO_NOME_FANTASIA_OBRIGATORIO = "O nome fantasia deve ser preenchido.";
    
    case VALIDACAO_CNPJ_OBRIGATORIO = "O CNPJ deve ser preenchido.";
    case VALIDACAO_CNPJ_MIN = "O CNPJ deve conter ao menos :min caracteres.";
    case VALIDACAO_CNPJ_MAX = "O CNPJ deve conter no máximo :max caracteres.";
    
    case VALIDACAO_CEP_OBRIGATORIO = "O CEP deve ser preenchido.";
    case VALIDACAO_CEP_MINMAX = "O CEP deve conter 6 caracteres";
    
    case VALIDACAO_LOGRADOURO_OBRIGATORIO = "O logadouro é obrigatório.";
    case VALIDACAO_LOGRADOURO_MINMAX = "O logadouro deve conter 6 caracteres.";
    
    case VALIDACAO_BAIRRO_OBRIGATORIO = "O bairro é obrigatório";
    case VALIDACAO_BAIRRO_MINMAX = "O bairro deve conter 6 caracteres";
    
    case VALIDACAO_CIDADE_OBRIGATORIO = "A cidade deve ser preenchida.";
    case VALIDACAO_CIDADE_MINMAX = "A cidade deve conter 6 caracteres.";
    
    case VALIDACAO_ESTADO_OBRIGATORIO = "O estado é obrigatório.";
    case VALIDACAO_ESTADO_MINMAX = "O estado deve conter 6 caracteres.";

    case VALIDACAO_ESCRITORIO_OBRIGATORIO = "É necessário ter um escritório cadastrado para utilizar este recurso.";
}