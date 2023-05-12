<?php

namespace App\Http\Controllers;

use App\Models\Tipo_movimentacao;
use Illuminate\Http\Request;
use App\Http\Requests\TipoMovimentacaoRequest;

class TipoMovimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $tipo_movimentacao = Tipo_movimentacao::with(['estoques']);

        if ($request->has('buscarObjeto')) {
            $tipo_movimentacao->where(function ($query) use ($request) {
                $query->where('tipo_movimentacaos.name', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $tipo_movimentacao->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $tipo_movimentacao->paginate($request->paginacao);
            error_log('passou aki');
        }

        return $tipo_movimentacao->get();
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
    public function store(TipoMovimentacaoRequest $request)
    {
        return Tipo_movimentacao::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_movimentacao  $tipo_movimentacao
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_movimentacao $tipo_movimentacao)
    {
        return $tipo_movimentacao;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_movimentacao  $tipo_movimentacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_movimentacao $tipo_movimentacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_movimentacao  $tipo_movimentacao
     * @return \Illuminate\Http\Response
     */
    public function update(TipoMovimentacaoRequest $request, Tipo_movimentacao $tipo_movimentacao)
    {
        return $tipo_movimentacao->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_movimentacao  $tipo_movimentacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_movimentacao $tipo_movimentacao)
    {
        return $tipo_movimentacao->delete();
    }
}
