<?php

namespace App\Http\Controllers;

use App\Constants\TipoCodigoValidacao;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\GerarGUID;

class UsuarioController extends Controller
{
    public static function CadastrarUsuario(User $usuario)
    {
        try {
            DB::beginTransaction();

            if(User::where('email', $usuario['email'])->first()) {
                throw new \Exception("Email já cadastrado.");
            }

            if(User::where('telefone', $usuario['telefone'])->first()) {
                throw new \Exception("Telefone já cadastrado.");
            }

            $usuario->guid = GerarGUID();
            $usuario->save();
            
            $hash = ValidacaoController::GerarCodigoValidacao($usuario->guid, TipoCodigoValidacao::CONFIRMAR_CONTA);

            EmailController::EnviarEmailConfirmacaoConta($usuario, $hash);

            DB::commit();
            return $usuario;

        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public static function Login($usuario = [])
    {
        $credentials = [
            'email' => $usuario['email'],
            'password' => $usuario['senha']
        ];

        if (!$token = auth()->attempt($credentials)) {
            return null;
        }

        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 2
        ];
    }

    public static function AlterarSenha(string $hash, string $senha) {
        try {
            DB::beginTransaction();

            $validacao = ValidacaoController::ObterValidacao($hash, TipoCodigoValidacao::REDEFINIR_SENHA);

            $usuario = self::ObterUsuarioPorGuid($validacao->guid_usuario);
            $usuario->senha = Hash::make($senha);
            $usuario->save();

            $validacao->delete();
            
            DB::commit();

            return true;
        } catch(\Exception $ex) {
            DB::rollBack();

            throw $ex;
        }        
    }

    public static function ObterUsuarioPorGuid(string $guid) {
        return User::where('guid', $guid)->first();
    }

    public static function ObterUsuarioPorEmail(string $email) {
        return User::where('email', $email)->first();
    }
}
