<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $primaryKey = 'guid';
    protected $keyType = 'string';
    public $incrementing = false;

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
        'complemento',
        'uf',
        'escritorio_id'
    ];

    protected $hidden = [
        'updated_at',
        'escritorio_id'
    ];

    protected $casts = [
        'created_at' => 'date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('escritorio', function (Builder $builder) {
            if (request()->is('api/empresa*')) {
                $builder->with('usuarios');
            }
        });
    }

    public function escritorio() {
        return $this->belongsTo(Escritorio::class, 'escritorio_id', 'guid');
    }

    public function usuarios() {
        return $this->belongsToMany(User::class, 'empresa_usuario', 'empresa_guid', 'usuario_guid');
    }

    public function associarEscritorio(Escritorio $escritorio) {
        return $this->escritorio()->associate($escritorio);
    }

    public function associarUsuario(User $usuario) {
        return $this->usuarios()->attach($usuario->guid);
    }
    
    public function desassociarUsuario(User $usuario) {
        return $this->usuarios()->detach($usuario->guid);
    }
}
