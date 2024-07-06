<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Models\Empresa;
use App\Services\EmpresaService;
use App\Services\EscritorioService;
use App\Validation\EmpresaValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class EmpresaController extends Controller
{
    public function __construct(
        private EmpresaService $empresaService,
        private EscritorioService $escritorioService
    )
    {}

    #[ValidarRequest(EmpresaValidation::class, 'CadastroEmpresa')]
    public function CadastroEmpresa(Request $request)
    {    
        $empresa = new Empresa($request->json()->all());
        $empresa->guid = GerarGUID();

        $usuario = $request->user();
        if( !$usuario->escritorio ) throw new ExcecaoBasica(MensagensValidacao::VALIDACAO_ESCRITORIO_OBRIGATORIO);
        
        $empresa->associarEscritorio($usuario->escritorio);

        if($empresa = $this->empresaService->SalvarEmpresa($empresa)) {
            $this->empresaService->AdicionarUsuarioAEmpresa($empresa, $usuario);

            return self::EnviarResponse(
                statusCode: 201,
                content: [ $empresa ],
                message: Mensagens::EMPRESA_CADASTRO_SUCESSO->value
            );
        }

        return self::EnviarResponse(
            statusCode: 500,
            success: false,
            message: Mensagens::GENERICO_ERRO_SALVAR_ENTIDADE->value
        );
    }
    
    #[ValidarRequest(EmpresaValidation::class, 'AtualizarEmpresa')]
    public function AtualizarEmpresa(Request $request)
    {    
        return self::EnviarResponse(
            statusCode: 201,
            content: [ $this->empresaService->AtualizarEmpresa(new Empresa($request->json()->all())) ],
            message: Mensagens::EMPRESA_ATUALIZACAO_SUCESSO->value
        );
    }
    
    public function ObterUsuariosVinculadosAEmpresa(string $guid) {
        return self::EnviarResponse(
            content: [ $this->empresaService->ObterUsuariosEmpresaPorGUID($guid) ],
            message: Mensagens::GENERICO_CONSULTA_SUCESSO->value
        );
    }
    
    public function ObterEmpresa(string $guid) {
        return self::EnviarResponse(
            content: $this->empresaService->ObterEmpresaPorGUID($guid),
            message: Mensagens::GENERICO_CONSULTA_SUCESSO->value
        );
    }

    public function ObterTodasEmpresas() {
        return self::EnviarResponse(
            content: $this->escritorioService->ObterEmpresas(),
            message: Mensagens::GENERICO_CONSULTA_SUCESSO->value
        );
    }
}
