<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Requests\FornecedorRequest;

use App\Http\Resources\TesteResource;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Fornecedor::all();

        $fornecedor = Fornecedor::with(['enderecos', 'telefones']);

        if ($request->has('buscarObjeto')) {
            $fornecedor->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('email', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('cnpj', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('company_name', 'like', '%' . $request->buscarObjeto . '%')
                      ;
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $fornecedor->orderBy($request->ordenacaoBusca);
        }

        if ($request->has('paginacao')) {
            return $fornecedor->get();
            //error_log('passou aki');
        }

        return $fornecedor->paginate(10);

        //return Fornecedor::with(['enderecos', 'telefones', ])->paginate(10);
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
    public function store(FornecedorRequest $request)
    {
        return Fornecedor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show( Fornecedor $fornecedor)
    {
        //return Fornecedor::findOrfail($id);
        return new TesteResource($fornecedor, $fornecedor->marcas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorRequest $request, Fornecedor $fornecedor)
    {
        //$obj = Fornecedor::findOrfail($id);
        $fornecedor->update($request->all());
        return $fornecedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy( Fornecedor $fornecedor)
    {
        $fornecedor->marcas()->delete();
        return $fornecedor->delete();
    }
}
