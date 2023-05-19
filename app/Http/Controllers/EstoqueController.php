<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Administrador;
use Illuminate\Http\Request;
use App\Http\Requests\EstoqueRequest;


use App\Http\Resources\TesteResource;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $estoque = Estoque::with(['produto', 'produto.marca', 'produto.marca.fornecedor', 'estoqueable', 'tipo_movimentacao'])->paginate(10);
    
        $estoque = Estoque::with(['produto', 'produto.marca', 'produto.marca.fornecedor', 'estoqueable', 'tipo_movimentacao'])
            ->join('produtos', 'estoques.produto_id', '=', 'produtos.id' )
            ->join('marcas', 'produtos.marca_id', '=', 'marcas.id' )
            ->join('fornecedors', 'marcas.fornecedor_id', '=', 'fornecedors.id' )
            ->join('tipo_movimentacaos', 'estoques.tipo_movimentacao_id', '=', 'tipo_movimentacaos.id' )
            ->join('administradors', 'estoques.estoqueable_id', '=', 'administradors.id' )
            //->join('pedidos', 'estoques.estoqueable_id', '=', 'administradors.id' )
            //->join('tipo_produtos', 'produtos.tipo_produto_id', '=', 'tipo_produtos.id' )
            ->select('estoques.*')
            ->groupBy('estoques.id', 'estoques.qty_item', 'estoques.observation',
                'estoques.tipo_movimentacao_id', 'estoques.produto_id', 'estoques.estoqueable_type',
                'estoques.estoqueable_id',  'estoques.created_at', 'estoques.updated_at');

        if ($request->has('buscarObjeto')) {
            $estoque->where(function ($query) use ($request) {
                $query->where('estoques.qty_item', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('estoques.observation', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('tipo_movimentacaos.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('estoques.estoqueable_type', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('administradors.name', 'like', '%' . $request->buscarObjeto . '%')
                      ;
            });
        }

        /*if ($request->has('marca_id')) {
            $estoque->where('produtos.marca_id', '=', $request->marca_id);
            error_log('passou aki no produto');
        }*/

        if ($request->has('ordenacaoBusca')) {
            $estoque->orderBy($request->ordenacaoBusca);
        }

        else{
            $estoque->orderBy('estoques.name');
        }

        if ($request->has('paginacao')) {
            return $estoque->get();
            //error_log('passou aki');
        }

        return $estoque->paginate(10);
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
    public function store(EstoqueRequest $request)
    {
        if($request->requisitante == 'AppModelsAdministrador'){
            //error_log("Estoque - opa passou aki dentro");
            return $estoque = Administrador::findOrfail($request->estoqueable_id)->estoqueable()->create($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function show(Estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function update(EstoqueRequest $request, Estoque $estoque)
    {
        return $estoque->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estoque  $estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estoque $estoque)
    {
        return $estoque->delete();
    }
}
