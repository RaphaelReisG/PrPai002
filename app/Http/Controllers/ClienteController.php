<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

use App\Models\Bairro;
use App\Models\Estado;

use Illuminate\Http\Request;

use App\Models\Endereco;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::all();
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
        Cliente::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Cliente::with(['endereco', 'vendedor', 'pedidos'])->findOrfail($id);


        //$obj['endereco']['bairro_id'] = Bairro::with('cidade')->findOrfail($obj['endereco']['bairro_id']);
        //$obj['endereco']['bairro_id']['cidade']['estado_id'] = Estado::with('pais')->findOrfail($obj['endereco']['bairro_id']['cidade']['estado_id']);
        return $obj;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Cliente::findOrfail($id);
        $obj->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Cliente::findOrfail($id);
        $obj->delete();
    }
}
