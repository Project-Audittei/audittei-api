<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'guid';
    public $increment = false;

    protected $fillable = [
        'guid',
        'cnpj',
        'razaoSocial',
        'nomeFantasia',
        'responsavelLegal',
        'email',
        'telefone',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'numero',
        'complemetno',
        'uf'
    ];
}
