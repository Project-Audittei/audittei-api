<?php

namespace App\Helpers;

function GenerateConfirmationCode($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $confirmationCode = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, $charactersLength - 1);
        $confirmationCode .= $characters[$randomIndex];
    }

    return $confirmationCode;
}