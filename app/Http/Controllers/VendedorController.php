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

        $topCidades = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('enderecos', 'pedidos.endereco_id', '=', 'enderecos.id')
            ->join('bairros', 'enderecos.bairro_id', '=', 'bairros.id')
            ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id')
            ->join('estados', 'cidades.estado_id', '=', 'estados.id')
            ->join('pais', 'estados.pais_id', '=', 'pais.id')
            ->select('cidades.id', 'cidades.name_city', 'estados.name_state', 'pais.name_country',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('cidades.id', 'cidades.name_city', 'estados.name_state', 'pais.name_country')
            ->get();

        foreach($topCidades as $p){
            $nome_cidades[] = $p->name_city.' - '.$p->name_state.' - '.$p->name_country;
            $valor_totalCidades[] = $p->valor_total;
        }

        $topBairros = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('enderecos', 'pedidos.endereco_id', '=', 'enderecos.id')
            ->join('bairros', 'enderecos.bairro_id', '=', 'bairros.id')
            ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id')
            ->join('estados', 'cidades.estado_id', '=', 'estados.id')
            ->join('pais', 'estados.pais_id', '=', 'pais.id')
            ->select('bairros.id', 'bairros.name_neighborhood','cidades.name_city', 'estados.name_state', 'pais.name_country',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('bairros.id', 'bairros.name_neighborhood','cidades.name_city', 'estados.name_state', 'pais.name_country')
            ->get();

        foreach($topBairros as $p){
            $nome_bairros[] = $p->name_neighborhood.' - '.$p->name_city.' - '.$p->name_state.' - '.$p->name_country;
            $valor_totalBairros[] = $p->valor_total;
        }

        $topEstados = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('enderecos', 'pedidos.endereco_id', '=', 'enderecos.id')
            ->join('bairros', 'enderecos.bairro_id', '=', 'bairros.id')
            ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id')
            ->join('estados', 'cidades.estado_id', '=', 'estados.id')
            ->join('pais', 'estados.pais_id', '=', 'pais.id')
            ->select('estados.id', 'estados.name_state', 'pais.name_country',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('estados.id', 'estados.name_state', 'pais.name_country')
            ->get();

        foreach($topEstados as $p){
            $nome_estados[] = $p->name_state.' - '.$p->name_country;
            $valor_totalEstados[] = $p->valor_total;
        }

        $topPais = $vendedor->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('enderecos', 'pedidos.endereco_id', '=', 'enderecos.id')
            ->join('bairros', 'enderecos.bairro_id', '=', 'bairros.id')
            ->join('cidades', 'bairros.cidade_id', '=', 'cidades.id')
            ->join('estados', 'cidades.estado_id', '=', 'estados.id')
            ->join('pais', 'estados.pais_id', '=', 'pais.id')
            ->select('pais.id', 'pais.name_country',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('pais.id', 'pais.name_country')
            ->get();

        foreach($topPais as $p){
            $nome_pais[] = $p->name_country;
            $valor_totalPais[] = $p->valor_total;
        }

        $resultado = [
            'top_produtos' => $topProdutos,
            'top_marcas' => $topMarcas,
            'top_clientes' => $topClientes,

            'top_bairros_json' => $topBairros,
            'top_bairros_nome_bairros' => $nome_bairros,
            'top_bairros_valor_total_bairros' => $valor_totalBairros,

            'top_cidades_json' => $topCidades,
            'top_cidades_nome_cidades' => $nome_cidades,
            'top_cidades_valor_total_cidades' => $valor_totalCidades,

            'top_estados_json' => $topEstados,
            'top_estados_nome_estados' => $nome_estados,
            'top_estados_valor_total_estados' => $valor_totalEstados,

            'top_pais_json' => $topPais,
            'top_pais_nome_pais' => $nome_pais,
            'top_pais_valor_total_pais' => $valor_totalPais,
        ];

        return json_encode($resultado);
    }

    public function analiseVendedorTotalPedidos(Request $request){
        //error_log("deu ruim");
        $vendedor = Vendedor::findOrfail($request['id']);
        // total de pedidos
        $totalPedidos = $vendedor->pedidos()->count();
        $totalPedidosAberto = $vendedor->pedidos()->where('approval_date', null)->count();
        $totalPedidosAprovado = $vendedor->pedidos()->where('approval_date', '!=', null)->where('delivery_date', null)->where('payday', null)->count();
        $totalPedidosEntregue = $vendedor->pedidos()->where('delivery_date', null)->count();
        $totalPedidosPago = $vendedor->pedidos()->where('payday', null)->count();
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
            ->whereNotNull('pedidos.delivery_date')
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

            'valor_total_clientes' => $totalClientes,

            'cliente' => [
                'total' => $totalClientes
            ],

            'pedido' => [
                'total' => $totalPedidos,
                'total_em_aberto' => $totalPedidosAberto,
                'total_aprovado' => $totalPedidosAprovado,
                'total_entregue' => $totalPedidosEntregue,
                'total_pago' => $totalPedidosPago,
                //'numero_total_pedidos_periodico_json' => $totalPedidosArray,
                'numero_total_pedidos_periodico_coluna_mes' => $mes_totalPedidosArray,
                'numero_total_pedidos_periodico_coluna_total' => $valor_totalPedidosArray,

                'valor_total_pedidos' => $valorTotalPedidos_total,
                'valor_total_pedidos_periodico_coluna_mes' => $mes_valorTotalPedidosArray,
                'valor_total_pedidos_periodico_coluna_total' => $valor_valorTotalPedidosArray,
            ],

            'produto' => [
                'total_pacotes_entregues' => $totalProdutos,

                //'numero_total_produtos_periodico_json' => $totalProdutosPeriodico,
                'numero_total_produtos_periodico_coluna_mes' => $mes_totalProdutosPeriodico,
                'numero_total_produtos_periodico_coluna_total' => $valor_totalProdutosPeriodico,
            ],


        ];

        return json_encode($resultado);
    }
}
