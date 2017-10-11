<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $primaryKey = 'id_produto';

     protected $fillable = [
        'name','descricao','preco','imagem'
    ];

    public function statusEstoque(){
        
        return $this->hasOne(Estoque::class);

    }

}
