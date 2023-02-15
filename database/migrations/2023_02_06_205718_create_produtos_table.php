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

            $table->string('name');
            $table->string('type');
            $table->integer('quantity');
            $table->decimal('weight', 5, 2);
            $table->decimal('cost_price', 6, 2);
            $table->decimal('sale_price', 6 , 2);
            $table->integer('stock');

            $table->foreignId('marca_id')->constrained('marcas');

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
