<?php

namespace Tests\Feature;

use App\Language\Label;
use App\Language\Mensagens;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

class EnviarEmailTrocaSenhaTest extends TestCase
{
    #[TestDox("Solicitação de alteração de senha")]
    public function test_solicitacao_alteracao_senha(): void
    {
        $response = $this->postJson('/api/auth/esqueci-senha', [
            "email" => "fernandoavilajunior@gmail.com",
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([ 'message' => Mensagens::EMAIL_ENVIADO_REDEFINICAO_SENHA->value ]);
    }

    #[TestDox("Solicitação de alteração de senha com e-mail inexistente")]
    public function test_com_email_inexistente(): void
    {
        $response = $this->postJson('/api/auth/esqueci-senha', [
            "email" => "naoexisteesteemail@gmail.com",
        ]);

        $response
            ->assertStatus(404)
            ->assertJson([ 'message' => Mensagens::BUSCA_USUARIO_POR_EMAIL_NAO_ENCONTRADO->value ]);
    }
}
