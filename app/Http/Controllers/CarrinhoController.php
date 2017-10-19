<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\CarrinhoProduto;
use App\Produto;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    function __construct(){
        //Verificar se user está logado
        $this->middleware('auth');
    }

    public function index(){
        $carrinhos = Carrinho::where([
            'status' => 'RE',
            'user_id' => Auth::id()
        ])->get();

        return view('carrinho', compact('carrinhos'));
    }

    public function adicionar(){
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idproduto = $req->input('id');

        $produto = Produto::find($idproduto);
        if(empty($produto->id)){
            $req->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()-route('carrinho.index');
        }

        $idusuario = Auth::id();

        $idcarrinho = Carrinho::consultaId([ //Se já existe algum pedido pra esse usuário com status 'RE'
            'user_id' => $idusuario,
            'status' => 'RE'
        ]);

        if( empty($idpedido) ){ 
            $carrinho_novo = Carrinho::create([
                'user_id' => $idusuario,
                'status' => 'RE'
        ]);
            $idcarrinho = $carrinho_novo->id;
        }

        CarrinhoProduto::create([
            'carrinho_id' => $idcarrinho,
            'produto_id' => $idproduto,
            'valor' => $produto->preco,
            'status' => 'RE'
        ]);

        $req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function remover() {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idcarrinho              = $req->input('carrinho_id');
        $idproduto               = $req->input('produto_id');
        $remove_apenas_item      = (boolean)$req->input('item');
        $idusuario               = $Auth::id();

        $idcarrinho = Carrinho::consultaId([ //Consulta redundante.. por segurança mesmo
            'id'        => $idcarrinho,
            'user_id'   => $idusuario,
            'status'    => 'RE' //Reservado
        ]);

        if( empty($idcarrinho) ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }
        

        $where_produto = [
            'carrinho_id'   => $idcarrinho,
            'produto_id'    => $idproduto
        ];

        $produto = CarrinhoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if( empty($produto->id) ){
            $req->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        //Se deseja remover apenas um item
        if( $remove_apenas_item ){
            $where_produto['id'] = $produto->id;
        }

        CarrinhoProduto::where($where_produto)->delete();


        $check_carrinho = CarrinhoProduto::where([
            'carrinho_id' => $produto->carrinho_id
        ])->exists(); //Retorna boolean. Se existir registro, retorna true

        if ( !$check_carrinho ){
            Carrinho::where([
                'id' => $produto->carrinho_id
            ]);
        }

        $req->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');


    }
}
