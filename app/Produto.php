<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    //protected $primaryKey = 'produto_id';

    protected $fillable = [
        'name', 'descricao', 'preco', 'imagem', 'qtd', 'categoria', 'status'
    ];

    public function statusEstoque(){
        
        return $this->hasOne(Estoque::class);
        
    }

}
