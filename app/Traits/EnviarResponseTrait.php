<?php

namespace App\Traits;

trait EnviarResponseTrait {
    public static function EnviarResponse($content = [], $statusCode = 200, $success = true, $message = '') {
        return response(content: [
            'statusCode' => $statusCode,
            'data' => $content,
            'success' => $success,
            'message' => $message
        ], status: $statusCode);
    }
}