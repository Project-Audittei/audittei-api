<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\PerfilNaoEncontradoException;
use App\Language\Mensagens;
use App\Models\Perfil;
use App\Services\CNPJService;
use App\Services\PerfilService;
use App\Traits\EnviarResponseTrait;
use App\Validation\PerfilValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class PerfilController extends Controller
{
    #[ValidarRequest(PerfilValidation::class, 'CadastroParametros')]
    public static function CadastrarPerfil(Request $request)
    {
        $perfil = new Perfil($request->json()->all());
        $perfil->guid = GerarGUID();
        $usuario = $request->user();
        PerfilService::SalvarPerfil($perfil);

        if (PerfilService::VincularPerfilAoUsuario($perfil, $usuario)) {
            return self::EnviarResponse(
                content: $perfil,
                statusCode: 201,
                message: Mensagens::PERFIL_CADASTRO_SUCESSO->value
            );
        }
    }

    public static function ObterPerfisUsuario(Request $request)
    {
        return self::EnviarResponse(content: $request->user()->perfis);
    }

    #[ValidarRequest(PerfilValidation::class, 'UsuariosDoPerfil')]
    public static function ObterUsuariosDoPerfil(Request $request)
    {
        $perfil = PerfilService::ObterPerfilPorID($request->perfil_id);

        if (!$perfil) throw new PerfilNaoEncontradoException();

        return self::EnviarResponse($perfil->usuarios);
    }

    #[ValidarRequest(PerfilValidation::class, 'CNPJConsultaParametros')]
    public static function ObterCNPJ(Request $request)
    {
        return self::EnviarResponse(CNPJService::ObterDadosEmpresa($request->cnpj));
    }
}
