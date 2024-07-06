<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\EscritorioNaoEncontradoException;
use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Models\Escritorio;
use App\Services\CNPJService;
use App\Services\EscritorioService;
use App\Validation\EscritorioValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class EscritorioController extends Controller
{
    public function __construct(
        private EscritorioService $escritorioService
    ) { }

    #[ValidarRequest(EscritorioValidation::class, 'CadastroEscritorio')]
    public function CadastrarEscritorio(Request $request)
    {
        $escritorio = new Escritorio($request->json()->all());
        $usuario = $request->user();

        if (!$this->escritorioService->ObterEscritorioPorCNPJ($escritorio->cnpj)) {
            $escritorio->guid = GerarGUID();
            $escritorio = $this->escritorioService->SalvarEscritorio($escritorio);
        } else {
            $escritorio = $this->escritorioService->ObterEscritorioPorCNPJ($escritorio->cnpj);
        }

        $this->escritorioService->VincularEscritorioAoUsuario($escritorio, $usuario);

        return self::EnviarResponse(
            content: $escritorio,
            statusCode: 201,
            message: Mensagens::ESCRITORIO_CADASTRO_SUCESSO->value
        );
    }

    #[ValidarRequest(EscritorioValidation::class, 'EditarEscritorio')]
    public function EditarEscritorio(Request $request)
    {
        if(!$this->escritorioService->ObterEscritorioPorID($request->guid)) throw new EscritorioNaoEncontradoException();

        $dados = [
            "telefone" => $request->telefone,
            "email" => $request->email,
            "cep" => $request->cep,
            "logradouro" => $request->logradouro,
            "bairro" => $request->bairro,
            "cidade" => $request->cidade,
            "uf" => $request->uf
        ];

        if($this->escritorioService->AtualizarEscritorio($request->guid, $dados)) {
            return self::EnviarResponse(message: Mensagens::ESCRITORIO_ATUALIZADO_SUCESSO->value);
        } else {
            return self::EnviarResponse(message: Mensagens::ESCRITORIO_ATUALIZADO_ERRO->value, statusCode: 500, success: false);
        }
    }

    public function ObterEscritorioUsuario(Request $request)
    {
        return self::EnviarResponse(content: $request->user()->escritorio);
    }

    #[ValidarRequest(EscritorioValidation::class, 'UsuariosDoEscritorio')]
    public function ObterUsuariosDoEscritorio(Request $request)
    {
        $escritorio = $this->escritorioService->ObterEscritorioPorID($request->escritorio_id);

        if (!$escritorio) throw new EscritorioNaoEncontradoException();

        return self::EnviarResponse($escritorio->usuarios);
    }

    public function ObterEmpresasDoEscritorio(Request $request)
    {
        return self::EnviarResponse(
            content: $this->escritorioService->ObterEmpresas()
        );
    }

    #[ValidarRequest(EscritorioValidation::class, 'CNPJConsultaParametros')]
    public function ObterCNPJ(Request $request)
    {
        return self::EnviarResponse(CNPJService::ObterDadosEmpresa($request->cnpj));
    }
}
