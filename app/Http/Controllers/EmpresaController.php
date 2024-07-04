<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Language\Mensagens;
use App\Models\Empresa;
use App\Services\EmpresaService;
use App\Validation\EmpresaValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class EmpresaController extends Controller
{
    public function __construct(
        private EmpresaService $empresaService
    )
    {}

    #[ValidarRequest(EmpresaValidation::class, 'CadastroEmpresa')]
    public function CadastroEmpresa(Request $request) {
        
        $empresa = new Empresa($request->json()->all());
        $empresa->guid = GerarGUID();

        $this->empresaService->SalvarEmpresa($empresa);

        return self::EnviarResponse(
            content: [ $empresa ],
            message: Mensagens::EMPRESA_CADASTRO_SUCESSO->value
        );
    }
}
