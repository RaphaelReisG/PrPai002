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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            $table->string('street_name');
            $table->string('complement');
            $table->integer('cep');
            $table->integer('house_number');

            $table->foreignId('bairro_id')->constrained('bairros');

            $table->morphs('enderecoable');

            //$table->foreignId('cliente_id')->constrained('clientes');


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
        Schema::dropIfExists('enderecos');
    }
};
