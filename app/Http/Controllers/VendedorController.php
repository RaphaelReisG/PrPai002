<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vendedor::with(['user','enderecos', 'telefones'])->paginate(10);
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
        Vendedor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        return new TesteResource($vendedor, $vendedor->enderecos, $vendedor->clientes, $vendedor->telefones,  $vendedor->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        //$obj = Vendedor::findOrfail($id);
        //$obj->update($request->all());

        $vendedor->update($request->all());
        if(isset($request->password)){
            $request->password = Hash::make($request->password);
        }
        $vendedor->user()->update($request->only('email', 'password'));

        return new TesteResource($vendedor, $vendedor->user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Vendedor $vendedor)
    {
        //$obj = Vendedor::findOrfail($id);
        //$obj->delete();

        $vendedor->user()->delete();
        $vendedor->delete();

        return new TesteResource($vendedor);
    }
}
