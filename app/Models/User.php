<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'guid';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'guid',
        'nomeCompleto',
        'email',
        'senha',
        'telefone',
        'email_verified_at',
        'escritorio_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha',
        'remember_token',
        'updated_at',
        'created_at',
        'escritorio_id',
        'email_verified_at',
        'pivot'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('escritorio', function (Builder $builder) {
            $builder->with('escritorio');
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'senha' => 'hashed',
        ];
    }

    protected static function newFactory() {
        return UserFactory::new();
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];   
    }

    public function escritorio() {
        return $this->belongsTo(Escritorio::class, 'escritorio_id', 'guid');
    }
}
