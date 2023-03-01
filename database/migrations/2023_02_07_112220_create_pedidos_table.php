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

            $table->dateTime('issue_date');
            $table->dateTime('payday');
            $table->dateTime('delivery_date');
            $table->dateTime('approval_date');
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_discount', 10, 2);
            $table->string('payment_method');
            //$table->boolean('status_payment')->default(false);
            //$table->boolean('status_delivery')->default(false);
            //$table->boolean('status_request')->default(false);
            $table->string('observation', 150);

            $table->foreignId('cliente_id')->constrained('clientes');

            $table->timestamps();
        });

        Schema::create('pedido_produto', function (Blueprint $table) {
            $table->id();

            //$table->string('idCliente');

            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->integer('qty_item');
            $table->decimal('price_iten', 10, 2);

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
