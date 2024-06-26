<?php

namespace App\Exceptions;

use App\Core\ExcecaoBasica;
use Exception;

class PerfilNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct("Nenhum perfil foi encontrado.", 404);
    }
}