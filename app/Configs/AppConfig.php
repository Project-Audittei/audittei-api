<?php

namespace App\Configs;

class AppConfig {

    private $chaves = [
        "redefinir-senha" => "1d02c1cf-2ad3-4fa7-aed7-830e39657aa1",
        "confirmar-conta" => "eb3bcec4-252c-4404-99c4-0a7e5d02b6c6"
    ];

    public static function ObterConstante(string $chave) {
        return self::$chaves[$chave];
    }
}