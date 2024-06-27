<?php

namespace App\Exceptions;

class PerfilNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct("Nenhum perfil foi encontrado.", 404);
    }
}