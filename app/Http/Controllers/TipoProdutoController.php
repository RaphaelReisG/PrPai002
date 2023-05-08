<?php

namespace App\Http\Controllers;

use App\Models\Tipo_produto;
use Illuminate\Http\Request;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Tipo_produto::paginate(4);

        $tipo_produto = Tipo_produto::with(['produtos']);

        if ($request->has('buscarObjeto')) {
            $tipo_produto->where(function ($query) use ($request) {
                $query->where('tipo_produtos.name', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $tipo_produto->orderBy($request->ordenacaoBusca);
        }

        return $tipo_produto->paginate(4);
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
        return $tipo_produto = Tipo_produto::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_produto  $tipo_produto
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_produto $tipo_produto)
    {
        return $tipo_produto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo_produto  $tipo_produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_produto $tipo_produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo_produto  $tipo_produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_produto $tipo_produto)
    {
        return $tipo_produto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_produto  $tipo_produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_produto $tipo_produto)
    {
        return $tipo_produto->delete();
    }
}
