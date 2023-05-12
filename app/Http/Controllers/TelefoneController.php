<?php

namespace App\Http\Controllers;

use App\Models\Telefone;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\TelefoneRequest;

use App\Http\Resources\TesteResource;

class TelefoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Telefone::all();
        return Telefone::with(['telefoneable'])->paginate(10);
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

        if($request->tipoUsuario == "AppModelsCliente"){
            error_log("telefone, passou cliente aki");
            return Cliente::find($request->idUsuario)->telefones()->create($request->only('number_phone'));
        }else if($request->tipoUsuario == "AppModelsVendedor"){

        }else if($request->tipoUsuario == "AppModelsFornecedor"){

        }
        else{
            error_log("Tipo usuario para add telefone não encontrado.");
        }

        Telefone::create($request->all());
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
    public function update(Request $request, Telefone $telefone)
    {
        $telefone->update($TelefoneRequest->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telefone  $telefone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telefone $telefone)
    {
        $telefone->delete();
    }
}
