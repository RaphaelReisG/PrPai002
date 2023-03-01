<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrador;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\Pais;

use App\Models\Fornecedor;
use App\Models\Vendedor;
use App\Models\Cliente;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $pais_brasil = Pais::create(['name_country' => 'Brasil']);
        $pais_usa = Pais::create(['name_country' => 'Estados Unidos']);
        $pais_fraca = Pais::create(['name_country' => 'França']);

        $estado_saopaulo = $pais_brasil->estados()->create(['name_state' => 'São Paulo']);
        $estado_parana = $pais_brasil->estados()->create(['name_state' => 'Paraná']);
        $estado_riodejaneiro = $pais_brasil->estados()->create(['name_state' => 'Rio de Janeiro']);
        $estado_florida = $pais_usa->estados()->create(['name_state' => 'Florida']);

        $cidade_itanhaem = $estado_saopaulo->cidades()->create(['name_city' => 'Itanhaém']);
        $estado_saopaulo->cidades()->create(['name_city' => 'Mongagua']);
        $estado_saopaulo->cidades()->create(['name_city' => 'Peruibe']);
        $estado_parana->cidades()->create(['name_city' => 'Curitiba']);
        $estado_riodejaneiro->cidades()->create(['name_city' => 'Paraty']);
        $estado_florida->cidades()->create(['name_city' => 'Miami']);

        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Belas Artes']);
        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Centro']);
        $cidade_itanhaem->bairros()->create(['name_neighborhood' => 'Suarão']);

        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Belas Artes']);
        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Centro']);
        //Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Suarão']);

        Fornecedor::create([ 'company_name' => 'Mineirão','cnpj' => 1234567890,'email' => 'mineirão@mineirão.com'])
            ->enderecos()->create([ 'street_name' => 'Rua Dagruta', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 2],
            [ 'street_name' => 'Av. graça', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 1]);
        Fornecedor::create([ 'company_name' => 'Denise Salgados','cnpj' => 1234567891,'email' => 'denise@mdenise.com'])
            ->enderecos()->create([ 'street_name' => 'Rua Pernambuco', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 3]);

        Fornecedor::find(1)->marcas()->create(['name' => 'Mineirão']);
        Fornecedor::find(1)->marcas()->create(['name' => 'Vovó Natalia']);
        Fornecedor::find(2)->marcas()->create(['name' => 'Croissant & Cia']);

        Fornecedor::find(1)->marcas()->find(1)->produtos()->create([
            'name' => 'Pão de Queijo 90g',
            'type'=> 'Para Assar',
            'quantity' => 22,
            'weight' => 2,
            'cost_price' => 18,
            'sale_price' => 22

        ]);

        Fornecedor::find(2)->marcas()->find(3)->produtos()->create([
            'name' => 'Coxinha de Frango',
            'type'=> 'Para Fritar',
            'quantity' => 10,
            'weight' => 2,
            'cost_price' => 24,
            'sale_price' => 30

        ]);

        Administrador::create([ 'name' => 'Raphael Admin'])->user()->create(['email'=>'raphael@adminraphael.com','email_verified_at'=> '2023-02-07 13:33:19
                ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null,
                'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);

        Vendedor::create([ 'name' => 'Raphael Venda'])->user()->create(['email'=>'raphael@vendedorraphael.com','email_verified_at'=> '2023-02-07 13:33:19
            ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);

            /*Cliente::create([ 'name' => 'Rodolfo CLiente' , 'company_name' => 'Bar joia','cnpj' => 1234567893, 'vendedor_id' => 1])->user()->create(['email'=>'raphael@clienteraphael.com','email_verified_at'=> '2023-02-07 13:33:19
            ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null,
            'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);*/

        $cliente1 = Cliente::create(['name' => 'Rodolfo CLiente' , 'company_name' => 'Bar joia','cnpj' => 1234567893, 'vendedor_id' => 1]);
        $cliente1->user()->create(['email'=>'raphael@clienteraphael.com','email_verified_at'=> '2023-02-07 13:33:19
        ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null,
        'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);
        $cliente1->enderecos()->create([ 'street_name' => 'Rua Bahia', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 1]);
        $cliente1->enderecos()->create([ 'street_name' => 'Rua Alexandre', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 3]);
        $cliente1->telefones()->create(['number_phone' => '(13)3426-5255']);
        $cliente1->telefones()->create(['number_phone' => '(13)91234-5678']);
        $cliente1->pedidos()->create([
            'issue_date' => '2023-02-07 13:33:19',
            'payday' => '2023-02-09 13:33:19',
            'delivery_date' => '2023-02-08 13:33:19',
            'approval_date' => '2023-02-08 13:33:19',
            'total_price' => 52,
            'total_discount' => 0,
            'payment_method' => 'Dinheiro',
            'observation' => 'Tudo entregue junto'
        ])->produtos()->attach([
            1 => ['qty_item' => 1, 'price_iten' => 22] ,
            2 => ['qty_item' => 1, 'price_iten' => 30]

        ]);

        Administrador::find(1)->estoqueable()->create([
            'qty_item' => 10,
            'produto_id' => 1,
            'observation' => 'Compra fornecedor',
            'batch' => 'A458',
            'expiration_date' => '2023-02-08 13:33:19'
        ]);
        Administrador::find(1)->estoqueable()->create([
            'qty_item' => 10,
            'produto_id' => 2,
            'observation' => 'Compra fornecedor',
            'batch' => 'B458',
            'expiration_date' => '2023-02-08 13:33:19'
        ]);

        Cliente::find(1)->estoqueable()->create([
        'qty_item' => -1,
        'produto_id' => 1,
        'observation' => 'Venda',
        'batch' => 'A458',
        'expiration_date' => '2023-02-08 13:33:19'
        ]);
        Cliente::find(1)->estoqueable()->create([
            'qty_item' => -1,
            'produto_id' => 2,
            'observation' => 'Venda',
            'batch' => 'B458',
            'expiration_date' => '2023-02-08 13:33:19'
            ]);



        //Estado::create(['name_state' => 'São Paulo']);
        //Estado::create(['name_state' => 'Paraná']);
        //Estado::create(['name_state' => 'Rio de Janeiro']);


        Permission::create(['name' => 'admin', 'guard_name' => 'web']);
        Permission::create(['name' => 'vendedor', 'guard_name' => 'web']);
        Permission::create(['name' => 'cliente', 'guard_name' => 'web']);

        DB::table('model_has_permissions')->insert(['permission_id'=>1, 'model_type'=>'App\Models\User', 'model_id'=>1]);
        DB::table('model_has_permissions')->insert(['permission_id'=>2, 'model_type'=>'App\Models\User', 'model_id'=>2]);
        DB::table('model_has_permissions')->insert(['permission_id'=>3, 'model_type'=>'App\Models\User', 'model_id'=>3]);

    }
}
