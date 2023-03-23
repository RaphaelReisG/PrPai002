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
    public function index()
    {
        return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])->paginate(1);
        //return Cliente::with('user')->paginate(10);
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
}
