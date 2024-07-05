<?php

namespace App\Helpers;

function ValidarCNPJ($cnpj) {
    // Remove qualquer caractere que não seja número
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Verifica se o CNPJ tem 14 dígitos
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Elimina CNPJs conhecidos que são inválidos
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Validação dos dígitos verificadores
    for ($t = 12; $t < 14; $t++) {
        $d = 0;
        $c = 0;
        for ($i = 0, $p = $t - 7; $i < $t; $i++, $p--) {
            $d += $cnpj[$i] * ($p < 2 ? $p + 9 : $p);
        }
        $d = (($d % 11) < 2) ? 0 : (11 - ($d % 11));
        if ($cnpj[$t] != $d) {
            return false;
        }
    }

    return true;
}