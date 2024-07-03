<?php

namespace App\Helpers;

function GerarCNPJ()
{
    // Gera os 12 primeiros dígitos do CNPJ (raiz e filial)
    $cnpj = [];
    for ($i = 0; $i < 8; $i++) {
        $cnpj[] = rand(0, 9);
    }
    // Adiciona os 4 dígitos da filial
    $cnpj[] = 0;
    $cnpj[] = 0;
    $cnpj[] = 0;
    $cnpj[] = 1;

    // Calcula o primeiro dígito verificador
    $weights = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $sum = 0;
    for ($i = 0; $i < 12; $i++) {
        $sum += $cnpj[$i] * $weights[$i];
    }
    $firstDV = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
    $cnpj[] = $firstDV;

    // Calcula o segundo dígito verificador
    $weights = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $sum = 0;
    for ($i = 0; $i < 13; $i++) {
        $sum += $cnpj[$i] * $weights[$i];
    }
    $secondDV = $sum % 11 < 2 ? 0 : 11 - ($sum % 11);
    $cnpj[] = $secondDV;

    // Formata o CNPJ
    return sprintf(
        '%d%d%d%d%d%d%d%d%d%d%d%d%d%d',
        $cnpj[0], $cnpj[1], $cnpj[2], $cnpj[3], $cnpj[4], $cnpj[5], $cnpj[6], $cnpj[7],
        $cnpj[8], $cnpj[9], $cnpj[10], $cnpj[11], $cnpj[12], $cnpj[13]
    );
}