<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\TelefoneRequest;

use Illuminate\Support\Facades\DB;

use App\Http\Resources\TesteResource;

class TelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Telefone::all();
        //return Telefone::with(['telefoneable'])->paginate(10);

        $telefone = Telefone::with([ 'telefoneable' ]);
        /*->join('clientes', function ($join) {
            $join->on('telefones.telefoneable_id', '=', 'clientes.id')
                ->where('telefones.telefoneable_type', '=', "App\Models\Cliente");
        })
        ->join('vendedors', function ($join) {
            $join->on('telefones.telefoneable_id', '=', 'vendedors.id')
                ->where('telefones.telefoneable_type', '=', "App\Models\Vendedor");
        })
        ->join('fornecedors', function ($join) {
            $join->on('telefones.telefoneable_id', '=', 'fornecedors.id')
                ->where('telefones.telefoneable_type', '=', "App\Models\Fornecedor");
        })*/
        //->join('vendedors', 'telefones.telefoneable_id', '=', 'vendedors.id' )
        //->join('clientes', 'telefones.telefoneable_id', '=', 'clientes.id' )
        //->join('fornecedors', 'telefones.telefoneable_id', '=', 'fornecedors.id' )
        //->select('telefones.*')
        //->groupBy('telefones.id', 'telefones.number_phone', 'telefones.telefoneable_id', 'telefones.telefoneable_type', 'telefones.created_at', 'telefones.updated_at');


        if ($request->has('buscarObjeto')) {
            $telefone->where(function ($query) use ($request) {
                $query->where('telefones.number_phone', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('telefones.telefoneable_type', 'like', '%' . $request->buscarObjeto . '%');
                //->orWhere('clientes.name', 'like', '%' . $request->buscarObjeto . '%')
                //->orWhere('vendedors.name', 'like', '%' . $request->buscarObjeto . '%')
                //->orWhere('fornecedors.name', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('vendedor_id')) {

            $subquery = DB::table('clientes')
                ->select('id')
                ->where('vendedor_id', '=', $request->vendedor_id);

            $telefone->where('telefones.telefoneable_type', '=', 'App\\Models\\Cliente')
                ->whereIn('telefones.telefoneable_id', $subquery);

        }

        if ($request->has('cliente_id')) {

            $subquery = DB::table('clientes')
                ->select('id')
                ->where('id', '=', $request->cliente_id);

            $telefone->where('telefones.telefoneable_type', '=', 'App\\Models\\Cliente')
                ->whereIn('telefones.telefoneable_id', $subquery);

        }

        if ($request->has('ordenacaoBusca')) {
            $telefone->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $telefone->get();
            //error_log('passou aki');
        }

        return $telefone->paginate(10);
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
    public function store(TelefoneRequest $request)
    {
        if($request->tipoUsuario == "cliente"){
            //error_log("telefone, passou cliente aki");
            return Cliente::find($request->telefoneable_id)->telefones()->create($request->only('number_phone'));
        }else if($request->tipoUsuario == "vendedor"){
            return Vendedor::find($request->telefoneable_id)->telefones()->create($request->only('number_phone'));
        }else if($request->tipoUsuario == "fornecedor"){
            return Fornecedor::find($request->telefoneable_id)->telefones()->create($request->only('number_phone'));
        }
        else{
            error_log("Tipo usuario para add telefone não encontrado.");
        }

        //Telefone::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function show(Telefone $telefone)
    {
        return $telefone;
        return new TesteResource($telefone, $telefone->telefoneable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function edit(Telefone $telefone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function update(TelefoneRequest $request, Telefone $telefone)
    {
        return $telefone->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telefone $telefone)
    {
        return $telefone->delete();
    }
}
