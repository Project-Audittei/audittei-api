<?php

namespace App\Http\Controllers;

use App\Mail\EmailValidacaoConta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function EnviarEmailConfirmacaoConta(User $usuario, string $hash) {
        self::_enviarEmail($usuario->email, new EmailValidacaoConta($usuario->nomeCompleto, $hash));
        
        return true;
    }


    private static function _enviarEmail(string $destinatario, Mailable $mail) {
        $isDebug = env("ENVIRONMENT");

        if($isDebug != "debug") {
            Mail::to($destinatario)->send($mail);
        }

        return true;
    }
}
