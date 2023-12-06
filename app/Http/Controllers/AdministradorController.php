<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use App\Http\Requests\AdministradorRequest;

use App\Http\Resources\TesteResource;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\Models\Pedido;

use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Fornecedor;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Tipo_produto;
use App\Models\Telefone;

use App\Models\Pais;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Bairro;
use App\Models\Endereco;
use App\Models\MetodoPagamento;
use App\Models\Tipo_movimentacao;

class AdministradorController extends Controller
{

    public function index(Request $request)
    {
        $administrador = Administrador::with(['user'])
            ->join('users', 'administradors.id', '=', 'users.userable_id' )
            ->select('administradors.*')
            ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at', 'administradors.deleted_at');

        if ($request->has('buscarObjeto')) {
            $administrador->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->buscarObjeto . '%')
                      ->orWhere('users.email', 'like', '%' . $request->buscarObjeto . '%');
            });
        }

        if ($request->has('ordenacaoBusca')) {
            $administrador->orderBy($request->ordenacaoBusca);
        }
        else{
            $administrador->orderBy('administradors.name');
        }

        if ($request->has('paginacao')) {
            return $administrador->get();
            //error_log('passou aki');
        }

        return $administrador->paginate(10);
            /*
        if(isset($request->buscarObjeto)){
            if(isset($request->ordenacaoBusca)){
                error_log("com busca com ordenacao  ".$request->buscarObjeto);
                return Administrador::with(['user'])
                    //->orderBy($request->ordenacaoBusca)
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->join('users', 'administradors.id', '=', 'users.userable_id' )
                    ->select('administradors.*')
                    ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at')
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);
            }
            else{
                error_log("com busca sem ordenacao".$request->buscarObjeto);
                return Administrador::with(['user'])
                    ->where( 'name', 'like', '%'.$request->buscarObjeto.'%')
                    ->paginate(4);
            }
        }
        else{
            if(isset($request->ordenacaoBusca)){
                error_log("sem busca com ordenacao");
                return Administrador::with(['user'])
                    ->join('users', 'administradors.id', '=', 'users.userable_id' )
                    ->select('administradors.*')
                    ->groupBy('administradors.id', 'administradors.name', 'administradors.created_at', 'administradors.updated_at')
                    ->orderBy($request->ordenacaoBusca)
                    ->paginate(4);
            }
            else{
                error_log("sem busca sem ordenacao");
                return Administrador::with(['user'])->paginate(4);
                //return Cliente::with('user')->paginate(10);
            }
        }*/
    }


    public function create()
    {
        //
    }


    public function store(AdministradorRequest $request)
    {

        $administrador = Administrador::create($request->only('name'));
        $administrador->user()->create(['email'=> $request->email, 'password'=>Hash::make($request->password)])->givePermissionTo('admin');

        return $administrador;
    }


    public function show(Administrador $administrador)
    {
        return new TesteResource($administrador, $administrador->user);
    }

    public function edit(Administrador $administrador)
    {
        //
    }

    public function update(AdministradorRequest $request, Administrador $administrador)
    {
        $administrador->update($request->only('name'));
        if(isset($request->password)){
            $administrador->user()->update(['password' => Hash::make($request->password)]);
        }

        $administrador->user()->update($request->only('email'));

        return new TesteResource($administrador, $administrador->user);
    }

    public function destroy(Administrador $administrador)
    {
        //$obj = Administrador::with('user')->findOrfail($id);
        $administrador->user()->delete();
        $administrador->delete();

        return new TesteResource($administrador);
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

    public function analiseTopProdutos(Request $request){
        //error_log("deu ruim");
        //$vendedor = Administrador::findOrfail($request['id']);
        //$pedido = Pedido::all();

        $topProdutos = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->select('produtos.id', 'produtos.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('produtos.id', 'produtos.name')
            ->get();

        $topMarcas = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('marcas', 'marca_id', '=', 'marcas.id')
            ->select('marcas.id', 'marcas.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('marcas.id', 'marcas.name')
            ->get();

        $topClientes = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
            ->join('clientes', 'cliente_id', '=', 'clientes.id')
            ->select('clientes.id', 'clientes.name',
                DB::raw('SUM(pedido_produto.qty_item) as quantidade_total'),
                DB::raw('SUM(pedido_produto.qty_item * pedido_produto.price_item) as valor_total') )
            ->groupBy('clientes.id', 'clientes.name')
            ->get();

        $topCidades = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
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

        $topBairros = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
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

        $topEstados = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
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

        $topPais = Pedido::
            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
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

    public function analiseTotalPedidos(Request $request){
        //Administradores
            // total de Administradores
            $totalAdministradores = Administrador::count();
            // total de Administradores excluidos
            $totalAdministradoresExcluidos = Administrador::onlyTrashed()->count();
        //--------------
        //Clientes
            // total de clientes
            $totalClientes = Cliente::count();
            // total de Clientes excluidos
            $totalClientesExcluidos = Cliente::onlyTrashed()->count();
        //--------
        //Enderecos
            // total de Endereços - pais - estado - cidade - bairro
            //Pais
                // total
                $totalPaises = Pais::count();
                // total excluidos
                $totalPaisesExcluidos = Pais::onlyTrashed()->count();
            //----
            //Estado
                // total
                $totalEstados = Estado::count();
                // total excluidos
                $totalEstadosExcluidos = Estado::onlyTrashed()->count();
            //------
            //Cidade
                // total
                $totalCidades = Cidade::count();
                // total excluidos
                $totalCidadesExcluidos = Cidade::onlyTrashed()->count();
            //------
            //Bairro
                // total
                $totalBairros = Bairro::count();
                // total excluidos
                $totalBairrosExcluidos = Bairro::onlyTrashed()->count();
            //------
            //Endereco
                // total
                $totalEnderecos = Endereco::count();
                // total excluidos
                $totalEnderecosExcluidos = Endereco::onlyTrashed()->count();
            //------
        //----------
        //Fornecedores
            // total de Fornecedores
                $totalFornecedores = Fornecedor::count();
            // total de Fornecedores excluidos
                $totalFornecedoresExcluidos = Fornecedor::onlyTrashed()->count();
            //Marcas
                // total de Marcas
                    $totalMarcas = Marca::count();
                // total de Marcaa excluidos
                    $totalMarcasExcluidos = Marca::onlyTrashed()->count();
                //Produtos
                    //total de Produto (variedades)
                        $totalProdutoVariedade = Produto::count();
                    //total de Produto (variedades)
                        $totalProdutosExcluidos = Produto::onlyTrashed()->count();
                    //total de pacotes (entregues)
                        $totalProdutos = Pedido::
                        join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
                        ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
                        ->whereNotNull('pedidos.delivery_date')
                        ->sum('pedido_produto.qty_item');
                    //-----------------
                    //total de pacotes (entregues) (periodico)
                        $totalProdutosPeriodico = Pedido::
                            join('pedido_produto', 'pedidos.id', '=', 'pedido_produto.pedido_id')
                            ->join('produtos', 'pedido_produto.produto_id', '=', 'produtos.id')
                            ->select([
                                DB::raw('YEAR(pedidos.created_at) as ano'),
                                DB::raw('MONTH(pedidos.created_at) as mes'),
                                DB::raw('SUM(pedido_produto.qty_item) as total')
                            ])
                            ->whereNotNull('pedidos.delivery_date')
                            ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

                        foreach($totalProdutosPeriodico as $p){
                            //$ano_totalProdutosPeriodico[] = $p->ano;
                            $mes_totalProdutosPeriodico[] = $this->numeroParaMes($p->mes)."/".$p->ano;
                            $valor_totalProdutosPeriodico[] = $p->total;
                        }
                    //------
                    //tipos de produtos
                        //total de Produto (variedades)
                            $totalTipo_produtos = Tipo_produto::count();
                        //total de Produto (variedades)
                            $totalTipo_produtosExcluidos = Tipo_produto::onlyTrashed()->count();
                    //-----------------
                //---------
            //------
        //-----------
        //Mov. Estoque
            // total de Movimentações de estoque
                $totalMovEstoque = Estoque::count();
            // total de Movimentações de estoque excluidos
                $totalMovEstoqueExcluidos = Estoque::onlyTrashed()->count();
            // total de Movimentações de estoque - ENTRADA
                $totalMovEstoqueEntrada = Estoque::where('qty_item', '>', 0)->sum('qty_item');
            // total de Movimentações de estoque - SAIDA
                $totalMovEstoqueSaida = Estoque::where('qty_item', '<', 0)->sum('qty_item');
            //tipo_movimentacao
                // total
                    $totalTipoMovEstoque = Tipo_movimentacao::count();
                // total de excluidos
                    $totalTipoMovEstoqueExcluidos = Tipo_movimentacao::onlyTrashed()->count();
            //-----------------
        //------------
        //Pedidos
            // total
                $totalPedidos = Pedido::count();
            //--------
            // total de excluidos
                $totalPedidosExcluidos = Pedido::onlyTrashed()->count();
            //--------
            // total de em aberto
                $totalPedidosAberto = Pedido::where('approval_date', null)->count();
            //--------
            // total de aprovado
                $totalPedidosAprovado = Pedido::where('approval_date', '!=', null)->where('delivery_date', null)->where('payday', null)->count();
            //--------
            // total de entregue
                $totalPedidosEntregue = Pedido::where('delivery_date', null)->count();
            //--------
            // total de pago
                $totalPedidosPago = Pedido::where('payday', null)->count();
            //--------
            //total de pedidos periodico
                $totalPedidosArray = Pedido::select([
                    DB::raw('YEAR(pedidos.created_at) as ano'),
                    DB::raw('MONTH(created_at) as mes'),
                    DB::raw('COUNT(*) as total')
                ])
                ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

                foreach($totalPedidosArray as $p){
                    $mes_totalPedidosArray[] = $this->numeroParaMes($p->mes)."/".$p->ano;
                    $valor_totalPedidosArray[] = $p->total;
                }
            //-------------
            //valor $$ total dos pedidos
                $valorTotalPedidos_price = Pedido::sum('total_price');
                $valorTotalPedidos_discount = Pedido::sum('total_discount');
                $valorTotalPedidos_total = $valorTotalPedidos_price - $valorTotalPedidos_discount;

                $valorTotalPedidosPeriodico = Pedido::select([
                        DB::raw('YEAR(pedidos.created_at) as ano'),
                        DB::raw('MONTH(pedidos.created_at) as mes'),
                        DB::raw('SUM(pedidos.total_price - pedidos.total_discount) as total')
                    ])
                    ->groupBy('ano')->groupBy('mes')->orderBy('ano', 'asc')->orderBy('mes', 'asc')->get();

                    foreach($valorTotalPedidosPeriodico as $p){
                        $mes_valorTotalPedidosArray[] = $this->numeroParaMes($p->mes)."/".$p->ano;
                        $valor_valorTotalPedidosArray[] = $p->total;
                    }
            //-----------
            //Metodo_pagamento
                // total
                    $totalMetodoPagamento = MetodoPagamento::count();
                //--------
                // total de excluidos
                    $totalMetodoPagamentoExcluido = MetodoPagamento::onlyTrashed()->count();
                //--------
            //----------------
        //--------
        //Telefones
            //total
                $totalTelefones = Telefone::count();
            //-----
            //total excluido
                $totalTelefonesExcluidos = Telefone::onlyTrashed()->count();
            //-----
            //total tel cliente
                $totalTelefonesCliente = Telefone::where('telefoneable_type', '=', 'App\Models\Cliente')->count();
            //-----
            //total tel vendedor
                $totalTelefonesVendedor = Telefone::where('telefoneable_type', '=', 'App\Models\Vendedor')->count();
            //-----
            //total tel fornecedor
                $totalTelefonesFornecedor = Telefone::where('telefoneable_type', '=', 'App\Models\Fornecedor')->count();
            //-----
        //---------
        //Vendedores
            // total de Vendedores
                $totalVendedores = Vendedor::count();
            // total de excluidos
                $totalVendedoresExcluidos = Vendedor::onlyTrashed()->count();
        //----------


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

                'administrador' => [
                    'total' => $totalAdministradores,
                    'total_excluido' => $totalAdministradoresExcluidos
                ],
                'bairro' => [
                    'total' => $totalBairros,
                    'total_excluido' => $totalBairrosExcluidos
                ],
                'cidade' => [
                    'total' => $totalCidades,
                    'total_excluido' => $totalCidadesExcluidos
                ],
                'cliente' => [
                    'total' => $totalClientes,
                    'total_excluido' => $totalClientesExcluidos
                ],
                'endereco' => [
                    'total' => $totalEnderecos,
                    'total_excluido' => $totalEnderecosExcluidos
                ],
                'estado' => [
                    'total' => $totalEstados,
                    'total_excluido' => $totalEstadosExcluidos
                ],
                'estoque' => [
                    'total' => $totalMovEstoque,
                    'total_excluido' => $totalMovEstoqueExcluidos,
                    'total_entrada' => $totalMovEstoqueEntrada,
                    'total_saida' => $totalMovEstoqueSaida
                ],
                'fornecedor' => [
                    'total' => $totalFornecedores,
                    'total_excluido' => $totalFornecedoresExcluidos
                ],
                'marca' => [
                    'total' => $totalMarcas,
                    'total_excluido' => $totalMarcasExcluidos
                ],
                'metodo_pagamento' => [
                    'total' => $totalMetodoPagamento,
                    'total_excluido' => $totalMetodoPagamentoExcluido
                ],
                'pais' => [
                    'total' => $totalPaises,
                    'total_excluido' => $totalPaisesExcluidos
                ],
                'pedido' => [
                    'total' => $totalPedidos,
                    'total_excluido' => $totalPedidosExcluidos,
                    'total_em_aberto' => $totalPedidosAberto,
                    'total_aprovado' => $totalPedidosAprovado,
                    'total_entregue' => $totalPedidosEntregue,
                    'total_pago' => $totalPedidosPago,
                    //'numero_total_pedidos_periodico_json' => $totalPedidosArray,
                    'numero_total_pedidos_periodico_coluna_mes' => $mes_totalPedidosArray,
                    'numero_total_pedidos_periodico_coluna_total' => $valor_totalPedidosArray,
                    'valor_total_pedidos' => $valorTotalPedidos_total,
                    //'valor_total_price' => $valorTotalPedidos_price,
                    //'valor_total_discount' => $valorTotalPedidos_discount,
                    'valor_total_pedidos_periodico_coluna_mes' => $mes_valorTotalPedidosArray,
                    'valor_total_pedidos_periodico_coluna_total' => $valor_valorTotalPedidosArray,
                ],
                'produto' => [
                    'total' => $totalProdutoVariedade,
                    'total_excluido' => $totalProdutosExcluidos,
                    'total_pacotes_entregues' => $totalProdutos,
                    //'numero_total_produtos_periodico_json' => $totalProdutosPeriodico,
                    'numero_total_produtos_periodico_coluna_mes' => $mes_totalProdutosPeriodico,
                    'numero_total_produtos_periodico_coluna_total' => $valor_totalProdutosPeriodico,
                ],
                'telefone' => [
                    'total' => $totalTelefones,
                    'total_excluido' => $totalTelefonesExcluidos,
                    'total_tel_cliente' => $totalTelefonesCliente,
                    'total_tel_vendedor' => $totalTelefonesVendedor,
                    'total_tel_fornecedor' => $totalTelefonesFornecedor
                ],
                'tipo_movimentacao' => [
                    'total' => $totalTipoMovEstoque,
                    'total_excluido' => $totalTipoMovEstoqueExcluidos
                ],
                'tipo_produto' => [
                    'total' => $totalTipo_produtos,
                    'total_excluido' => $totalTipo_produtosExcluidos
                ],
                'vendedor' => [
                    'total' => $totalVendedores,
                    'total_excluido' => $totalVendedoresExcluidos
                ]
            ];
        //-----
        return json_encode($resultado);
    }
}
