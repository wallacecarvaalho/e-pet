<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{

    //alterei de 'estoque' para 'estoques', pois a seeder não tava achando a tabela 'estoque'
    //11/10/2017
    protected $table = 'estoques';
    protected $primaryKey = 'produto_id';
    protected $fillable = [
        'status','qtd'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
