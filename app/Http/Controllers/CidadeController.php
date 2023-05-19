<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\CidadeRequest;

use App\Http\Resources\TesteResource;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Cidade::all();
        //return Cidade::with([ 'estado', 'estado.pais' ])->paginate(10);

        $cidade = Cidade::with([ 'estado',  'estado.pais'])
        ->join('estados', 'cidades.estado_id', '=', 'estados.id' )
        ->join('pais', 'estados.pais_id', '=', 'pais.id' )
        //->join('vendedors', 'clientes.vendedor_id', '=', 'vendedors.id' )
        ->select('cidades.*')
        ->groupBy('cidades.id', 'cidades.name_city', 'cidades.estado_id', 'cidades.created_at', 'cidades.updated_at');


        if ($request->has('buscarObjeto')) {
            $cidade->where(function ($query) use ($request) {
                $query->where('cidades.name_city', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('estados.name_state', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pais.name_country', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('estado_id')) {
            $cidade->where('cidades.estado_id', '=', $request->estado_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $cidade->orderBy($request->ordenacaoBusca);
        }

        else{
            $cidade->orderBy('cidades.name');
        }

        if ($request->has('paginacao')) {
            return $cidade->get();
            //error_log('passou aki');
        }

        return $cidade->paginate(10);
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
    public function store(CidadeRequest $request)
    {
        //Cidade::create($request->all());

        $cidade = Estado::findOrfail($request->estado_id)->cidades()->create($request->all());
        // Estado::create($request->all());
        return $cidade;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function show(Cidade $cidade)
    {
        //return $cidade->estado;
        return new TesteResource($cidade, $cidade->estado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Cidade $cidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(CidadeRequest $request, Cidade $cidade)
    {
        return $cidade->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cidade $cidade)
    {
        return $cidade->delete();
    }
}
