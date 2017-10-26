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
    public function mostrar($id_produto){
        
        //$produto = Produto::where('id',$id)->get();
        $produto = Produto::findOrFail($id_produto);


        if(empty($produto)){
            return "Esse produto não existe";
          }
          
        return view('buscar')->with('p',$produto);

    }

    // public function adicionar(){
    //     return view('adicionar');
    // }

   

}
