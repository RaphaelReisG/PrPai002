<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Requests\bairroRequest;

use App\Http\Resources\TesteResource;

class BairroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Bairro::all();
        //return Bairro::with(['cidade', 'cidade.estado', 'cidade.estado.pais' ])->paginate(10);

        $bairro = Bairro::with(['cidade', 'cidade.estado', 'cidade.estado.pais'])
        ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id' )
        ->join('estados', 'cidades.estado_id', '=', 'estados.id' )
        ->join('pais', 'estados.pais_id', '=', 'pais.id' )
        //->join('vendedors', 'clientes.vendedor_id', '=', 'vendedors.id' )
        ->select('bairros.*')
        ->groupBy('bairros.id', 'bairros.name_neighborhood', 'bairros.cidade_id', 'bairros.created_at', 'bairros.updated_at', 'bairros.deleted_at');


        if ($request->has('buscarObjeto')) {
            $bairro->where(function ($query) use ($request) {
                $query->where('bairros.name_neighborhood', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('cidades.name_city', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('estados.name_state', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pais.name_country', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('cidade_id')) {
            $bairro->where('bairros.cidade_id', '=', $request->cidade_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $bairro->orderBy($request->ordenacaoBusca);
        }

        else{
            $bairro->orderBy('bairros.name_neighborhood');
        }

        if ($request->has('paginacao')) {
            return $bairro->get();
            //error_log('passou aki');
        }

        return $bairro->paginate(10);

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
    public function store(bairroRequest $request)
    {
        //Bairro::create($request->all());
        return $bairro = Cidade::findOrfail($request->cidade_id)->bairros()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bairro  $bairro
     * @return \Illuminate\Http\Response
     */
    public function show(Bairro  $bairro)
    {
        //$bairro = $bairro->cidade;
        //return [$bairro->cidade ];
        return new TesteResource($bairro, $bairro->cidade);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bairro  $bairro
     * @return \Illuminate\Http\Response
     */
    public function edit(Bairro $bairro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bairro  $bairro
     * @return \Illuminate\Http\Response
     */
    public function update(bairroRequest $request,  Bairro $bairro)
    {
        return $bairro->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bairro  $bairro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bairro $bairro)
    {
        //$obj = Bairro::findOrfail($id);
        return $bairro->delete();
    }
}
