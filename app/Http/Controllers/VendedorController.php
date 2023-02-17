<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vendedor::all();
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
    public function show($id)
    {
        return Vendedor::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $administrador)
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
    public function update(Request $request, $id)
    {
        $obj = Vendedor::findOrfail($id);
        $obj->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $obj = Vendedor::findOrfail($id);
        $obj->delete();
    }
}
