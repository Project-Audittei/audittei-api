<?php

namespace App\Http\Controllers;

use App\Constants\TipoCodigoValidacao;
use App\Models\ResetSenha;
use App\Traits\ExpiravelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\GenerateConfirmationCode;

class ResetSenhaController extends Controller
{
    use ExpiravelTrait;

    public static function GerarCodigoAlteracaoSenha(string $email) {
        try {
            $usuario = UsuarioController::ObterUsuarioPorEmail($email);
            
            DB::beginTransaction();

            ValidacaoController::GerarCodigoValidacao($usuario->guid, TipoCodigoValidacao::REDEFINIR_SENHA);

            DB::commit();

            return true;        
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public static function AlterarSenha(string $hash, string $senha) {
        $reset = ValidacaoController::ObterValidacao($hash, TipoCodigoValidacao::REDEFINIR_SENHA);

        if(!$reset) throw new \Exception("Nenhuma solicitação de redefinição de senha foi encontrada com o código fornecido.");

        self::_checarValidateHash($reset->expires);

        $usuario = UsuarioController::ObterUsuarioPorGuid($reset->guid_usuario);
        $usuario->senha = Hash::make($senha);
        $usuario->save();

        $reset->delete();
    }
}
