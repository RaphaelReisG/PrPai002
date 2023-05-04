<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class PaisController extends Controller
{

    public function index()
    {
        //return Pais::all();
        return Pais::paginate(10);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Pais::create($request->all());
    }


    public function show($id)
    {
        return Pais::findOrfail($id);
        //return new TesteResource($pais);
    }


    public function edit(Pais $pais)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $pais = Pais::findOrfail($id);
        error_log($request->name_country);
        error_log($pais->id);
        $pais->update($request->only('name_country'));
        return new TesteResource($pais);
    }


    public function destroy( $id)
    {
        $pais = Pais::findOrfail($id);
        $pais->delete();
        return new TesteResource($pais);
    }
}
