<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\BairroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MetodoPagamentoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\TelefoneController;
use App\Http\Controllers\TipoMovimentacaoController;
use App\Http\Controllers\TipoProdutoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('administrador', AdministradorController::class)->middleware('auth:sanctum');
Route::apiResource('bairro', BairroController::class)->middleware('auth:sanctum');
Route::apiResource('cidade', CidadeController::class)->middleware('auth:sanctum');
Route::apiResource('cliente', ClienteController::class)->middleware('auth:sanctum');
Route::apiResource('endereco', EnderecoController::class)->middleware('auth:sanctum');
Route::apiResource('estado', EstadoController::class)->middleware('auth:sanctum');
Route::apiResource('estoque', EstoqueController::class)->middleware('auth:sanctum');
Route::apiResource('fornecedor', FornecedorController::class)->middleware('auth:sanctum');
Route::apiResource('marca', MarcaController::class)->middleware('auth:sanctum');
Route::apiResource('metodo_pagamento', MetodoPagamentoController::class)->middleware('auth:sanctum');
Route::apiResource('pais', PaisController::class)->middleware('auth:sanctum');
Route::apiResource('pedido', PedidoController::class)->middleware('auth:sanctum');

Route::put('pedido_aprovacao/{pedido}', [PedidoController::class, 'aprovarPedido'])->middleware('auth:sanctum');
Route::put('pedido_entrega/{pedido}', [PedidoController::class, 'aprovarEntrega'])->middleware('auth:sanctum');
Route::put('pedido_pagamento/{pedido}', [PedidoController::class, 'aprovarPagamento'])->middleware('auth:sanctum');

Route::apiResource('produto', ProdutoController::class)->middleware('auth:sanctum');
Route::apiResource('vendedor', VendedorController::class)->middleware('auth:sanctum');
Route::apiResource('telefone', TelefoneController::class)->middleware('auth:sanctum');
Route::apiResource('tipo_movimentacao', TipoMovimentacaoController::class)->middleware('auth:sanctum');
Route::apiResource('tipo_produto', TipoProdutoController::class)->middleware('auth:sanctum');

Route::get('analise_cliente_top_produtos', [ClienteController::class, 'analiseClienteTopProdutos']);
Route::get('analise_cliente_total_pedidos', [ClienteController::class, 'analiseClienteTotalPedidos']);
Route::get('analise_cliente_total_produtos', [ClienteController::class, 'analiseClienteTotalProdutos']);

Route::get('analise_vendedor_top_produtos', [VendedorController::class, 'analiseVendedorTopProdutos']);
Route::get('analise_vendedor_total_pedidos', [VendedorController::class, 'analiseVendedorTotalPedidos']);
Route::get('analise_vendedor_total_produtos', [VendedorController::class, 'analiseVendedorTotalProdutos']);
