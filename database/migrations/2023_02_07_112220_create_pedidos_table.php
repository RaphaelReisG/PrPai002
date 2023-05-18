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

            //$table->dateTime('issue_date');
            $table->dateTime('payday')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_discount', 10, 2);
            $table->foreignId('metodo_pagamento_id')->constrained('metodo_pagamentos');
            //$table->string('payment_method');
            //$table->boolean('status_payment')->default(false);
            //$table->boolean('status_delivery')->default(false);
            //$table->boolean('status_request')->default(false);
            $table->string('observation', 150)->nullable();

            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('vendedor_id')->constrained('vendedors');

            $table->timestamps();
        });

        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->id();

            //$table->string('idCliente');

            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->integer('qty_item');
            $table->decimal('price_item', 10, 2);

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
        Schema::dropIfExists('pedido_produto');
        Schema::dropIfExists('pedidos');
    }
};
