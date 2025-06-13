<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;

    protected $table = 'produto_venda';

    protected $fillable = [
        'quantidade',
        'produto_id',
        'venda_id'
    ];
}
