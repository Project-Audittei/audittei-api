<?php

namespace Tests\Feature;

use App\Constants\TipoCodigoValidacao;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Services\UsuarioService;
use App\Services\ValidacaoService;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

class RedefinirSenhaTest extends TestCase
{
    #[TestDox("Redefinição de senha")]
    public function test_solicitacao_alteracao_senha(): void
    {
        $usuario = UsuarioService::ObterUsuarioPorEmail("fernandoavilajunior@gmail.com");

        $validacao = ValidacaoService::ObterValidacaoPorUsuario($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);
        $validacao->hash_validacao = ValidacaoService::_generateConfirmationCode();
        $validacao->save();

        $response = $this->postJson('/api/auth/redefinir-senha', [
            "hash" => $validacao->hash_validacao,
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([ 'message' => Mensagens::SENHA_ALTERADA_SUCESSO->value ]);
    }
    
    #[TestDox("Redefinição de senha com hash incorreto")]
    public function test_solicitacao_alteracao_senha_com_hash_incorreto(): void
    {
        $usuario = UsuarioService::ObterUsuarioPorEmail("fernandoavilajunior@gmail.com");

        ValidacaoService::GerarCodigoValidacao($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);

        $response = $this->postJson('/api/auth/redefinir-senha', [
            "hash" => "123123",
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => Mensagens::CODIGO_VERIFICACAO_NAO_ENCONTRADO->value ]);
    }
    
    #[TestDox("Redefinição de senha com hash expirado")]
    public function test_solicitacao_alteracao_senha_com_hash_expirado(): void
    {
        $usuario = UsuarioService::ObterUsuarioPorEmail("fernandoavilajunior@gmail.com");
        $currentDate = new \DateTime();        

        $validacao = ValidacaoService::ObterValidacaoPorUsuario($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);
        $validacao->expires = $currentDate->modify('-5 days')->format('Y-m-d H:i:s');
        $validacao->save();

        $response = $this->postJson('/api/auth/redefinir-senha', [
            "hash" => $validacao->hash_validacao,
            "senha" => "Audittei2024!"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => Mensagens::CODIGO_VERIFICACAO_EXPIROU->value ]);
    }
    
    #[TestDox("Redefinição de senha com senha insuficiente")]
    public function test_solicitacao_alteracao_senha_com_senha_insuficiente(): void
    {
        $usuario = UsuarioService::ObterUsuarioPorEmail("fernandoavilajunior@gmail.com");

        ValidacaoService::GerarCodigoValidacao($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);

        $response = $this->postJson('/api/auth/redefinir-senha', [
            "hash" => "123123",
            "senha" => "Audi"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => self::PrepararMensagem(MensagensValidacao::VALIDACAO_SENHA_MIN, 8) ]);
    }
    
    #[TestDox("Redefinição de senha com senha maior")]
    public function test_solicitacao_alteracao_senha_com_senha_maior(): void
    {
        $usuario = UsuarioService::ObterUsuarioPorEmail("fernandoavilajunior@gmail.com");

        ValidacaoService::GerarCodigoValidacao($usuario, TipoCodigoValidacao::REDEFINIR_SENHA);

        $response = $this->postJson('/api/auth/redefinir-senha', [
            "hash" => "123123",
            "senha" => "Audasdasdasdasdsadasdsdasdasdasdasdasdasdi"
        ]);

        $response
            ->assertStatus(500)
            ->assertJson([ 'message' => self::PrepararMensagem(MensagensValidacao::VALIDACAO_SENHA_MAX, 30) ]);
    }
}
