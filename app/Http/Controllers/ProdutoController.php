<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function show(){

        $produtos = Produto::all();

        return view('index')->with('produtos',$produtos);

    }
    public function find($id){

        $produtos = Produto::find($id);

        return view('index')->with('produtos',$produtos);

    }
}
