<?php

namespace Tests\Feature;

use App\Language\Label;
use App\Language\MensagensValidacao;
use App\Models\User;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

class CriacaoUsuarioTest extends TestCase
{
    #[TestDox("Criação de usuário")]
    public function test_criar_usuario(): void
    {
        $usuario = User::factory()->make();

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => $usuario->nomeCompleto,
            "email" => $usuario->email,
            "telefone" => $usuario->telefone,
            "senha" => 'Audittei2024!'
        ]);

        $response->assertStatus(201);
    }

    #[TestDox("Criação de usuário com e-mail já cadastrado")]
    public function test_email_ja_cadastrado(): void
    {
        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "fernandoavilajunior@gmail.com",
            "telefone" => "21989407820",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => Label::USUARIO_CADASTRO_EMAIL_EXISTENTE->value ]);
    }

    #[TestDox("Criação de usuário com telefone já cadastrado")]
    public function test_telefone_ja_cadastrado(): void
    {
        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "21989407820",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => Label::USUARIO_CADASTRO_TELEFONE_EXISTENTE->value ]);
    }
    
    #[TestDox("Criação de usuário sem nome")]
    public function test_sem_nome(): void
    {
        $response = $this->postJson('/api/auth/cadastro', [
            "email" => "teste_email@gmail.com",
            "telefone" => "21989407820",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => MensagensValidacao::VALIDACAO_NOME_OBRIGATORIO->value ]);
    }
    
    #[TestDox("Criação de usuário sem telefone")]
    public function test_sem_telefone(): void
    {
        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => MensagensValidacao::VALIDACAO_TELEFONE_OBRIGATORIO->value ]);
    }
    
    #[TestDox("Criação de usuário com telefone incompleto")]
    public function test_com_telefone_incompleto(): void
    {
        $mensagem = self::PrepararMensagem(MensagensValidacao::VALIDACAO_TELEFONE_MIN, 10);

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "12334567",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => $mensagem ]);
    }
    
    #[TestDox("Criação de usuário com telefone maior")]
    public function test_com_telefone_maior(): void
    {
        $mensagem = self::PrepararMensagem(MensagensValidacao::VALIDACAO_TELEFONE_MAX, 11);

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "12334567891011",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => $mensagem ]);
    }

    #[TestDox("Criação de usuário sem senha")]
    public function test_sem_senha(): void
    {
        $mensagem = self::PrepararMensagem(MensagensValidacao::VALIDACAO_SENHA_OBRIGATORIO);

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "21989407820",
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => $mensagem ]);
    }

    #[TestDox("Criação de usuário com senha menor")]
    public function test_com_senha_menor(): void
    {
        $mensagem = self::PrepararMensagem(MensagensValidacao::VALIDACAO_SENHA_MIN, 8);

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "21989407820",
            "senha" => "1234567"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => $mensagem ]);
    }

    #[TestDox("Criação de usuário com senha maior")]
    public function test_com_senha_maior(): void
    {
        $mensagem = self::PrepararMensagem(MensagensValidacao::VALIDACAO_SENHA_MAX, 30);

        $response = $this->postJson('/api/auth/cadastro', [
            "nomeCompleto" => "Fernando Ávila",
            "email" => "teste_email@gmail.com",
            "telefone" => "21989407820",
            "senha" => "12345678910111213141516171819202122232425"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => $mensagem ]);
    }
}
