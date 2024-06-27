<?php

namespace App\Exceptions;

use App\Language\Mensagens;
use App\Language\MensagensValidacao;

class UsuarioNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct(Mensagens::BUSCA_USUARIO_POR_EMAIL_NAO_ENCONTRADO, 404);
    }
}