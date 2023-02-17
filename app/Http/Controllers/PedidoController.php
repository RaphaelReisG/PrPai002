<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pedido::all();
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
    public function show($id)
    {
        return Pedido::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $administrador)
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
    public function update(Request $request, $id)
    {
        $obj = Pedido::findOrfail($id);
        $obj->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $obj = Pedido::findOrfail($id);
        $obj->delete();
    }
}
