<?php
use App\PagSeguro\PagSeguro;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProdutoController@lista');

Route::get('/produtos/{id_produto}', 'ProdutoController@mostrar');


Auth::routes();

Route::post('/login/social','Auth\LoginController@loginSocial');
Route::get('/login/callback','Auth\LoginController@loginCallBack');

Route::group(['prefix'=>'admin' , 'as' => 'admin.'], function(){
      // Authentication Routes...
        $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('login', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');
        
          Route::group(['middleware' => 'can:admin'], function(){
              $this->get('/dashboard', function(){
            return view('dashboard');
          })->middleware('auth');
        });
        
        
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'SearchController@listar');

//Route::get('/carrinho', 'CarrinhoController@mostrar');
//Route::post('/carrinho/salvar/{id_produto}',['as' => 'carrinho.salvar', 'uses' => 'CarrinhoController@salvar']); //Salva o produto no carrinho


Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho.index');
Route::get('/carrinho/adicionar', function(){
  return redirect()->route('carrinho.index');
}); //Pra caso o usuário digite diretamente na barra de endereços /carrinho/adicionar
Route::post('/carrinho/adicionar', 'CarrinhoController@adicionar')->name('carrinho.adicionar');
Route::delete('/carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/compras', 'CarrinhoController@compras')->name('carrinho.compras');

Route::get('/checkout/{id}',function($id){
    $data = [];
    $data['email'] = 'wallace.c.aleixo00@gmail.com';
    $data['token'] = '9A8FB0217179448C81E3ABFB7DF083E4';
    $response = (new PagSeguro)->request(PagSeguro::SESSION_SANDBOX,$data);

    $session = new \SimpleXMLElement($response->getContents());
    $session = $session->id;

    $amount = number_format(521.50,2,'.','');

    return view('layouts.store.checkout', compact('id','session','amount'));
});

Route::post('/checkout/{id}',function($id){
    $data = request()->all();
    unset($data['_token']);
    $data['email'] = 'wallace.c.aleixo00@gmail.com';
    $data['token'] = '9A8FB0217179448C81E3ABFB7DF083E4';
    $data['paymentMode'] = 'default';
    $data['paymentMethod'] = 'creditCard';
    $data['currency'] = 'BRL';
  /*$key = 1;
    @foreach($pedido->products as produto){
      $data['itemId'.$key] = $produto->id;
      $data['itemDescription.$key'] = $produto->title;
      $data['itemAmount'.$key] = number_format($produto->value,2,'','.');
      $data['itemQuantity'.$key] = $produto->qtd;
      
      $key++;
    }*/

    $data['senderAreaCode'] = substr($data['senderPhone'],0,2);
    $data['senderPhone'] = substr($data['senderPhone'],2,strlen($data['senderPhone']));

    $data['creditCardHolderAreaCode'] = substr($data['creditCardHolderPhone'],0,2);
    $data['creditCardHolderPhone'] = substr($data['creditCardHolderPhone'],2,strlen($data['creditCardHolderPhone']));
    $data['installmentValue'] = number_format($data['installmentValue'],2,'.','');
    $data['shippingAddressCountry'] = 'BR';
    $data['billingAddressCountry'] = 'BR';
  
    try{
       $response = (new PagSeguro)->request(PagSeguro::CHECKOUT_SANDBOX,$data);
    }catch(\Exception $e){
        dd($e->getMessage());
    }
    return $data;
});
