<?php

namespace App\Traits;

use App\Language\Mensagens;

trait EnviarResponseTrait {
    public static function EnviarResponse($content = [], $statusCode = 200, $success = true, string $message = null) {
        return response(content: [
            'statusCode' => $statusCode,
            'data' => $content,
            'success' => $success,
            'message' => $message ?? Mensagens::GENERICO_CONSULTA_SUCESSO->value
        ], status: $statusCode);
    }
}