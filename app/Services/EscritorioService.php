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

    public function AtualizarEscritorio(string $guid, array $dados = []) {
        if(empty($dados)) throw new ExcecaoBasica(Mensagens::GENERICO_ERRO_PARAMETRO_VAZIO);

        if(Escritorio::where('guid', $guid)->update($dados)) {
            return true;
        }

        return false;
    }

    public function ObterEmpresas() {
        $usuario = request()->user();
        return $usuario->escritorio->empresas;
    }
}