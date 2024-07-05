<?php

namespace App\Services;

use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Models\Empresa;
use App\Models\Escritorio;
use App\Models\User;
use App\Repository\EmpresaRepository;

class EmpresaService extends Service {

    public function __construct(
        private EmpresaRepository $repositorio
    ) {}

    public function SalvarEmpresa(Empresa $empresa) {
        if($this->repositorio->VerificaSeEscritorioGerenciaEmpresa($empresa)) {
            throw new ExcecaoBasica(Mensagens::EMPRESA_CADASTRO_EXISTENTE);
        }

        $empresa = $this->repositorio->salvar($empresa);

        return $empresa;
    }

    public function AdicionarUsuarioAEmpresa(Empresa $empresa, User $usuario) {
        $empresa->associarUsuario($usuario);
        return $empresa->save();
    }

    public function RemoverUsuarioAEmpresa(Empresa $empresa, User $usuario) {
        $empresa->desassociarUsuario($usuario);
        return $empresa->save();
    }

    public function ObterUsuariosEmpresaPorGUID(string $guid) {
        $empresa = $this->repositorio->ObterPorGUID($guid);

        return $empresa->usuarios;
    }

    public function ObterEmpresaPorGUID(string $guid) {
        return $this->repositorio->ObterPorGUID($guid);
    }
}