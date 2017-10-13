<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{


    protected $table = 'estoques';
    protected $primaryKey = 'produto_id';
    protected $fillable = [
        'status','qtd'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
