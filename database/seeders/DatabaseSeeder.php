<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::create(['id'=> 1, 'email'=>'raphael@adminraphael.com','email_verified_at'=> '2023-02-07 13:33:19
        ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null, 
        'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);
        User::create(['id'=> 2, 'email'=>'raphael@vendedorraphael.com','email_verified_at'=> '2023-02-07 13:33:19
        ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null, 
        'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);
        User::create(['id'=> 3, 'email'=>'raphael@clienteraphael.com','email_verified_at'=> '2023-02-07 13:33:19
        ' , 'password'=>Hash::make('qwerasdf'), 'remember_token' => null, 
        'created_at'=>'2023-02-07 13:32:43', 'updated_at'=>'2023-02-07 13:33:19']);

        Pais::create(['name_country' => 'Brasil']);
        Pais::create(['name_country' => 'Estados Unidos']);
        Pais::create(['name_country' => 'França']);

        Pais::find(1)->estados()->create(['name_state' => 'São Paulo']);
        Pais::find(1)->estados()->create(['name_state' => 'Paraná']);
        Pais::find(1)->estados()->create(['name_state' => 'Rio de Janeiro']);
        Pais::find(2)->estados()->create(['name_state' => 'Florida']);

        Pais::find(1)->estados()->find(1)->cidades()->create(['name_city' => 'Itanhaém']);
        Pais::find(1)->estados()->find(1)->cidades()->create(['name_city' => 'Mongagua']);
        Pais::find(1)->estados()->find(1)->cidades()->create(['name_city' => 'Peruibe']);
        Pais::find(1)->estados()->find(2)->cidades()->create(['name_city' => 'Curitiba']);
        Pais::find(1)->estados()->find(3)->cidades()->create(['name_city' => 'Paraty']);
        Pais::find(2)->estados()->find(4)->cidades()->create(['name_city' => 'Miami']);

        Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Belas Artes']);
        Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Centro']);
        Pais::find(1)->estados()->find(1)->cidades()->find(1)->bairros()->create(['name_neighborhood' => 'Suarão']);
        
        Fornecedor::create(['number_phone' => 1334265254, 'number_cellphone' => 1391234567, 'company_name' => 'Mineirão','cnpj' => 1234567890,'email' => 'mineirão@mineirão.com']);
        Fornecedor::create(['number_phone' => 1334265254, 'number_cellphone' => 1391234567, 'company_name' => 'Denise Salgados','cnpj' => 1234567891,'email' => 'denise@mdenise.com']);

        Fornecedor::find(1)->marcas()->create(['name' => 'Mineirão']);
        Fornecedor::find(1)->marcas()->create(['name' => 'Vovó Natalia']);
        Fornecedor::find(2)->marcas()->create(['name' => 'Croissant & Cia']);

        Fornecedor::find(1)->marcas()->find(1)->produtos()->create([
            'name' => 'Pão de Queijo 90g',
            'type'=> 'Para Assar',
            'quantity' => 22,
            'weight' => 2,
            'cost_price' => 18,
            'sale_price' => 22,
            'stock' => 15
        ]);

        Fornecedor::find(2)->marcas()->find(3)->produtos()->create([
            'name' => 'Coxinha de Frango',
            'type'=> 'Para Fritar',
            'quantity' => 10,
            'weight' => 2,
            'cost_price' => 24,
            'sale_price' => 30,
            'stock' => 10
        ]);

        User::find(2)->vendedor()->create(['number_phone' => 1334265254, 'number_cellphone' => 1391234567, 'name' => 'Raphael Venda']);

        User::find(3)->cliente()->create(['number_phone' => 1334265254, 'number_cellphone' => 1391234567, 'name' => 'Rodolfo CLiente' , 'company_name' => 'Bar joia','cnpj' => 1234567893, 'vendedor_id' => 1]);
        
        User::find(1)->administrador()->create([ 'name' => 'Raphael Admin']);

        Cliente::find(1)->endereco()->create([ 'street_name' => 'Rua Bahia', 'cep' => 11740000, 'house_number' => 10, 'complement' => 'Casa', 'bairro_id' => 1]);
        
        Cliente::find(1)->pedidos()->create([
            'issue_date' => '2023-02-07 13:33:19',
            'payday' => '2023-02-09 13:33:19',
            'delivery_date' => '2023-02-08 13:33:19',
            'total_price' => 52,
            'total_discount' => 0,
            'payment_method' => 'Dinheiro',
            'status_payment' => true,
            'status_delivery' => true,
            'status_request' => true,
            'observation' => 'Tudo entregue junto'
        ])->produtos()->attach([ 
            1 => ['qty_item' => 1, 'price_iten' => 22] ,
            2 => ['qty_item' => 1, 'price_iten' => 30] 
        
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
