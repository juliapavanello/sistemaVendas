<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;
    protected $fillable = [
        'fonte',
        'tipo',
        'dinheiro',
        'usuario_id',
        'venda_id',
        'produto_id'
    ];
}
