<?php

namespace App\Http\Controllers;

use App\Attributes\ValidarRequest;
use App\Exceptions\PerfilNaoEncontradoException;
use App\Models\Perfil;
use App\Services\PerfilService;
use App\Traits\ConsumirAPITrait;
use App\Traits\EnviarResponseTrait;
use App\Validation\PerfilValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class PerfilController extends Controller
{
    use EnviarResponseTrait, ConsumirAPITrait;

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
                message: "Perfil criado com sucesso!"
            );
        }
    }

    public static function ObterPerfisUsuario(Request $request)
    {
        $usuario = $request->user();
        return self::EnviarResponse($usuario->perfis);
    }

    #[ValidarRequest(PerfilValidation::class, 'UsuariosDoPerfil')]
    public static function ObterUsuariosDoPerfil(Request $request)
    {
        $perfil = Perfil::where('guid', $request->perfil_id)->first();

        if (!$perfil) throw new PerfilNaoEncontradoException();

        return self::EnviarResponse($perfil->usuarios);
    }

    #[ValidarRequest(PerfilValidation::class, 'CNPJConsultaParametros')]
    public static function ObterCNPJ(Request $request)
    {
        $api_key = env('CNPJ_API_KEY');
        $url = "https://comercial.cnpj.ws/cnpj/$request->cnpj?token=$api_key";

        $dados = self::ObterDaAPI($url);

        $empresa = [
            "razaoSocial" => $dados["razao_social"],
            "cep" => $dados["estabelecimento"]["cep"],
            "logadouro" =>  $dados["estabelecimento"]["tipo_logradouro"] . " " . 
                            $dados["estabelecimento"]["logradouro"] . " " . 
                            $dados["estabelecimento"]["numero"],
            "bairro" => $dados["estabelecimento"]["bairro"],
            "cidade" => $dados["estabelecimento"]["cidade"]["nome"],
            "estado" => $dados["estabelecimento"]["estado"]["sigla"],
        ];

        return self::EnviarResponse($empresa);
    }
}
