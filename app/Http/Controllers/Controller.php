<?php

namespace App\Http\Controllers;

use App\Language\Mensagens;

abstract class Controller
{
    public static function EnviarResponse($content = [], $statusCode = 200, $success = true, string $message = null) {
        return response(content: [
            'statusCode' => $statusCode,
            'data' => $content,
            'success' => $success,
            'message' => $message ?? Mensagens::GENERICO_CONSULTA_SUCESSO->value
        ], status: $statusCode);
    }
}
