<?php

namespace App\Services;

use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Models\Empresa;
use App\Models\Escritorio;
use App\Models\User;

class EscritorioService extends Service {
    public function __construct(
        private ?EmpresaService $empresaService = null
    ) {}
    
    public function ObterListaPerfilUsuario(User $usuario) {
        return $usuario->perfis()->toArray();
    }

    public function ObterEscritorioPorID(string $guid) {
        return Escritorio::where('guid', $guid)->first();
    }
  
    public function ObterEscritorioPorCNPJ(string $cnpj) {
        return Escritorio::where('cnpj', $cnpj)->first();
    }

    public function VincularEscritorioAoUsuario(Escritorio $escritorio, User $usuario) {
        return UsuarioService::VincularUsuarioAoEscritorio($usuario, $escritorio);
    }
    
    public function SalvarEscritorio(Escritorio $escritorio) {
        $escritorio->save();
        return $escritorio;
    }

    public function AtualizarEscritorio(Escritorio $entidade) {
        $escritorio = $this->ObterEscritorioPorID(request()->user()->escritorio->guid);

        $escritorio->telefone = $entidade->telefone;
        $escritorio->email = $entidade->email;
        // $escritorio->cep = $entidade->cep;
        // $escritorio->logradouro = $entidade->logradouro;
        // $escritorio->bairro = $entidade->bairro;
        // $escritorio->cidade = $entidade->cidade;
        // $escritorio->numero = $entidade->numero;
        $escritorio->complemento = $entidade->complemento;
        // $escritorio->uf = $entidade->uf;

        $escritorio = $this->SalvarEscritorio($escritorio);

        return $escritorio;
    }

    public function ObterEmpresas() {
        $usuario = request()->user();
        return $usuario->escritorio->empresas;
    }
}