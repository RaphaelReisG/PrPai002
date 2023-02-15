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
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->integer('number_phone');
            $table->integer('number_cellphone');

            //$table->foreignId('cliente_id')->constrained('clientes');
            //$table->foreignId('vendedor_id')->constrained('vendedors');
            //$table->foreignId('fornecedor_id')->constrained('fornecedors');

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
        Schema::dropIfExists('telefones');
    }
};
