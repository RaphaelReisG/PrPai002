<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Pais::all();
        return Pais::paginate(10);
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
        Pais::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pais  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Pais $pais)
    {
        //return Pais::findOrfail($id);
        return $pais;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pais  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pais  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pais $pais)
    {
        //$obj = Pais::findOrfail($id);
        $pais->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pais  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Pais $pais)
    {
        //$obj = Pais::findOrfail($id);
        $pais->delete();
    }
}
