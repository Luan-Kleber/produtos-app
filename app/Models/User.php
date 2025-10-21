<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    // Defina os campos permitidos para mass assignment
    protected $fillable = [
        'username',
        'password',
        'nome',
        'email',
        'cpf',
        'ativo',
    ];

    // Esconder campos sensíveis na resposta JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Implementação obrigatória do JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
