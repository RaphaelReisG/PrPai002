<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;

use App\Http\Resources\TesteResource;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Pedido::all();
        //return Pedido::with(['produtos', 'cliente', 'vendedor', 'metodoPagamento'])->paginate(4);

        $pedido = Pedido::with(['produtos', 'cliente', 'vendedor', 'metodoPagamento'])
        ->join('metodo_pagamentos', 'pedidos.metodo_pagamento_id', '=', 'metodo_pagamentos.id' )
        ->join('vendedors', 'pedidos.vendedor_id', '=', 'vendedors.id' )
        ->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id' )
        ->select('pedidos.*')
        ->groupBy('pedidos.id', 'pedidos.payday', 'pedidos.delivery_date',
            'pedidos.approval_date','pedidos.total_price','pedidos.total_discount',
            'pedidos.metodo_pagamento_id','pedidos.observation',
            'pedidos.cliente_id','pedidos.vendedor_id',
             'pedidos.created_at', 'pedidos.updated_at');


        if ($request->has('buscarObjeto')) {
            $pedido->where(function ($query) use ($request) {
                $query->where('pedidos.payday', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pedidos.delivery_date', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pedidos.approval_date', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pedidos.total_discount', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pedidos.observation', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('metodo_pagamentos.name', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('clientes.name', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('vendedors.name', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('vendedor_id')) {
            $pedido->where('pedidos.vendedor_id', '=', $request->vendedor_id);
        }

        if ($request->has('cliente_id')) {
            $pedido->where('pedidos.cliente_id', '=', $request->cliente_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $pedido->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $pedido->get();
            //error_log('passou aki');
        }

        return $pedido->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido = Pedido::create($request->all());

        $produtosSelecionados = $request->produtos;

        foreach ($produtosSelecionados as $produtoSelecionado) {
            $produto = Produto::find($produtoSelecionado['id']);
            $pedido->produtos()->attach($produto, [
                'qty_item' => $produtoSelecionado['qty_item'],
                'price_item' => $produtoSelecionado['price_item'],
            ]);
        }
        return $pedido;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //return Pedido::with('produtos')->findOrfail($id);
        return new TesteResource($pedido, $pedido->produtos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //$obj = Pedido::findOrfail($id);
        //$pedido->update($request->all());


        $pedido->update($request->all());

        $produtosSelecionados = $request->produtos;

        $pedido->produtos()->detach();
        foreach ($produtosSelecionados as $produtoSelecionado) {
            $produto = Produto::find($produtoSelecionado['id']);
            $pedido->produtos()->attach($produto, [
                'qty_item' => $produtoSelecionado['qty_item'],
                'price_item' => $produtoSelecionado['price_item'],
            ]);
        }
        return $pedido;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Pedido $pedido)
    {
        //$obj = Pedido::findOrfail($id);
        $pedido->produtos()->detach();
        return $pedido->delete();
    }

    public function aprovarPedido(Request $request, Pedido $pedido)
    {
        return $pedido->update($request->only('approval_date'));
    }

    public function aprovarEntrega(Request $request, Pedido $pedido)
    {
        return $pedido->update($request->only('delivery_date'));
    }

    public function aprovarPagamento(Request $request, Pedido $pedido)
    {
        return $pedido->update($request->only('payday'));
    }
}
