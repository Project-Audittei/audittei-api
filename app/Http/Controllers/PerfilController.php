<?php

namespace App\Http\Controllers;

use App\Exceptions\PerfilNaoEncontradoException;
use App\Models\Perfil;
use App\Services\PerfilService;
use App\Traits\ConsumirAPITrait;
use App\Traits\EnviarResponseTrait;
use App\Traits\ObterUsuarioLogadoTrait;
use App\Validation\PerfilValidation;
use Illuminate\Http\Request;

use function App\Helpers\GerarGUID;

class PerfilController extends Controller
{
    use EnviarResponseTrait, ObterUsuarioLogadoTrait, ConsumirAPITrait;

    public static function CadastrarPerfil(Request $request)
    {
        $perfil = new Perfil($request->validate([
            'cnpj' => 'required',
            'razaoSocial' => 'required',
            'telefone' => 'required|min:10|max:11',
            'email' => 'required|email',
            'cep' => 'required',
            'logadouro' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ], PerfilValidation::ValidationParams()));

        $perfil->guid = GerarGUID();

        $usuario = self::ObterUsuarioLogado($request);
        // $usuario = $request->user();
        PerfilService::SalvarPerfil($perfil);

        if (PerfilService::VincularPerfilAoUsuario($perfil, $usuario)) {
            return self::EnviarResponse(
                content: $perfil,
                statusCode: 201,
                message: "Perfil criado com sucesso!"
            );
        }

        return self::EnviarResponse(
            content: $perfil,
            statusCode: 201,
            message: "Perfil criado com sucesso!"
        );
    }

    public static function ObterPerfisUsuario(Request $request)
    {
        $usuario = self::ObterUsuarioLogado($request);
        return self::EnviarResponse($usuario->perfis);
    }

    public static function ObterUsuariosDoPerfil(Request $request)
    {
        $request->validate([
            'perfil_id' => 'required'
        ]);

        $perfil = Perfil::where('guid', $request->perfil_id)->first();

        if (!$perfil) throw new PerfilNaoEncontradoException();

        return self::EnviarResponse($perfil->usuarios);
    }

    public static function ObterCNPJ(Request $request)
    {
        $request->validate([
            'cnpj' => 'required'
        ]);

        $api_key = env('CNPJ_API_KEY');
        $url = "https://comercial.cnpj.ws/cnpj/$request->cnpj?token=$api_key";

        $dados = self::ObterDaAPI($url);

        $empresa = [
            "razaoSocial" => $dados["razao_social"],
            "cep" => $dados["estabelecimento"]["cep"],
            "logadouro" => $dados["estabelecimento"]["tipo_logradouro"] . " " . $dados["estabelecimento"]["logradouro"] . " " . $dados["estabelecimento"]["numero"],
            "bairro" => $dados["estabelecimento"]["bairro"],
            "cidade" => $dados["estabelecimento"]["cidade"]["nome"],
            "estado" => $dados["estabelecimento"]["estado"]["sigla"],
        ];

        return self::EnviarResponse($empresa);
    }
}
