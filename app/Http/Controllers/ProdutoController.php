<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function lista(){

        $produtos = Produto::all();

        return view('index')->with('produtos',$produtos);

    }
    public function mostrar($id){
        
        $produto = DB::select('select * from produtos where id = ?', [$id]);

        if(empty($produto)){
            return "Esse produto não existe";
          }
          
        return view('buscar')->with('p',$produto);

    }
}
