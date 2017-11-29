<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\CarrinhoProduto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function listar(){
        $produtos = Produto::all();

        return view('produtos')->with('produtos', $produtos);
    }

    public function editar($id) {
        $produto = Produto::find($id);
        return view('editar', compact('produto'));
    }

    public function atualizar(Request $req, $id) {
        $produto = $req->all();
        $produto_antigo = Produto::find($id);
        $i = '/public/'.$produto_antigo->imagem;
        //dd($produto_antigo->imagem);
        //dd($produto_antigo);
        //$produto_antigo->imagem->delete();
        //dd($i);
        \Storage::delete($i);

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

        Produto::find($id)->update($produto);

        return redirect()->route('produtos.listar');
    }
    
    public function remover($id){
        //CarrinhoProduto::where('produto_id', $id)->where('status', 'RE')->delete();
        //Produto::find($id)->delete();
        return redirect()->route('produtos.listar');
    }
   

}
