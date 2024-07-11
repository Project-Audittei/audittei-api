<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escritorio extends Model
{
    use HasFactory;

    protected $table = 'escritorios';
    protected $primaryKey = 'guid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'guid',
        'cnpj',
        'razaoSocial',
        'telefone',
        'email',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'pivot'
    ];

    public function usuarios() {
        return $this->hasMany(User::class, 'escritorio_id');
    }

    public function empresas() {
        return $this->hasMany(Empresa::class, 'escritorio_id');
    }
}
