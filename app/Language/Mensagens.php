<?php

namespace App\Language;

enum Mensagens : string {
    case BUSCA_USUARIO_POR_EMAIL_NAO_ENCONTRADO = "Usuário não encontrado com os dados fornecidos.";

    // Codigo de Verificação
    case CODIGO_VERIFICACAO_NAO_ENCONTRADO = "Código de verificação não encontrado";
    case CODIGO_VERIFICACAO_EXPIROU = "Código de validação expirado.";

    case SENHA_ALTERADA_SUCESSO = "Senha alterada com sucesso!";
    
    //E-mail enviado
    case EMAIL_ENVIADO_REDEFINICAO_SENHA = "O E-mail de redefinição de senha foi enviado com sucesso!";
}