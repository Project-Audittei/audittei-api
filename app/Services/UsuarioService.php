<?php

namespace App\Services;

use App\Constants\TipoCodigoValidacao;
use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;
use App\Language\MensagensValidacao;
use App\Models\Escritorio;
use App\Models\User;
use App\Repository\UsuarioRepository;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function App\Helpers\GerarGUID;

class UsuarioService extends Service {

    public function __construct(
        private UsuarioRepository $repository
    ) {}

    public static function SalvarUsuario(User $usuario) {
        try {
            DB::beginTransaction();

            if(self::ObterUsuarioPorEmail($usuario['email'])) {
                throw new ExcecaoBasica(MensagensValidacao::VALIDACAO_EMAIL_EXISTENTE);
            }

            if(self::ObterUsuarioPorTelefone($usuario['telefone'])) {
                throw new ExcecaoBasica(MensagensValidacao::VALIDACAO_TELEFONE_EXISTENTE);
            }

            $usuario->guid = GerarGUID();
            
            if(self::Salvar($usuario)) {
                ValidacaoService::GerarCodigoValidacao($usuario, TipoCodigoValidacao::CONFIRMAR_CONTA);
                    
                DB::commit();
    
                return $usuario;
            }            

        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public static function AutenticarUsuario(string $email, string $senha) {
        if (!$token = auth()->attempt([
            'email' => $email,
            'password' => $senha
        ])) {
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

            $validacao = ValidacaoService::ObterValidacao($hash, TipoCodigoValidacao::REDEFINIR_SENHA);

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

    public static function ValidarConta(User $usuario) {
        $usuario->email_verified_at = new DateTime();

        return $usuario->save();
    }

    public static function ObterUsuarioPorGUID(string $guid) : User | null {
        return User::where('guid', $guid)->first();
    }

    public static function ObterUsuarioPorEmail(string $email) : User | null {
        return User::where('email', $email)->first();
    }

    public static function ObterUsuarioPorTelefone(string $telefone) : User | null {
        return User::where('telefone', $telefone)->first();
    }

    public static function VincularUsuarioAoEscritorio(User $usuario, Escritorio $escritorio) {
        $usuario->escritorio()->associate($escritorio);
        return $usuario->save();
    }

    public function AtualizarDadosCadastrais(string $nome = '', string $telefone = '') {
        $usuario = $this->ObterUsuarioLogado();

        if(!empty($nome)) {
            $this->repository->AtualizarNomePorGUID($usuario->guid, $nome);
        }

        if(!empty($telefone)) {
            $this->repository->AtualizarTelefonePorGUID($usuario->guid, $telefone);
        }

        return true;
    }

    public function AtualizarSenhaUsuario(string $novaSenha, string $senhaAtual) {
        $usuario = $this->ObterUsuarioLogado();

        if(!$this->ChecarSenhaUsuario($usuario, $senhaAtual)) throw new ExcecaoBasica(Mensagens::USUARIO_SENHA_INCORRETA);

        $this->repository->AtualizarSenhaPorGUID($usuario->guid, $novaSenha);

        return true;
    }

    private function ChecarSenhaUsuario(User $usuario, string $senha) : bool {
        return Hash::check($senha, $usuario->senha);
    }
}