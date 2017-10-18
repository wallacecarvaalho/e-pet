<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{

    protected $fillable = [
        'user_id',
        'status'
    ];

    public function carrinho_produtos(){
        return $this->hasMany('App\CarrinhoProduto') //1:N , um pedido, vários produtos
            ->select( \DB::raw('produto_id, sum(valor) as valores, count(1) as qtd'))
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'desc');
    }

    public static function consultaId($where){
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
