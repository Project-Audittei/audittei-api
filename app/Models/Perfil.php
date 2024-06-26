<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfis';
    protected $primaryKey = 'guid';
    public $incrementing = false;

    protected $fillable = [
        'guid',
        'cnpj',
        'razaoSocial',
        'telefone',
        'email',
        'cep',
        'logadouro',
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
        return $this->belongsToMany(User::class, 'perfil_user', 'perfil_guid', 'usuario_guid');
    }

}
