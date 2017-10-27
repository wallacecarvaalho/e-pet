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

    public function adicionar(){
        return view('adicionar');
    }

    public function salvar(Request $req){
        $produto = $req->all();

        //dd($produto);

        if($req->hasFile('imagem')){
            $imagem = $req->file('imagem');
            $num = rand(1111,9999);
            $dir = "img/produtos";
            $ext = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ext;
            $imagem->move($dir, $nomeImagem);
            $produto['imagem'] = $dir."/".$nomeImagem;
        }
        
        if($req->qtd == 0){
            $produto['status'] = "Indisponível";
        } else {
            $produto['status'] = "Disponível";
        }

        $novoProd = Produto::create($produto);

        return redirect('/produtos/'.$novoProd->id);
    }

   

}
