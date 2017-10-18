<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarrinhoProduto extends Model
{

    protected $fillable = [
        'carrinho_id',
        'produto_id',
        'status',
        'valor'
    ];

    public function produto(){
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }
}
