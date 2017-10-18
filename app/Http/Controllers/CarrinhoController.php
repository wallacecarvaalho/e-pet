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

        if( empty($idpedido) ){ //Caso não exista, vai criar um
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

        // Verifica se a variável está vazia
        if( empty($idcarrinho) ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }
        

        $where_produto = [
            'carrinho_id'   => $idcarrinho,
            'produto_id'    => $idproduto
        ];

        //Sempre vai remover a partir do último inserido
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

        //Se for falso
        if ( !$check_carrinho ){
            Carrinho::where([
                'id' => $produto->carrinho_id
            ]);
        }

        $req->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');


    }


    // public function mostrar(){
    //     $idUserLogado = Auth::id();
    //     $item = DB::table('carrinhos')->where('user_id', '=', $idUserLogado)->get();

    //     // Com a linha abaixo ñ deu certo, ñ sei porque :(
    //     //$item = Carrinho::where('user_id', '=', $idUserLogado)->get();
        
    //     return view('carrinho', compact('item'));
    // }

    // public function salvar($produto_id){
    //     $produto = Produto::find($produto_id);
        
    //     $dados['user_id'] = Auth::id();
    //     $dados['produto_id'] = $produto_id;
    //     $dados['qtde'] = 1;
    //     $dados['imagem'] = 'REMOVER';
    //     $dados['preco_unitario'] = $produto->preco;
    //     $dados['preco_total'] = $produto->preco;
    //     Carrinho::create($dados);

    //     $idUserLogado = Auth::id();
    //     $item = DB::table('carrinhos')->where('user_id', '=', $idUserLogado)->get();
        
    //     return view('carrinho', compact('item'));
    // }
}
