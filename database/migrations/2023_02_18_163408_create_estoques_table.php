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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();

            $table->integer('qty_item');
            $table->string('observation');
            $table->foreignId('tipo_movimentacao_id')->constrained('tipo_movimentacaos');
            //$table->string('batch');                //lote
            //$table->dateTime('expiration_date');

            $table->foreignId('produto_id')->constrained('produtos');

            $table->morphs('estoqueable');
            $table->softDeletes();

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
        Schema::dropIfExists('estoques');
    }
};
