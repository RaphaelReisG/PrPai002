<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Requests\paisRequest;
use App\Http\Resources\TesteResource;

class PaisController extends Controller
{

    public function index(Request $request)
    {
        //return Pais::all();
        //return Pais::paginate(10);

        $pais = Pais::with([ 'estados' ]);

        if ($request->has('buscarObjeto')) {
            $pais->where(function ($query) use ($request) {
                $query->where('pais.name_country', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $pais->orderBy($request->ordenacaoBusca);
        }

        else{
            $pais->orderBy('pais.name');
        }

        if ($request->has('paginacao')) {
            return $pais->get();
            //error_log('passou aki');
        }

        return $pais->paginate(10);


    }


    public function create()
    {
        //
    }


    public function store(paisRequest $request)
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


    public function update(paisRequest $request, $id)
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
