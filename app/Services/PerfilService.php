<?php

namespace App\Services;

use App\Models\Perfil;
use App\Models\User;

class PerfilService extends Service {
    public static function SalvarPerfil(Perfil $perfil) {
        return self::Salvar($perfil);
    }

    public static function ObterListaPerfilUsuario(User $usuario) {
        return $usuario->perfis()->toArray();
    }

    public static function ObterPerfilPorID(string $guid) {
        return Perfil::where('guid', $guid)->first();
    }

    public static function VincularPerfilAoUsuario(Perfil $perfil, User $usuario) {
        return $perfil->usuarios()->attach($usuario);
    }
}