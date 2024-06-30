<?php

namespace App\Exceptions;

use App\Language\Mensagens;

class EscritorioNaoEncontradoException extends ExcecaoBasica {
    public function __construct()
    {
        parent::__construct(Mensagens::NAO_ENCONTRADO_ESCRITORIO, 404);
    }
}