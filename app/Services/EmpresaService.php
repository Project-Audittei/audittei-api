<?php

namespace App\Services;

use App\Models\Empresa;

class EmpresaService extends Service {
    public function SalvarEmpresa(Empresa $empresa) {
        $empresa = $empresa->save();

        return $empresa;
    }
}