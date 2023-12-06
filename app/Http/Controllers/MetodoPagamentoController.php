<?php

namespace App\Http\Controllers;

use App\Models\MetodoPagamento;
use Illuminate\Http\Request;
use App\Http\Requests\MetodoPagamentoRequest;

class MetodoPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metodoPagamento = MetodoPagamento::with(['pedidos']);

        if ($request->has('buscarObjeto')) {
            $metodoPagamento->where(function ($query) use ($request) {
                $query->where('metodo_pagamentos.name', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $metodoPagamento->orderBy($request->ordenacaoBusca);
        }

        else{
            $metodoPagamento->orderBy('metodo_pagamentos.name');
        }

        if ($request->has('paginacao')) {
            return $metodoPagamento->get();
            //error_log('passou aki');
        }

        return $metodoPagamento->paginate(10);
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
    public function store(MetodoPagamentoRequest $request)
    {
        return $metodoPagamento = MetodoPagamento::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MetodoPagamento  $metodoPagamento
     * @return \Illuminate\Http\Response
     */
    public function show(MetodoPagamento $metodoPagamento)
    {
        return $metodoPagamento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetodoPagamento  $metodoPagamento
     * @return \Illuminate\Http\Response
     */
    public function edit(MetodoPagamento $metodoPagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MetodoPagamento  $metodoPagamento
     * @return \Illuminate\Http\Response
     */
    public function update(MetodoPagamentoRequest $request, MetodoPagamento $metodoPagamento)
    {
        return $metodoPagamento->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetodoPagamento  $metodoPagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodoPagamento $metodoPagamento)
    {
        return $metodoPagamento->delete();
    }
}
