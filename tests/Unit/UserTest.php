<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

class UserTest extends TestCase
{
    #[TestDox('Criação de usuário')]
    public function test_criar_usuario(): void {

        $usuario = User::factory()->make();

        $this->assertTrue(!is_null($usuario->nomeCompleto));
        $this->assertTrue(!is_null($usuario->email));
        $this->assertTrue(!is_null($usuario->telefone));
        $this->assertTrue(!is_null($usuario->senha));
    }
}
