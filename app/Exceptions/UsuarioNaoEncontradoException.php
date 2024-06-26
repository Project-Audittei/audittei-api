<?php

namespace App\Exceptions;

use App\Core\ExcecaoBasica;

class UsuarioNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct("Usuário não encontrado com os dados fornecidos.", 404);
    }
}