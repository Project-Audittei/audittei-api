<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escritorio extends Model
{
    use HasFactory;

    protected $table = 'escritorios';
    protected $primaryKey = 'guid';
    public $incrementing = false;

    protected $fillable = [
        'guid',
        'cnpj',
        'razaoSocial',
        'telefone',
        'email',
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'estado'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'pivot'
    ];

    public function usuarios() {
        return $this->hasMany(User::class);
    }

}
