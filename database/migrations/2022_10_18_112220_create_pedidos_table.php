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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            //$table->string('idCliente');

            $table->foreignId('user_id');

            $table->dateTime('dataEmissao');
            $table->dateTime('dataPagamento');
            $table->dateTime('dataEntrega');
            $table->decimal('valor', 10, 2);
            $table->decimal('desconto', 10, 2);
            $table->string('formaPagamento');
            $table->boolean('statusPAgamento')->default(false);
            $table->boolean('statusEntrega')->default(false);
            $table->boolean('statusSolicitacao')->default(false);
            $table->string('observacao', 150);

            $table->timestamps();
        });

        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->id();

            //$table->string('idCliente');

            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->integer('quantidade');

            $table->dateTime('dataEmissao');
            $table->dateTime('dataPagamento');
            $table->dateTime('dataEntrega');
            $table->decimal('valor', 10, 2);
            $table->decimal('desconto', 10, 2);
            $table->string('formaPagamento');
            $table->boolean('statusPAgamento')->default(false);
            $table->boolean('statusEntrega')->default(false);
            $table->boolean('statusSolicitacao')->default(false);
            $table->string('observacao', 150);

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
        Schema::dropIfExists('pedidos');
    }
};
