<?php

namespace Tests\Unit;

use App\Models\Escritorio;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class EscritorioTest extends TestCase
{
    #[TestDox('Criação de Escritório')]
    public function test_criar_escritorio(): void {

        $escritorio = Escritorio::factory()->make();

        $this->assertTrue(!is_null($escritorio->guid));
        $this->assertTrue(!is_null($escritorio->cnpj));
        $this->assertTrue(!is_null($escritorio->email));
        $this->assertTrue(!is_null($escritorio->telefone));
    }
}
