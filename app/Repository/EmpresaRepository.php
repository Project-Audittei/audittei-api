<?php

namespace App\Repository;

use App\Models\Empresa;
use App\Models\Escritorio;

class EmpresaRepository extends Repository {
    public function __construct()
    {
        $this->model = new Empresa();
    }

    public function VerificaSeEscritorioGerenciaEmpresa(Empresa $empresa) : bool {
        return $this->model::where('escritorio_id', $empresa->escritorio->guid)
                            ->where('cnpj', $empresa->cnpj)
                            ->first() != null;
    }
}