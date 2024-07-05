<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
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
    public function CadastroEmpresa(Request $request)
    {    
        $empresa = new Empresa($request->json()->all());
        $empresa->guid = GerarGUID();

        $usuario = $request->user();
        
        if( !$usuario->escritorio ) throw new ExcecaoBasica(MensagensValidacao::VALIDACAO_ESCRITORIO_OBRIGATORIO);

        $this->empresaService->VincularEscritorioAEmpresa($empresa, $usuario->escritorio);
        $empresa = $this->empresaService->SalvarEmpresa($empresa);


        return self::EnviarResponse(
            content: [ $empresa ],
            message: Mensagens::EMPRESA_CADASTRO_SUCESSO->value
        );
    }
}
