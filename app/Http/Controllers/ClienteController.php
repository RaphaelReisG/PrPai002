<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vendedor;

use App\Models\Bairro;
use App\Models\Estado;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

use Illuminate\Support\Facades\DB;

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

        $clientes = Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
            ->join('users', 'clientes.id', '=', 'users.userable_id' )
            //->join('vendedors', 'clientes.vendedor_id', '=', 'vendedors.id' )
            ->select('clientes.*')
            ->groupBy('clientes.id', 'clientes.name', 'company_name', 'cnpj', 'clientes.vendedor_id', 'clientes.created_at', 'clientes.updated_at', 'clientes.deleted_at');

        if ($request->has('buscarObjeto')) {
            $clientes->where(function ($query) use ($request) {
                $query->where('clientes.name', 'like', '%' . $request->buscarObjeto . '%')
                    ->orWhere('clientes.company_name', 'like', '%' . $request->buscarObjeto . '%')
                    ->orWhere('clientes.cnpj', 'like', '%' . $request->buscarObjeto . '%')
                    ->orWhere('users.email', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('vendedor_id')) {
            $clientes->where('clientes.vendedor_id', '=', $request->vendedor_id);
        }

        if ($request->has('ordenacaoBusca')) {
            $clientes->orderBy($request->ordenacaoBusca);
        }

        else{
            $clientes->orderBy('clientes.name');
        }

        if ($request->has('paginacao')) {
            return $clientes->get();
            //error_log('passou aki');
        }

        return $clientes->paginate(4);



        /*
        if(isset($request->buscarObjeto)){
            if(isset($request->ordenacaoBusca)){
                error_log("com busca com ordenacao  ".$request->buscarObjeto);
                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'company_name', 'like', '%'.$request->buscarObjeto.'%')
                    ->orWhere( 'cnpj', 'like', '%'.$request->buscarObjeto.'%')
                    ->join('users', 'clientes.id', '=', 'users.userable_id' )
                    ->select('clientes.*')
                    ->groupBy('clientes.id', 'clientes.name', 'company_name', 'cnpj', 'clientes.vendedor_id', 'clientes.created_at', 'clientes.updated_at')
                    ->orderBy($request->ordenacaoBusca)
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




                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])
                    ->join('users', 'clientes.id', '=', 'users.userable_id' )
                    ->select('clientes.*')
                    ->groupBy('clientes.id', 'clientes.name', 'company_name', 'cnpj', 'clientes.vendedor_id', 'clientes.created_at', 'clientes.updated_at')
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);

            }
            else{
                error_log("sem busca sem ordenacao");
                return Cliente::with(['user', 'vendedor', 'enderecos', 'telefones'])->paginate(4);
            }
        }*/
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
    public function store(ClienteRequest $request)
    {
        //Cliente::create($request->all());

        //$cliente = Vendedor::findOrfail($request->vendedor_id)->clientes()->create($request->only('name', 'cnpj', 'company_name'));
        $cliente = Cliente::create($request->only('name', 'cnpj', 'company_name', 'vendedor_id'));
        $cliente->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password)])->givePermissionTo('cliente');

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
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        //$obj = Cliente::findOrfail($id);
        //$obj->update($request->all());
        error_log("cliente nome ".$request->name);

        $cliente->update($request->only('name', 'cnpj', 'company_name'));
        if(isset($request->password)){
            //error_log("senha".$request->password);
            //$request->password = Hash::make($request->password);
            //error_log("senha".Hash::make($request->password));

            $cliente->user()->update(['password' => Hash::make($request->password)]);
        }
        $cliente->user()->update($request->only('email'));

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

    public function analiseClienteTopProdutos(Request $request){
        //error_log("deu ruim");
        $cliente = Cliente::findOrfail($request['id']);
        $topProdutos = $cliente->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->select('produtos.id', 'produtos.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('produtos.id', 'produtos.name')
            ->get();

        $topMarcas = $cliente->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('marcas', 'marca_id', '=', 'marcas.id')
            ->select('marcas.id', 'marcas.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('marcas.id', 'marcas.name')
            ->get();

        //return new TesteResource($topMarcas);



        $resultado = [
            'top_produtos' => $topProdutos,
            'top_marcas' => $topMarcas
        ];

        return json_encode($resultado);
    }

    public function analiseClienteTotalPedidos(Request $request){
        //error_log("deu ruim");
        $cliente = Cliente::findOrfail($request['id']);
        // total de pedidos
        $totalPedidos = $cliente->pedidos()->count();
        $totalPedidosAberto = $cliente->pedidos()->where('approval_date', null)->count();
        $totalPedidosAprovado = $cliente->pedidos()->where('approval_date', '!=', null)->where('delivery_date', null)->where('payday', null)->count();
        $totalPedidosEntregue = $cliente->pedidos()->where('delivery_date', null)->count();
        $totalPedidosPago = $cliente->pedidos()->where('payday', null)->count();

        //total de pedidos periodico
        $totalPedidosArray = $cliente->pedidos()->select([
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
        $valorTotalPedidos_price = $cliente->pedidos()->sum('total_price');
        $valorTotalPedidos_discount = $cliente->pedidos()->sum('total_discount');
        $valorTotalPedidos_total = $valorTotalPedidos_price - $valorTotalPedidos_discount;

        $valorTotalPedidosPeriodico = $cliente->pedidos()
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
        /*$totalProdutos = $cliente->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->sum('pedido_produto.qty_item');*/

        $totalProdutos = $cliente->pedidos()
            ->join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->whereNotNull('pedidos.delivery_date')
            ->sum('pedido_produto.qty_item');
        //total de periodico
        $totalProdutosPeriodico = $cliente->pedidos()
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
