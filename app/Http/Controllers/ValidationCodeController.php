<?php

namespace App\Http\Controllers;

use App\Constants\TipoCodigoValidacao;
use App\Models\User;
use App\Models\ValidationControl;
use App\Traits\ExpiravelTrait;
use DateTime;
use Illuminate\Support\Facades\DB;

use function App\Helpers\GenerateConfirmationCode;

class ValidationCodeController extends Controller
{
    use ExpiravelTrait;

    public static function ValidarConta(string $hash) {
        try {
            DB::beginTransaction();

            $validacao = ValidacaoController::ObterValidacao($hash, TipoCodigoValidacao::CONFIRMAR_CONTA);

            $usuario = UsuarioController::ObterUsuarioPorGuid($validacao->guid_usuario);
            $usuario->email_verified_at = new DateTime();
            $usuario->save();

            $validacao->delete();
            DB::commit();

            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public static function AtualizarCodigoValidacao(string $guid) {
        try {
            DB::beginTransaction();
            $validacao = ValidationControl::where('guid_usuario', $guid)->first();

            $validacao->hash_validacao = GenerateConfirmationCode();
            $validacao->expires = ValidationCodeController::_obterDataExpiracao();
            
            $validacao->save();

            DB::commit();

            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
