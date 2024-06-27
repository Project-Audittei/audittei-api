<?php

namespace App\Language;

enum Label : string {
    case USUARIO_CADASTRO_SUCESSO = "Cadastrado com sucesso!";
    case USUARIO_CADASTRO_EMAIL_EXISTENTE = "Email já cadastrado.";
    case USUARIO_CADASTRO_TELEFONE_EXISTENTE = "Telefone já cadastrado.";
    case USUARIO_CADASTRO_EMAIL_NAO_VERIFICADO = "E-mail não verificado.";
    case USUARIO_CONTA_VALIDADA = "Conta validada com sucesso!";
    case USUARIO_LOGIN_SUCESSO = "Autenticado com sucesso!";
    case USUARIO_LOGIN_ERRO = "Usuário/senha incorreto";
    case USUARIO_SENHA_ALTERADA_ERRO = "Não foi possível redefinir sua senha.";

    case GENERICO_ERRO_SALVAR_ENTIDADE = "Não foi possível salvar a entidade.";
    case GENERICO_ERRO_EDITAR_ENTIDADE = "Não foi possível editar a entidade.";

    
}