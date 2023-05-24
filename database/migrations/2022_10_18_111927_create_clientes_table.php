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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('company_name' , 45 );
            $table->unsignedBigInteger('cnpj');

            //$table->integer('number_phone');
            //$table->integer('number_cellphone');

            //$table->foreignId('endereco_id')->constrained('enderecos');
            //$table->foreignId('telefone_id')->constrained('telefones');
            //$table->foreignId('user_id')->constrained('users');

            $table->foreignId('vendedor_id')->constrained('vendedors');
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
        Schema::dropIfExists('clientes');
    }
};
