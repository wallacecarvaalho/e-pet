<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class SearchController extends Controller
{
    public function listar(){
        // $produtos_pesq = DB::table('produtos')->where('name', 'like', '%' + $prod_pesquisado + '%')->get();
        $pesq = $_GET['termo'];
        $produtos_pesq = Produto::where('name', 'like', '%'.$pesq.'%')->get();
        return view('search')->with('produtos_pesq', $produtos_pesq);
    }
}
