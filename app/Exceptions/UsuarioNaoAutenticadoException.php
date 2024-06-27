<?php

namespace App\Exceptions;

class UsuarioNaoAutenticadoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct("Você precisa estar autenticado para realizar esta operacação.", 401);
    }
}