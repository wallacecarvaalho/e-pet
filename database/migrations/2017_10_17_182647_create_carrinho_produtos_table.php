<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrinhoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinho_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('carrinho_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->enum('status', ['RE', 'PA', 'CA']); //Reservado, Pago, Cancelado
            $table->decimal('valor', 6, 2)->default(0);
            $table->foreign('carrinho_id')->references('id')->on('carrinhos')->onDelete('cascade');
            // $table->foreign('produto_id')->references('produto_id')->on('produtos');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrinho_produtos');
    }
}
