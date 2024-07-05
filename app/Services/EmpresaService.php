<?php

namespace App\Services;

use App\Models\Empresa;
use App\Models\Escritorio;

class EmpresaService extends Service {
    public function SalvarEmpresa(Empresa $empresa) {
        $empresa->save();
        return $empresa;
    }

    public function VincularEscritorioAEmpresa(Empresa $empresa, Escritorio $escritorio)
    {
        return $empresa->escritorio()->associate($escritorio);
    }
}