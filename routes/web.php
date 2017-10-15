<?php

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

Route::get('/carrinho', 'CarrinhoController@mostrar');
Route::post('/carrinho/salvar', 'CarrinhoController@adicionar'); //Salva o produto no carrinho