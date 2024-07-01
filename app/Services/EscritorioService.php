<?php

namespace App\Services;

use App\Models\Escritorio;
use App\Models\Perfil;
use App\Models\User;

class EscritorioService extends Service {
    public static function ObterListaPerfilUsuario(User $usuario) {
        return $usuario->perfis()->toArray();
    }

    public static function ObterEscritorioPorID(string $guid) {
        return Escritorio::where('guid', $guid)->first();
    }
  
    public static function ObterEscritorioPorCNPJ(string $cnpj) {
        return Escritorio::where('cnpj', $cnpj)->first();
    }

    public static function VincularEscritorioAoUsuario(Escritorio $escritorio, User $usuario) {
        return UsuarioService::VincularUsuarioAoEscritorio($usuario, $escritorio);
    }
    
    public static function SalvarEscritorio(Escritorio $escritorio) {
        $escritorio->save();
        return $escritorio;
    }
}