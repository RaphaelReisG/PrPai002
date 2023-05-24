<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Fornecedor;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Requests\EnderecoRequest;

use Illuminate\Support\Facades\DB;

use App\Http\Resources\TesteResource;
use Illuminate\Console\View\Components\Alert;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Endereco::all();
        //return Endereco::with(['enderecoable','bairro', 'bairro.cidade', 'bairro.cidade.estado', 'bairro.cidade.estado.pais' ])->paginate(10);

        $endereco = Endereco::with(['enderecoable','bairro', 'bairro.cidade', 'bairro.cidade.estado', 'bairro.cidade.estado.pais'])
        ->join('bairros', 'enderecos.bairro_id', '=', 'bairros.id' )
        ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id' )
        ->join('estados', 'cidades.estado_id', '=', 'estados.id' )
        ->join('pais', 'estados.pais_id', '=', 'pais.id' )
        //->join('enderecoable', 'enderecos.enderecoable_id', '=', 'enderecoable.id' )
        //->join('vendedors', 'enderecos.enderecoable_id', '=', 'vendedors.id' )
        //->join('clientes', 'enderecos.enderecoable_id', '=', 'clientes.id' )
        //->join('fornecedors', 'enderecos.enderecoable_id', '=', 'fornecedors.id' )
        ->select('enderecos.*')
        ->groupBy('enderecos.id', 'enderecos.name', 'enderecos.street_name', 'enderecos.complement',
            'enderecos.cep','enderecos.house_number','enderecos.bairro_id',
            'enderecos.enderecoable_type','enderecos.enderecoable_id', 'enderecos.created_at', 'enderecos.updated_at', 'enderecos.deleted_at');


        if ($request->has('buscarObjeto')) {
            $endereco->where(function ($query) use ($request) {
                $query->where('enderecos.street_name', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('enderecos.complement', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('enderecos.name', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('enderecos.house_number', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('enderecos.cep', 'like', '%' . $request->buscarObjeto . '%')

                ->orWhere('enderecos.enderecoable_type', 'like', '%' . $request->buscarObjeto . '%')
                //->orWhere('clientes.name', 'like', '%' . $request->buscarObjeto . '%')
                //->orWhere('vendedors.name', 'like', '%' . $request->buscarObjeto . '%')
                //->orWhere('fornecedors.name', 'like', '%' . $request->buscarObjeto . '%')

                ->orWhere('bairros.name_neighborhood', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('cidades.name_city', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('estados.name_state', 'like', '%' . $request->buscarObjeto . '%')
                ->orWhere('pais.name_country', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('vendedor_id')) {

            $subquery = DB::table('clientes')
                ->select('id')
                ->where('vendedor_id', '=', $request->vendedor_id);

            $endereco->where('enderecos.enderecoable_type', '=', 'App\\Models\\Cliente')
                ->whereIn('enderecos.enderecoable_id', $subquery);
        }

        if ($request->has('cliente_id')) {

            $subquery = DB::table('clientes')
                ->select('id')
                ->where('id', '=', $request->cliente_id);

            $endereco->where('enderecos.enderecoable_type', '=', 'App\\Models\\Cliente')
                ->whereIn('enderecos.enderecoable_id', $subquery);
        }

        if ($request->has('ordenacaoBusca')) {
            $endereco->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $endereco->get();
            //error_log('passou aki');
        }

        return $endereco->paginate(10);

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
    public function store(EnderecoRequest $request)
    {
        //Endereco::create($request->all());

        $bairro = Cidade::findOrFail($request->cidade_id)->bairros()->firstOrCreate(['name_neighborhood' => $request->name_neighborhood])->id;
        $request->merge(['bairro_id' => $bairro]);

        error_log($bairro);
        error_log($request->bairro_id);

        if($request->tipoUsuario == "cliente"){
            //error_log("telefone, passou cliente aki");
            return Cliente::find($request->enderecoable_id)->enderecos()->create($request->all());
        }else if($request->tipoUsuario == "vendedor"){
            return Vendedor::find($request->enderecoable_id)->enderecos()->create($request->all());
        }else if($request->tipoUsuario == "fornecedor"){
            return Fornecedor::find($request->enderecoable_id)->enderecos()->create($request->all());
        }
        else{
            error_log("Tipo usuario para add endereco não encontrado.".$request->tipoUsuario );
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
    public function update(EnderecoRequest $request,  Endereco $endereco)
    {
        //$obj = Endereco::findOrfail($id);
        //$obj->update($request->all());
        error_log($request->enderecoable_type);
        $bairro = Cidade::findOrFail($request->cidade_id)->bairros()->firstOrCreate(['name_neighborhood' => $request->name_neighborhood])->id;
        $request->merge(['bairro_id' => $bairro]);

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
