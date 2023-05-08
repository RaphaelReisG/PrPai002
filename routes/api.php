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

Route::apiResource('administrador', AdministradorController::class);
Route::apiResource('bairro', BairroController::class);
Route::apiResource('cidade', CidadeController::class);
Route::apiResource('cliente', ClienteController::class);
Route::apiResource('endereco', EnderecoController::class);
Route::apiResource('estado', EstadoController::class);
Route::apiResource('estoque', EstoqueController::class);
Route::apiResource('fornecedor', FornecedorController::class);
Route::apiResource('marca', MarcaController::class);
Route::apiResource('metodo_pagamento', MetodoPagamentoController::class);
Route::apiResource('pais', PaisController::class);
Route::apiResource('pedido', PedidoController::class);
Route::apiResource('produto', ProdutoController::class);
Route::apiResource('vendedor', VendedorController::class);
Route::apiResource('telefone', TelefoneController::class);
Route::apiResource('tipo_movimentacao', TipoMovimentacaoController::class);
Route::apiResource('tipo_produto', TipoProdutoController::class);
