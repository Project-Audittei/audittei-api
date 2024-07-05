<?php

namespace App\Exceptions;

use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use RuntimeException;

class ExcecaoBasica extends RuntimeException {
    public int $httpStatusCode = 500;

    public function __construct(Mensagens | MensagensValidacao $label, int $statusCode = 500)
    {
        $this->message = $label->value;
        $this->httpStatusCode = $statusCode;
    }
}