<?php

namespace App\Repository;

use App\Exceptions\ExcecaoBasica;
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Language\Mensagens;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioRepository extends Repository {
    public function __construct()
    {
        $this->model = new User();
    }

    public function AtualizarTelefonePorGUID(string $guid, string $telefone) {
        if($this->VerificarSeTelefoneMudou($telefone)) {
            if($this->VerificarSeTelefoneExiste($telefone)) throw new ExcecaoBasica(Mensagens::USUARIO_TELEFONE_EXISTENTE);
        }

        $usuario = $this->ObterPorGUID($guid);
    
        if(!$usuario) throw new UsuarioNaoEncontradoException();

        $usuario->telefone = $telefone;
        $this->salvar($usuario);

        return true;
    }
    
    public function AtualizarNomePorGUID(string $guid, string $nome) {
        $usuario = $this->ObterPorGUID($guid);
    
        if(!$usuario) throw new UsuarioNaoEncontradoException();

        $usuario->nomeCompleto = $nome;
        $this->salvar($usuario);

        return true;
    }

    public function AtualizarSenhaPorGUID(string $guid, string $senha) {
        $usuario = $this->ObterPorGUID($guid);

        if(!$usuario) throw new UsuarioNaoEncontradoException();

        $usuario->senha = Hash::make($senha);
        $this->salvar($usuario);

        return true;
    }

    public function VerificarSeTelefoneExiste(string $telefone) : bool {
        $usuario = $this->model::where('telefone', $telefone)->first();

        return !is_null($usuario);
    }

    public function VerificarSeTelefoneMudou(string $telefone) : bool {
        $usuario = request()->user();

        return $usuario->telefone != $telefone;
    }
}