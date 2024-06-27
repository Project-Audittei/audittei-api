<?php

namespace App\Exceptions;

use App\Language\Label;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use Exception;

class ExcecaoBasica extends Exception {
    public int $httpStatusCode = 500;

    public function __construct(Label | Mensagens | MensagensValidacao $label, int $statusCode = 500)
    {
        $this->message = $label->value;
        $this->httpStatusCode = $statusCode;
    }
}