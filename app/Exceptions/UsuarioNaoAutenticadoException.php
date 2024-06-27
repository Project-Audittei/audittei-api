<?php

namespace App\Exceptions;

use App\Language\Mensagens;

class UsuarioNaoAutenticadoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct(Mensagens::NAO_AUTENTICADO, 401);
    }
}