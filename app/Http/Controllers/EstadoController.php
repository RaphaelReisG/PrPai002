<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Requests\estadoRequest;

use App\Http\Resources\TesteResource;
use App\Models\Pais;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Estado::all();
        //return Estado::with([ 'pais' ])->paginate(10);

        $estado = Estado::with([ 'pais' ])
        ->join('pais', 'estados.pais_id', '=', 'pais.id' )
        //->join('vendedors', 'clientes.vendedor_id', '=', 'vendedors.id' )
        ->select('estados.*')
        ->groupBy('estados.id', 'estados.name_state', 'estados.pais_id', 'estados.created_at', 'estados.updated_at');


        if ($request->has('buscarObjeto')) {
            $estado->where(function ($query) use ($request) {
                $query->where('estados.name_state', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pais.name_country', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('pais_id')) {
            $estado->where('estados.pais_id', '=', $request->pais_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $estado->orderBy($request->ordenacaoBusca);
        }

        else{
            $estado->orderBy('estados.name');
        }

        if ($request->has('paginacao')) {
            return $estado->get();
            //error_log('passou aki');
        }

        return $estado->paginate(10);
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
    public function store(estadoRequest $request)
    {
        $estado = Pais::findOrfail($request->pais_id)->estados()->create($request->only('name_state'));
        // Estado::create($request->all());
        return $estado;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //return Estado::findOrfail($id);
        return new TesteResource($estado, $estado->pais);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(estadoRequest $request,  Estado $estado)
    {
        //$obj = Estado::findOrfail($id);
        $estado->update($request->all());
        return $estado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy( Estado $estado)
    {
        //$obj = Estado::findOrfail($id);
        $estado->delete();
    }
}
