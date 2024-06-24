<?php

namespace App\Models;

use App\Constants\TipoCodigoValidacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationControl extends Model
{
    use HasFactory;

    protected $table = 'hash_verificacao';
    public $timestamps = false;

    protected $fillable = [
        'guid_usuario',
        'hash_validacao',
        'tipo',
        'validation_validate'
    ];

    protected $casts = [
        'tipo' => TipoCodigoValidacao::class
    ];
}
