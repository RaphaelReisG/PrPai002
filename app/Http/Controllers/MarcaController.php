<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use App\Http\Requests\marcaRequest;

use App\Http\Resources\TesteResource;

use App\Models\Fornecedor;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Marca::all();
        $marca = Marca::with(['fornecedor'])
            ->join('fornecedors', 'marcas.fornecedor_id', '=', 'fornecedors.id' )
            ->select('marcas.*')
            ->groupBy('marcas.id', 'marcas.name', 'marcas.fornecedor_id', 'marcas.created_at', 'marcas.updated_at', 'marcas.deleted_at');

        if ($request->has('buscarObjeto')) {
            $marca->where(function ($query) use ($request) {
                $query->where('marcas.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('fornecedors.name', 'like', '%' . $request->buscarObjeto . '%')
                      ;
            });
        }

        if ($request->has('fornecedor_id')) {
            $marca->where('marcas.fornecedor_id', '=', $request->fornecedor_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $marca->orderBy($request->ordenacaoBusca);
        }

        else{
            $marca->orderBy('marcas.name');
        }

        if ($request->has('paginacao')) {
            return $marca->get();
            //error_log('passou aki');
        }

        return $marca->paginate(10);


        //return Marca::with(['fornecedor' ])->paginate(10);
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
    public function store(marcaRequest $request)
    {
        return $marca = Fornecedor::findOrfail($request->fornecedor_id)->marcas()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show( Marca $marca)
    {
        //return Marca::findOrfail($id);
        return new TesteResource($marca, $marca->produtos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(marcaRequest $request,  Marca $marca)
    {
        //$obj = Marca::findOrfail($id);
        return $marca->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy( Marca $marca)
    {
        //$obj = Marca::findOrfail($id);
        return $marca->delete();
    }
}
