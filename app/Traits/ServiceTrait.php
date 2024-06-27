<?php

namespace App\Traits;

use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;

trait ServiceTrait {
    private static function Salvar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new ExcecaoBasica(Mensagens::GENERICO_ERRO_SALVAR_ENTIDADE);
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private static function Deletar($entidade) {
        return $entidade->delete();
    }

    private static function Editar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new ExcecaoBasica(Mensagens::GENERICO_ERRO_EDITAR_ENTIDADE);
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}