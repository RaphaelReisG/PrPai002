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
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->integer('cnpj');
            $table->string('company_name', 45);

            //$table->integer('number_phone');
            //$table->integer('number_cellphone');

            //$table->foreignId('endereco_id')->constrained('enderecos');
            //$table->foreignId('telefone_id')->constrained('telefones');

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
        Schema::dropIfExists('fornecedors');
    }
};
