<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Produto::all();
        return Produto::with(['marca', 'marca.fornecedor', 'estoques' ])->paginate(10);
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
        Produto::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //return Produto::findOrfail($id);
        return new TesteResource($produto, $produto->marca, $produto->estoques);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //$obj = Produto::findOrfail($id);
        $produto->update($request->all());
        //$produto->marca()->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Produto $produto)
    {
        //$obj = Produto::findOrfail($id);
        $produto->delete();
    }
}
