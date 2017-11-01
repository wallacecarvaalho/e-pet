<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use App\CarrinhoProduto;
use App\Produto;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

        if( empty($idcarrinho) ){ 
            $carrinho_novo = Carrinho::create([
                'user_id' => $idusuario,
                'status' => 'RE'
        ]);
            $idcarrinho = $carrinho_novo->id;
        }

        $produtoCriado = CarrinhoProduto::create([
            'carrinho_id' => $idcarrinho,
            'produto_id' => $idproduto,
            'valor' => $produto->preco,
            'status' => 'RE'
        ]);

        //$req->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        //Abaixo - Relacionado ao AJAX
        $where_produto2 = [
            'produto_id'    => $idproduto,
            'status'        => 'RE'
        ];

        $url = $req->input('url');
         if($url == "/carrinho"){
            $produto = CarrinhoProduto::where($where_produto2)->get();
            $produto['qtd'] = $produto->count();
            return response()->json([ $produto, 'message' => 'Produto adicionado ao carrinho!' ]);
         } else {
            return redirect()->route('carrinho.index');
        }
    }

    public function remover() {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idcarrinho              = $req->input('carrinho_id');
        $idproduto               = $req->input('produto_id');
        $remove_apenas_item      = (boolean)$req->input('item');
        $idusuario               = Auth::id();

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

        // Verifica se ainda há itens no carrinho.
        $check_carrinho = CarrinhoProduto::where([
            'carrinho_id' => $produto->carrinho_id
        ])->exists(); // Se existir registro retorna true

        //Caso não, apaga da tabela Carrinho também
        if ( !$check_carrinho ){
            Carrinho::where([
                'id' => $produto->carrinho_id
            ])->delete();
        }

        //$req->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');


        // Abaixo - Relacionado ao AJAX
        $where_produto2 = [
            'carrinho_id'   => $idcarrinho,
            'produto_id'    => $idproduto,
            'status'        => 'RE'
        ];

        $produto = CarrinhoProduto::where($where_produto2)->get();
        $produto['qtd'] = $produto->count();

        //return redirect()->route('carrinho.index');
        return response()->json([ $produto, 'message' => 'Produto removido do carrinho!' ]);
    }

    public function concluir() {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idcarrinho = $req->input('carrinho_id');
        $idusuario = Auth::id();

        $check_carrinho = Carrinho::where([
            'id'        => $idcarrinho,
            'user_id'   => $idusuario,
            'status'    => 'RE'
        ])->exists();

        if( !$check_carrinho ) {
            $req->session()->flash('mensagem-falha', 'Carrinho não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $check_produtos = CarrinhoProduto::where([
            'carrinho_id' => $idcarrinho
        ])->exists();

        if( !$check_produtos ) {
            $req->session()->flash('mensagem-falha', 'Itens do carrinho não encontrados!');
            return redirect()->route('carrinho.index');
        }

        //Atualiza todos os itens do '$idcarrinho' para o status PAGO
        CarrinhoProduto::where([
            'carrinho_id' => $idcarrinho
        ])->update([
            'status' => 'PA'
        ]);

        //Atualiza o carrinho em si para o status PAGO
        Carrinho::where([
            'id' => $idcarrinho
        ])->update([
            'status' => 'PA'
        ]);

        $req->session()->flash('mensagem-sucesso', 'Compra concluída com sucesso!');

        return redirect()->route('carrinho.compras');
    }

    public function compras() {
        $compras = Carrinho::where([
            'status'    => 'PA',
            'user_id'   => Auth::id()
        ])->orderBy('created_at', 'desc')->get();
        
        //Para buscar itens cancelados...
        /*$cancelados = Carrinho::where([
            'status'    => 'CA',
            'user_id'   => Auth::id()
        ])->orderBy('updated_at', 'desc')->get();*/

        return view('compras', compact('compras'));
    }

    public function verificarVazio(){
        $req = Request();
        // $idcarrinho              = $req->input('carrinho_id');
        // $idproduto               = $req->input('produto_id');
        $idusuario               = Auth::id();

        $idcarrinho = Carrinho::consultaId([
            // 'id'        => $idcarrinho,
            'user_id'   => $idusuario,
            'status'    => 'RE'
        ]);

        if( empty($idcarrinho) ) {
            return 1;
        } else {
            return 0;
        }

    }
}
