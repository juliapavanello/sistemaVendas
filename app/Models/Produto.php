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
        'custo',
        'quantidade',
        'unidade',
        'avisoLeve',
        'avisoGrave',
        'descontarCaixa',
        'descontarEstoque',
        'paraVenda',
    ];
}
