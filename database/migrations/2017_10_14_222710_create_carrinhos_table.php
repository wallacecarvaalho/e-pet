<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->primary(['user_id', 'produto_id']);
            $table->foreign('produto_id')->references('produto_id')->on('produtos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('qtde');
            $table->string('imagem');
            $table->decimal('preco_unitario', 6,2);
            $table->decimal('preco_total', 6,2);
            
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
        Schema::dropIfExists('carrinhos');
    }
}
