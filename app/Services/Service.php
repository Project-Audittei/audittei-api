<?php

namespace App\Services;

use App\Exceptions\ExcecaoBasica;
use App\Language\Mensagens;

abstract class Service {
    protected static function Salvar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new ExcecaoBasica(Mensagens::GENERICO_ERRO_SALVAR_ENTIDADE);
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    protected static function Deletar($entidade) {
        return $entidade->delete();
    }

    protected static function Editar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new ExcecaoBasica(Mensagens::GENERICO_ERRO_EDITAR_ENTIDADE);
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}