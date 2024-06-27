<?php

namespace App\Services;

use App\Mail\EmailResetSenha;
use App\Mail\EmailValidacaoConta;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailService {
    public static function EnviarEmailConfirmacaoConta(User $usuario, string $hash) {
        return self::_enviarEmail($usuario->email, new EmailValidacaoConta($usuario->nomeCompleto, $hash));
    }
    
    public static function EnviarEmailResetSenha(User $usuario, string $hash) {
        return self::_enviarEmail($usuario->email, new EmailResetSenha($usuario->nomeCompleto, $hash));
    }


    private static function _enviarEmail(string $destinatario, Mailable $mail) {
        $isDebug = env("ENVIRONMENT");

        if($isDebug != "debug") {
            return Mail::to($destinatario)->send($mail);
        }

        return true;
    }
}