<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use App\Http\Requests\VendedorRequest;

use App\Http\Resources\TesteResource;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Vendedor::with(['user','enderecos', 'telefones'])->paginate(10);

        $vendedor = Vendedor::with(['user','enderecos', 'telefones'])
            ->join('users', 'vendedors.id', '=', 'users.userable_id' )
            ->select('vendedors.*')
            ->groupBy('vendedors.id', 'vendedors.name', 'vendedors.created_at', 'vendedors.updated_at', 'vendedors.deleted_at');

        if ($request->has('buscarObjeto')) {
            $vendedor->where(function ($query) use ($request) {
                $query->where('vendedors.name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('users.email', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $vendedor->orderBy($request->ordenacaoBusca);
        }

        else{
            $vendedor->orderBy('vendedors.name');
        }

        if ($request->has('paginacao')) {
            return $vendedor->get();
            //error_log('passou aki');
        }

        return $vendedor->paginate(10);
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
    public function store(VendedorRequest $request)
    {
        $vendedor = Vendedor::create($request->only('name'));
        $vendedor->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password)])->givePermissionTo('vendedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Vendedor $vendedor)
    {
        return new TesteResource($vendedor, $vendedor->enderecos, $vendedor->clientes, $vendedor->telefones,  $vendedor->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(VendedorRequest $request, Vendedor $vendedor)
    {
        //$obj = Vendedor::findOrfail($id);
        //$obj->update($request->all());

        $vendedor->update($request->all());
        if(isset($request->password)){
            $vendedor->user()->update(['password' => Hash::make($request->password)]);
        }
        $vendedor->user()->update($request->only('email'));

        return new TesteResource($vendedor, $vendedor->user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy( Vendedor $vendedor)
    {
        //$obj = Vendedor::findOrfail($id);
        //$obj->delete();

        $vendedor->enderecos()->delete();
        $vendedor->telefones()->delete();
        $vendedor->user()->delete();
        $vendedor->delete();

        return new TesteResource($vendedor);
    }

    public function numeroParaMes($numero) {
        $meses = [
          1 => "Janeiro",
          2 => "Fevereiro",
          3 => "Março",
          4 => "Abril",
          5 => "Maio",
          6 => "Junho",
          7 => "Julho",
          8 => "Agosto",
          9 => "Setembro",
          10 => "Outubro",
          11 => "Novembro",
          12 => "Dezembro"
        ];

        // Verifica se o número está dentro do intervalo válido (1 a 12)
        if ($numero >= 1 && $numero <= 12) {
          return $meses[$numero];
        } else {
          return "Número de mês inválido";
        }
    }

    public function analiseVendedorTopProdutos(Request $request){
        //error_log("deu ruim");
        $vendedor = Vendedor::findOrfail($request['id']);
        $topProdutos = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->select('produtos.id', 'produtos.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('produtos.id', 'produtos.name')
            ->get();

        $topMarcas = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('marcas', 'marca_id', '=', 'marcas.id')
            ->select('marcas.id', 'marcas.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('marcas.id', 'marcas.name')
            ->get();

        $topClientes = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('clientes', 'cliente_id', '=', 'clientes.id')
            ->select('clientes.id', 'clientes.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('clientes.id', 'clientes.name')
            ->get();

        $resultado = [
            'top_produtos' => $topProdutos,
            'top_marcas' => $topMarcas,
            'top_clientes' => $topClientes
        ];

        return json_encode($resultado);
    }

    public function analiseVendedorTotalPedidos(Request $request){
        //error_log("deu ruim");
        $vendedor = Vendedor::findOrfail($request['id']);
        // total de pedidos
        $totalPedidos = $vendedor->pedidos()->count();
        //total de pedidos periodico
        $totalPedidosArray = $vendedor->pedidos()->select([
            DB::raw('YEAR(pedidos.created_at) as ano'),
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('COUNT(*) as total')
        ])
        ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

        foreach($totalPedidosArray as $p){
            $mes_totalPedidosArray[] = $this->numeroParaMes($p->mes)."/".$p->ano;
            $valor_totalPedidosArray[] = $p->total;
        }

        //valor $$ total dos pedidos
        $valorTotalPedidos_price = $vendedor->pedidos()->sum('total_price');
        $valorTotalPedidos_discount = $vendedor->pedidos()->sum('total_discount');
        $valorTotalPedidos_total = $valorTotalPedidos_price - $valorTotalPedidos_discount;

        $valorTotalPedidosPeriodico = $vendedor->pedidos()
            ->select([
                DB::raw('YEAR(pedidos.created_at) as ano'),
                DB::raw('MONTH(pedidos.created_at) as mes'),
                DB::raw('SUM(pedidos.total_price - pedidos.total_discount) as total')
            ])
            ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

            foreach($valorTotalPedidosPeriodico as $p){
                $mes_valorTotalPedidosArray[] = $this->numeroParaMes($p->mes)."/".$p->ano;
                $valor_valorTotalPedidosArray[] = $p->total;
            }

        //total de pacotes
        $totalProdutos = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->sum('pedido_produto.qty_item');
        //total de periodico
        $totalProdutosPeriodico = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->select([
                DB::raw('YEAR(pedidos.created_at) as ano'),
                DB::raw('MONTH(pedidos.created_at) as mes'),
                DB::raw('SUM(pedido_produto.qty_item) as total')
            ])
            ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

        foreach($totalProdutosPeriodico as $p){
            //$ano_totalProdutosPeriodico[] = $p->ano;
            $mes_totalProdutosPeriodico[] = $this->numeroParaMes($p->mes)."/".$p->ano;
            $valor_totalProdutosPeriodico[] = $p->total;
        }

        // total de clientes
        $totalClientes = $vendedor->clientes()->count();

        //cria json
        $resultado = [
            'numero_total_pedidos' => $totalPedidos,
            'numero_total_pedidos_periodico_json' => $totalPedidosArray,
            'numero_total_pedidos_periodico_coluna_mes' => $mes_totalPedidosArray,
            'numero_total_pedidos_periodico_coluna_total' => $valor_totalPedidosArray,

            'numero_total_produtos' => $totalProdutos,
            'numero_total_produtos_periodico_json' => $totalProdutosPeriodico,
            //'numero_total_produtos_periodico_coluna_ano' => $ano_totalProdutosPeriodico,
            'numero_total_produtos_periodico_coluna_mes' => $mes_totalProdutosPeriodico,
            'numero_total_produtos_periodico_coluna_total' => $valor_totalProdutosPeriodico,

            'valor_total_pedidos' => $valorTotalPedidos_total,
            //'valor_total_price' => $valorTotalPedidos_price,
            //'valor_total_discount' => $valorTotalPedidos_discount,
            'valor_total_pedidos_periodico_coluna_mes' => $mes_valorTotalPedidosArray,
            'valor_total_pedidos_periodico_coluna_total' => $valor_valorTotalPedidosArray,

            'valor_total_clientes' => $totalClientes
        ];

        return json_encode($resultado);
    }

    public function analiseVendedorTotalProdutos(Request $request){
        //error_log("deu ruim");
        $cliente = Vendedor::findOrfail($request['id']);
        $obj = $cliente->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->sum('pedido_produto.qty_item');

        $resultado = [
            'numero_total_produtos' => $obj,
        ];

        return json_encode($resultado);
    }
}
