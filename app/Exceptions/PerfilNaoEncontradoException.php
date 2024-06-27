<?php

namespace App\Exceptions;

use App\Language\Mensagens;

class PerfilNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct(Mensagens::NAO_ENCONTRADO_PERFIL, 404);
    }
}