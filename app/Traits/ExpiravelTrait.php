<?php

namespace App\Traits;

trait ExpiravelTrait {
    private static function _obterDataExpiracao() {
        $currentDate = new \DateTime();

        return $currentDate->add(new \DateInterval('PT2H'))->format('Y-m-d H:i:s');
    }

    private static function _checarValidateHash($expires) {
        if($expires > new \DateTime()) throw new \Exception('Código de validação expirado.');
    }
}