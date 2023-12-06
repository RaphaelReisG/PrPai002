<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoRequest;

use App\Http\Resources\TesteResource;
use App\Models\Marca;

use Illuminate\Support\Facades\Storage;

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

        $produto = Produto::with(['marca', 'marca.fornecedor', 'estoques', 'tipo_produto'])
            ->join('marcas', 'produtos.marca_id', '=', 'marcas.id' )
            ->join('fornecedors', 'marcas.fornecedor_id', '=', 'fornecedors.id' )
            ->join('tipo_produtos', 'produtos.tipo_produto_id', '=', 'tipo_produtos.id' )
            ->select('produtos.*')
            ->groupBy('produtos.id', 'produtos.name', 'produtos.tipo_produto_id',
                'produtos.quantity', 'produtos.weight', 'produtos.cost_price',
                'produtos.sale_price', 'produtos.marca_id',  'produtos.created_at', 'produtos.updated_at', 'produtos.deleted_at');

        if ($request->has('buscarObjeto')) {
            $produto->where(function ($query) use ($request) {
                $query->where('produtos.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('tipo_produtos.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.quantity', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.weight', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.cost_price', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('produtos.sale_price', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('marcas.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('fornecedors.name', 'like', '%' . $request->buscarObjeto . '%')
                      ;
            });
        }

        if ($request->has('marca_id')) {
            $produto->where('produtos.marca_id', '=', $request->marca_id);
            error_log('passou aki no produto');
        }

        if ($request->has('ordenacaoBusca')) {
            $produto->orderBy($request->ordenacaoBusca);
        }

        else{
            $produto->orderBy('produtos.name');
        }

        if ($request->has('paginacao')) {
            return $produto->get();
            //error_log('passou aki');
        }

        return $produto->withSum('estoques', 'qty_item')->paginate(10);

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
    public function store(ProdutoRequest $request)
    {
        $produto = Marca::findOrfail($request->marca_id)->produtos()->create($request->all());

        if($request->hasFile('file_image')){
            error_log('tem arquivo');
            $idProduto = $produto->id;
            error_log('id: '.$idProduto);
            $nomeProduto = $produto->name;
            error_log('nome: '.$nomeProduto);

            $nomeArquivo = $idProduto . '_' . str_replace(' ', '_', $nomeProduto) . '.' . $request->file('file_image')->getClientOriginalExtension();
            error_log('nome arquivo: '.$nomeArquivo);
            $path = $request->file('file_image')->storeAs('uploads', $nomeArquivo, 'public');

            $produto->image_name = $path;
            $produto->save();
        }
        error_log('NÂO tem arquivo');
        return $produto;
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
    public function update(ProdutoRequest $request, Produto $produto)
    {
        //$obj = Produto::findOrfail($id);
        $produto->update($request->all());
        //$produto->marca()->update($request->all());

        if($request->hasFile('file_image')){

            if($produto->image_name !== null){
                error_log('já tinha um arquivo');
                $caminhoDoArquivo = "storage/".$produto->image_name;
                Storage::delete($caminhoDoArquivo);
            }

            error_log('tem arquivo');
            $idProduto = $produto->id;
            error_log('id: '.$idProduto);
            $nomeProduto = $produto->name;
            error_log('nome: '.$nomeProduto);

            $nomeArquivo = $idProduto . '_' . str_replace(' ', '_', $nomeProduto) . '.' . $request->file('file_image')->getClientOriginalExtension();
            error_log('nome arquivo: '.$nomeArquivo);
            $path = $request->file('file_image')->storeAs('uploads', $nomeArquivo, 'public');

            $produto->image_name = $path;
            $produto->save();
        }
        error_log('NÂO tem arquivo');
        return $produto;




    }



    public function updatei(ProdutoRequest $request, Produto $produto)
    {
        error_log('updatei');
        //$obj = Produto::findOrfail($id);
        $produto->update($request->all());
        //$produto->marca()->update($request->all());

        if($request->hasFile('file_image')){

            if($produto->image_name !== null){
                error_log('já tinha um arquivo');
                $caminhoDoArquivo = "storage/".$produto->image_name;
                Storage::delete($caminhoDoArquivo);
            }

            error_log('tem arquivo');
            $idProduto = $produto->id;
            error_log('id: '.$idProduto);
            $nomeProduto = $produto->name;
            error_log('nome: '.$nomeProduto);

            $nomeArquivo = $idProduto . '_' . str_replace(' ', '_', $nomeProduto) . '.' . $request->file('file_image')->getClientOriginalExtension();
            error_log('nome arquivo: '.$nomeArquivo);
            $path = $request->file('file_image')->storeAs('uploads', $nomeArquivo, 'public');

            $produto->image_name = $path;
            $produto->save();
        }
        error_log('NÂO tem arquivo');
        return $produto;




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
