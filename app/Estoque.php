<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{

    protected $table = 'estoque';
    
    protected $fillable = [
        'status','qtd'
    ];


    public function produto(){
        return $this->belongsTo(Produto::class);
    }
}
