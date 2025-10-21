<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade_estoque',
    ];

    protected $primaryKey = 'nome';

    // Como o nome não é um número e não é auto-incremental:
    public $incrementing = false;
    protected $keyType = 'string';
}
