<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Fornecedor;
use App\Models\Cidade;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Endereco::all();
        return Endereco::with(['enderecoable','bairro', 'bairro.cidade', 'bairro.cidade.estado', 'bairro.cidade.estado.pais' ])->paginate(10);
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
        //Endereco::create($request->all());

        $bairro = Cidade::findOrFail($request->city_id)->bairros()->firstOrCreate($request->name_neighborhood)->id;
        $request->neighborhood_id = $bairro;

        if($request->tipoUsuario == "AppModelsCliente"){
            //error_log("telefone, passou cliente aki");
            return Cliente::find($request->enderecoable_id)->enderecos()->create($request->all());
        }else if($request->tipoUsuario == "AppModelsVendedor"){
            return Vendedor::find($request->enderecoable_id)->enderecos()->create($request->all());
        }else if($request->tipoUsuario == "AppModelsFornecedor"){
            return Fornecedor::find($request->enderecoable_id)->enderecos()->create($request->all());
        }
        else{
            error_log("Tipo usuario para add telefone não encontrado.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function show( Endereco $endereco)
    {
        //return Endereco::with('bairro')->findOrfail($id);
        return new TesteResource($endereco, $endereco->bairro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Endereco $endereco)
    {
        //$obj = Endereco::findOrfail($id);
        //$obj->update($request->all());

        $bairro = Cidade::findOrFail($request->city_id)->bairros()->firstOrCreate($request->name_neighborhood)->id;
        $request->neighborhood_id = $bairro;

        return $endereco->update($request->all());
        /*$endereco->bairro()->update($request->only('name_neighborhood'));
        $endereco->bairro()->cidade()->update($request->only('name_city'));
        $endereco->bairro()->cidade()->estado()->update($request->only('name_state'));
        $endereco->bairro()->cidade()->estado()->pais()->update($request->only('name_country'));*/

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Endereco  $endereco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Endereco $endereco)
    {
        //$obj = Endereco::findOrfail($id);
        //$obj->delete();
        return $endereco->delete();
    }
}
