<?php

namespace App\Exceptions;

use App\Language\Mensagens;
use App\Language\MensagensValidacao;

class UsuarioNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct(Mensagens::NAO_ENCONTRADO_USUARIO, 404);
    }
}