<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $primaryKey = ['user_id', 'produto_id'];
    public $incrementing = 'false';
    protected $fillable = [
        'produto_id', 'qtde', 'imagem', 'preco_unitario', 'preco_total'
    ];
}
