<?php

namespace App\Language;

enum Mensagens : string {
    // Codigo de Verificação
    case CODIGO_VERIFICACAO_NAO_ENCONTRADO = "Código de verificação não encontrado";
    case CODIGO_VERIFICACAO_EXPIROU = "Código de validação expirado.";

    case SENHA_ALTERADA_SUCESSO = "Senha alterada com sucesso!";

    case ESCRITORIO_CADASTRO_SUCESSO = "Escritório criado com sucesso!";
    case ESCRITORIO_ATUALIZADO_SUCESSO = "Escritório atualizado com sucesso!";
    case ESCRITORIO_ATUALIZADO_ERRO = "Não foi possível atualizar o escritório.";

    case EMPRESA_CADASTRO_SUCESSO = "Empresa criada com sucesso!";
    case EMPRESA_CADASTRO_ERRO = "Não foi possível criar a empresa.";
    case EMPRESA_CADASTRO_EXISTENTE = "A empresa já é gerenciada pelo escritório.";
    
    case EMPRESA_ATUALIZACAO_SUCESSO = "Empresa atualizada com sucesso!";
    
    case NAO_AUTENTICADO = "Você precisa estar autenticado para realizar esta operacação.";
    case NAO_ENCONTRADO_ESCRITORIO = "Nenhum escritório foi encontrado.";
    case NAO_ENCONTRADO_USUARIO = "Usuário não encontrado com os dados fornecidos.";

    case USUARIO_CADASTRO_SUCESSO = "Cadastrado com sucesso!";
    
    case USUARIO_CONTA_VALIDADA = "Conta validada com sucesso!";
    case USUARIO_LOGIN_SUCESSO = "Autenticado com sucesso!";
    case USUARIO_LOGIN_ERRO = "Usuário/senha incorreto";
    case USUARIO_SENHA_ALTERADA_ERRO = "Não foi possível redefinir sua senha.";

    case GENERICO_ERRO_PARAMETRO_VAZIO = "É necessário preencher os parâmetros para realizar esta operação.";
    case GENERICO_ERRO_SALVAR_ENTIDADE = "Não foi possível salvar a entidade.";
    case GENERICO_ERRO_EDITAR_ENTIDADE = "Não foi possível editar a entidade.";
    case GENERICO_CONSULTA_SUCESSO = "Consulta realizada com sucesso!";
    
    //E-mail enviado
    case EMAIL_ENVIADO_REDEFINICAO_SENHA = "O E-mail de redefinição de senha foi enviado com sucesso!";
}