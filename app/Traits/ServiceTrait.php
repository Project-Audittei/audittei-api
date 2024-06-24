<?php

namespace App\Traits;

trait ServiceTrait {
    public static function Salvar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new \Exception("Não foi possível salvar a entidade.");
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public static function Deletar($entidade) {
        return $entidade->delete();
    }

    public static function Editar($entidade) {
        try {
            if( $entidade->save() ) {
                return true;
            } throw new \Exception("Não foi possível editar a entidade.");
            
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}