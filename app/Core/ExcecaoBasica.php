<?php

namespace App\Core;

use Exception;

class ExcecaoBasica extends Exception {
    public int $httpStatusCode = 500;

    public function __construct(string $mensagem, int $statusCode = 500)
    {
        $this->message = $mensagem;
        $this->httpStatusCode = $statusCode;
    }
}