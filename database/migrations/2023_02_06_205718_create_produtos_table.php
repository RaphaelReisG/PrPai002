<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fornecedor_id');

            $table->string('nome');
            $table->string('tipo');
            $table->string('marca');
            $table->integer('quantidadePc');
            $table->decimal('pesoPc', 5, 2);
            $table->decimal('precoCustoPc', 6, 2);
            $table->decimal('precoVendaPc', 6 , 2);
            $table->integer('estoque');

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
        Schema::dropIfExists('produtos');
    }
};
