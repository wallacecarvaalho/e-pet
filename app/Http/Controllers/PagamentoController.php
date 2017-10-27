<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrinho;
use Illuminate\Support\Facades\Auth;
use App\Produto;
use App\PagSeguro\PagSeguro;

class PagamentoController extends Controller
{

 public function dadosCarrinho(){
    $data = [];
    $data['email'] = 'wallace.c.aleixo00@gmail.com';
    $data['token'] = '9A8FB0217179448C81E3ABFB7DF083E4';
    $response = (new PagSeguro)->request(PagSeguro::SESSION_SANDBOX,$data);

    $session = new \SimpleXMLElement($response->getContents());
    $session = $session->id;

        $dados = Carrinho::where([
            'status' => 'RE',
            'user_id' => Auth::id()
        ])->get();
    
        return view('layouts.store.checkout', compact('dados','data','session'));
 }
 

}
