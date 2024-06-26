<?php

namespace App\Traits;

use App\Exceptions\UsuarioNaoAutenticadoException;
use Illuminate\Http\Request;

trait ObterUsuarioLogadoTrait {
    public static function ObterUsuarioLogado(Request $request) {
        $usuario = $request->user();        
        if(!$usuario) throw new UsuarioNaoAutenticadoException();

        return $usuario;
    }
}