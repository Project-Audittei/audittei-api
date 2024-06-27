<?php

namespace Tests;

use App\Language\MensagensValidacao;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public static function PrepararMensagem(MensagensValidacao $mensagensValidacao, mixed $valor = []) {
        $operacao = str_replace("_", ":", strtolower(substr($mensagensValidacao->name, -4, sizeof(str_split($mensagensValidacao->name)))));

        if($operacao == ":min" || $operacao == ":max") return str_replace($operacao, $valor, $mensagensValidacao->value);

        return $mensagensValidacao->value;
    }
}
