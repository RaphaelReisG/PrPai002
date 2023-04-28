<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vendedor;

use App\Models\Bairro;
use App\Models\Estado;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Endereco;

use App\Http\Resources\TesteResource;
use Spatie\LaravelIgnition\Recorders\LogRecorder\LogMessage;

use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->buscarObjeto)){
            if(isset($request->ordenacaoBusca)){
                error_log("com busca com ordenacao  ".$request->buscarObjeto);
                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    ->orderBy($request->ordenacaoBusca)
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'company_name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'cnpj', 'like', '%'.$request->buscarObjeto.'%')
                    ->paginate(4);
            }
            else{
                error_log("com busca sem ordenacao".$request->buscarObjeto);
                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'company_name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'cnpj', 'like', '%'.$request->buscarObjeto.'%')
                    ->paginate(4);
            }
        }
        else{
            if(isset($request->ordenacaoBusca)){
                error_log("sem busca com ordenacao ".$request->ordenacaoBusca);

                /*return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    ->orderBy($request->ordenacaoBusca)->paginate(4);*/


                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    //->leftJoin('vendedors', 'clientes.vendedor_id', '=', 'vendedors.id' ) //a melhorar
                    ->join('users', 'clientes.id', '=', 'users.userable_id' ) //a melhorar
                    ->select('clientes.*')
                    ->groupBy('clientes.id', 'clientes.name', 'company_name', 'cnpj', 'clientes.vendedor_id', 'clientes.created_at', 'clientes.updated_at')
                    //->distinct()
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);

            }
            else{
                error_log("sem busca sem ordenacao");
                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])->paginate(4);
                //return Cliente::with('user')->paginate(10);
            }
        }
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
        //Cliente::create($request->all());

        $cliente = Vendedor::findOrfail(1)->clientes()->create($request->only('name', 'cnpj', 'company_name'));
        $cliente->user()->create(['email'=> $request->email, 'password'=>Hash::make("123Mud@R$%")])->givePermissionTo('cliente');

        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //$obj = Cliente::with(['enderecos', 'vendedor', 'pedidos', 'telefones', 'user'])->findOrfail($id);


        //$obj['endereco']['bairro_id'] = Bairro::with('cidade')->findOrfail($obj['endereco']['bairro_id']);
        //$obj['endereco']['bairro_id']['cidade']['estado_id'] = Estado::with('pais')->findOrfail($obj['endereco']['bairro_id']['cidade']['estado_id']);
        //return $obj;

        return new TesteResource($cliente, $cliente->enderecos, $cliente->vendedor, $cliente->pedidos, $cliente->telefones,  $cliente->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //$obj = Cliente::findOrfail($id);
        //$obj->update($request->all());
        error_log("cliente nome ".$request->name);

        $cliente->update($request->only('name', 'cnpj', 'company_name'));
        if(isset($request->password)){
            $request->password = Hash::make($request->password);
        }
        $cliente->user()->update($request->only('email', 'password'));

        return new TesteResource($cliente, $cliente->user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(CLiente $cliente)
    {
        //$obj = Cliente::findOrfail($id);
        //$obj->delete();

        $cliente->user()->delete();
        $cliente->delete();

        return new TesteResource($cliente);
    }

    public function buscando(Request $request)
    {
        error_log("passou aki na busca");
        if(isset($request->buscarObjeto)){
            error_log("com busca ".$request->buscarObjeto);
            return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                ->orWhere( 'company_name', 'like', '%'.$request->buscarObjeto.'%')
                ->orWhere( 'cnpj', 'like', '%'.$request->buscarObjeto.'%')
                ->paginate(1);
        }
        else{
            error_log("deu ruim");
        }
    }
}
