<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetSenha extends Model
{
    use HasFactory;

    protected $table = 'reset_senhas';

    protected $fillable = [
        'guid_usuario',
        'hash_verificacao',
        'validation_validate'
    ];
}
