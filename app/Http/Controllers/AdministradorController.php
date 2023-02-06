<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultadoBuscaAdmin = Administrador::all();
    	return View('administrador.index')->with('adminResultado',$resultadoBuscaAdmin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('administrador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vetorComDados = $request->all();
        Administrador::create($vetorComDados);
        return redirect('/administrador');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
        return View('administrador.show')->with('admin',$administrador);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $administrador)
    {
        return View('administrador.edit')->with('comp',$administrador);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrador $administrador)
    {
        $administrador->update($request->all());
        return redirect('/administrador');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrador $administrador)
    {
        $administrador->delete();
        return redirect('/administrador');
    }
}
