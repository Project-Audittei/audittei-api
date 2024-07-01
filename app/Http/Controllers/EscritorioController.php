<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\EscritorioNaoEncontradoException;
use App\Language\Mensagens;
use App\Models\Escritorio;
use App\Services\CNPJService;
use App\Services\EscritorioService;
use App\Validation\EscritorioValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class EscritorioController extends Controller
{
    #[ValidarRequest(EscritorioValidation::class, 'CadastroEscritorio')]
    public static function CadastrarEscritorio(Request $request)
    {
        $escritorio = new Escritorio($request->json()->all());
        $usuario = $request->user();

        if(!EscritorioService::ObterEscritorioPorCNPJ($escritorio->cnpj)) {
            $escritorio->guid = GerarGUID();
            $escritorio = EscritorioService::SalvarEscritorio($escritorio);
        } else {
            $escritorio = EscritorioService::ObterEscritorioPorCNPJ($escritorio->cnpj);
        }

        EscritorioService::VincularEscritorioAoUsuario($escritorio, $usuario);

        return self::EnviarResponse(
            content: $escritorio,
            statusCode: 201,
            message: Mensagens::ESCRITORIO_CADASTRO_SUCESSO->value
        );
    }

    public static function ObterEscritorioUsuario(Request $request)
    {
        return self::EnviarResponse(content: $request->user()->perfis);
    }

    #[ValidarRequest(EscritorioValidation::class, 'UsuariosDoEscritorio')]
    public static function ObterUsuariosDoEscritorio(Request $request)
    {
        $escritorio = EscritorioService::ObterEscritorioPorID($request->escritorio_id);

        if (!$escritorio) throw new EscritorioNaoEncontradoException();

        return self::EnviarResponse($escritorio->usuarios);
    }

    #[ValidarRequest(EscritorioValidation::class, 'CNPJConsultaParametros')]
    public static function ObterCNPJ(Request $request)
    {
        return self::EnviarResponse(CNPJService::ObterDadosEmpresa($request->cnpj));
    }
}
