<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Pedido::all();
        return Pedido::with(['produtos', 'cliente', 'cliente.vendedor'])->paginate(4);
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
        Pedido::create($request->all());
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
        $pedido->update($request->all());
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
        $pedido->delete();
    }
}
