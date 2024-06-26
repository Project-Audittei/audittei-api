<?php

namespace App\Services;

use App\Models\Perfil;
use App\Models\User;
use App\Traits\ServiceTrait;

class PerfilService {
    use ServiceTrait;

    public static function SalvarPerfil(Perfil $perfil) {
        return self::Salvar($perfil);
    }

    public static function ObterListaPerfilUsuario(User $usuario) {
        return $usuario->perfis()->toArray();
    }

    public static function VincularPerfilAoUsuario(Perfil $perfil, User $usuario) {
        return $perfil->usuarios()->attach($usuario);
    }
}