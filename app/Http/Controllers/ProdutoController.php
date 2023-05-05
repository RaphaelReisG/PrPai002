<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

use App\Http\Resources\TesteResource;
use App\Models\Marca;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Produto::all();

        $produto = Produto::with(['marca', 'marca.fornecedor', 'estoques'])
            ->join('marcas', 'produtos.marca_id', '=', 'marcas.id' )
            ->join('fornecedors', 'marcas.fornecedor_id', '=', 'fornecedors.id' )
            ->select('produtos.*')
            ->groupBy('produtos.id', 'produtos.name', 'produtos.type',
                'produtos.quantity', 'produtos.weight', 'produtos.cost_price',
                'produtos.sale_price', 'produtos.marca_id',  'produtos.created_at', 'produtos.updated_at');

        if ($request->has('buscarObjeto')) {
            $produto->where(function ($query) use ($request) {
                $query->where('produtos.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.type', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.quantity', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.weight', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.cost_price', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.sale_price', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('marcas.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('fornecedors.name', 'like', '%' . $request->buscarObjeto . '%')
                      ;
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $produto->orderBy($request->ordenacaoBusca);
        }

        return $produto->withSum('estoques', 'qty_item')->paginate(4);

        //return Produto::with(['marca', 'marca.fornecedor', 'estoques' ])->withSum('estoques', 'qty_item')->paginate(10);
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
        return $produto = Marca::findOrfail($request->marca_id)->produtos()->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //return Produto::findOrfail($id);
        //return $produto->withSum('estoques', 'qty_item')->get();
        return new TesteResource($produto, $produto->marca, $produto->estoques);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //$obj = Produto::findOrfail($id);
        return $produto->update($request->all());
        //$produto->marca()->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Produto $produto)
    {
        //$obj = Produto::findOrfail($id);
        return $produto->delete();
    }
}
