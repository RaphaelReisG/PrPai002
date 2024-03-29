<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./logo.ico" type="image/x-icon">
    <title>Ambiente - Salgados</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->

    <style>
        /*Cor do botão sair*/
        .btn-red {
            background-color: hsl(0, 70%, 65%);
            color: white;
            width: 70px;
        }

        /*Barra de navegação*/
        /*Título na barra de navegação*/
        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
        }

        /*opções da barra de navegação*/
        .nav-link {
            font-weight: bold;
            font-size: 20px;
        }

        .nav-link:hover {
            color: hsl(0, 70%, 65%);
        }

        .ola {
            font-weight: bold;
            font-size: 20px;
        }


        /* Tooltip container */
        .tooltip2 {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip2 .tooltiptext2 {
        visibility: hidden;
        width: 200px;
        color: #fff;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;

        /* Position the tooltip text - see examples below! */
        position: absolute;
        z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip2:hover .tooltiptext2 {
        visibility: visible;
        }




    </style>

</head>

<body>
    <div id="app">
        <div style="display: none">
            {{ idUsuario = '<?php echo Auth::user()->userable->id; ?>' }}
            {{ tipoUsuario = '<?php echo Auth::user()->userable_type; ?>' }}
            {{ Auth::user()->email }}
            {{ Auth::user()->id }}
            {{ nomeUsuario = '<?php echo Auth::user()->userable->name; ?>' }}
            {{ Auth::user()->userable->name }}
            {{ Auth::user()->userable->id }}
            {{ tokenUsuario = '<?php echo session('data'); ?>' }}
        </div>

        <!-- Menu -->
        <div v-if="impressao == false">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <img src="./logo.png" width="50" height="50">
                    <a class="navbar-brand" href="#">Salgado Zilla</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                            style="--bs-scroll-height: 100px;">
                            <li class="nav-item">
                                <a class="nav-link" v-on:click="defineClasse('', '')" aria-current="page"
                                    href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Configurações
                                </a>
                                <ul class="dropdown-menu">
                                    @can('admin')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('bairro', 'Bairros')">Bairro</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('cidade', 'Cidade')">Cidade</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('estado', 'Estado')">Estado</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('pais', 'País')">País</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('tipo_produto', 'Tipos de Produtos')">Tipo de
                                                produto</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('tipo_movimentacao', 'Tipos de movimentação de estoque')">Tipo
                                                de movimentação</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('metodo_pagamento', 'Metodo de pagamento')">Metodo
                                                de pagamento</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('administrador/'+idUsuario, 'Meus dados')">Meus
                                                dados</a></li>
                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Endereços
                                                dos clientes</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Telefones
                                                dos clientes</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('vendedor/'+idUsuario, 'Meus dados')">Meus
                                                dados</a></li>
                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('endereco', 'Meus Endereços')">Meus Endereços</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('telefone', 'Meus Telefones')">Meus Telefones</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('cliente/'+idUsuario, 'Meus dados')">Meus dados</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </a>
                                <ul class="dropdown-menu">
                                    @can('admin')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('administrador', 'Administrador')">Gerenciar
                                                Administradores</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('vendedor', 'Vendedores')">Gerenciar
                                                Vendedores</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('cliente', 'Cliente')">Gerenciar Clientes</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Lista de
                                                endereços</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Lista
                                                telefonica</a></li>
                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('cliente', 'Cliente')">Clientes</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>
                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('pedido', 'Pedidos')">Meus Pedidos</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @can('admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Fluxo
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('fornecedor', 'Fornecedor')">Fornecedores</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('marca', 'Marcas')">Marcas</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('produto', 'Produto')">Produtos</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('estoque', 'Movimentações do Estoque')">Mov
                                                Estoque</a></li>
                                        <li><a class="dropdown-item" href="#"
                                                v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>
                                    </ul>
                                </li>
                            @endcan
                            <!--
                            <li class="nav-item">
                                <a class="nav-link disabled">Link</a>
                            </li>
                            -->
                        </ul>
                        <!--
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <h5>
                            Usuario
                            <button type="button" class="btn btn-outline-danger">Sair</button>
                        </h5>
                        -->

                        Olá, {{ Auth::user()->userable->name }} , seja bem vindo!

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input style="display: none" type="readonly" name="id" v-model="idUsuario">

                            <x-responsive-nav-link style="margin-left: 5px; " class="btn btn-secondary btn-red"
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-responsive-nav-link>
                        </form>

                        <!--
                        <button style="margin-left: 5px;" type="button" class="btn btn-secondary position-relative">
                            Notificações
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                                <span class="visually-hidden">Mensagens não lidas</span>
                            </span>
                        </button>
                        -->

                    </div>
                </div>
            </nav>
        </div>
        <!-- Conteudo Geral CRUDs -->
        <div class="container-lg">
            <div v-if="impressao == false">
                <div class="row">
                    <h1>@{{ titulo }}</h1>
                 </div>
                <div class="row"><hr></div>
                <div class="row">
                    <div v-if="titulo == ''"> <!-- Dashboard -->
                        @can('cliente')
                            {{-- <div class="row">
                                <div class="col"> <!-- Total - pacotes - entregue -->
                                    <card_02  :valorjson = "dash_contagem.produto.total_pacotes_entregues" descricao="Total de Pacotes Entregues">
                                        <template v-slot:icone>
                                            <icone_produto></icone_produto><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total" descricao="Total de Pedidos realizados">
                                        <template v-slot:icone>
                                            <icone_pedido></icone_pedido>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - em aberto -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_em_aberto" descricao="Total de Pedidos em Aberto">
                                        <template v-slot:icone>
                                            <icone_pedido_aberto></icone_pedido_aberto>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - aprovado -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_aprovado" descricao="Total de Pedidos Aprovados">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - entregue -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_entregue" descricao="Total de Pedidos Entregues">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - pago -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_pago" descricao="Total de Pedidos Pagos">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - Valor R$ -->
                                    <card_02  :valorjson = "dash_contagem.pedido.valor_total_pedidos" descricao="Total de Pagamento Recebido">
                                        <template v-slot:icone>
                                            <icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <graf_line_01 titulo="QTD Pedidos mensais (uni)"
                                        :c1 = "dash_contagem.pedido.numero_total_pedidos_periodico_coluna_mes"
                                        :c2 = "dash_contagem.pedido.numero_total_pedidos_periodico_coluna_total"
                                        graficoid = "pedidomensal"
                                    ></graf_line_01>
                                </div>
                                <div class="col">
                                    <graf_line_01 titulo="QTD Produtos mensais (pacotes)"
                                        :c1 = "dash_contagem.produto.numero_total_produtos_periodico_coluna_mes"
                                        :c2 = "dash_contagem.produto.numero_total_produtos_periodico_coluna_total"
                                        graficoid = "produtomensal"
                                    ></graf_line_01>
                                </div>
                                <div class="col">
                                    <graf_line_01 titulo="Valor gasto mensal (R$)"
                                        :c1 = "dash_contagem.pedido.valor_total_pedidos_periodico_coluna_mes"
                                        :c2 = "dash_contagem.pedido.valor_total_pedidos_periodico_coluna_total"
                                        graficoid = "valormensal"
                                    ></graf_line_01>
                                </div>
                            </div>
                            <div class="row"><br><br></div>
                            <div class="row">
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd (pc)',conteudo: 'quantidade_total'}
                                        ]"
                                        titulo = "TOP Produtos"
                                        :valorjson = "dash_rank.top_produtos"
                                        >
                                    </table_comum_top>
                                </div>
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd (pc)',conteudo: 'quantidade_total'}
                                        ]"
                                        titulo = "TOP Marcas"
                                        :valorjson = "dash_rank.top_marcas"
                                        >
                                    </table_comum_top>
                                </div>
                            </div> --}}

                            <div class="row"> <!-- Dash Power BI -->
                                    <iframe v-if="idUsuario<=44" title="Report Section" width="800" height="636" src="https://app.powerbi.com/view?r=eyJrIjoiMWM1MzFjNTMtYzE5Ny00YjMxLWE1ZTgtNzc5MGI3ZDI0ZTE1IiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9&filter=vendedors/id eq'idUsuario'" frameborder="0" allowFullScreen="true"></iframe>







                                    <iframe v-else title="Report Section" width="800" height="636" src="https://app.powerbi.com/view?r=eyJrIjoiY2I2NDAyYjAtNzJhNC00YjFkLThlMWMtMjM2OWQwOTc0NThmIiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>

                            </div>
                        @elsecan('admin')
                            <!-- Contagens ou Totais-->
                            <!-- <div class="row">
                                <div class="col">
                                    <card_02 :valorjson = "dash_contagem.administrador.total" descricao="Total de Administradores Ativos">
                                        <template v-slot:icone>
                                            <icone_administrador></icone_administrador>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02 :valorjson = "dash_contagem.administrador.total_excluido" descricao="Total de Administradores Excluidos">
                                        <template v-slot:icone>
                                            <icone_administrador></icone_administrador><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.vendedor.total" descricao="Total de Vendedores Ativos">
                                        <template v-slot:icone>
                                            <icone_vendedor></icone_vendedor>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.vendedor.total_excluido" descricao="Total de Vendedores Excluidos">
                                        <template v-slot:icone>
                                            <icone_vendedor></icone_vendedor><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.cliente.total" descricao="Total de Clientes Ativos">
                                        <template v-slot:icone>
                                            <icone_cliente></icone_cliente>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.cliente.total_excluido" descricao="Total de Clientes Excluidos">
                                        <template v-slot:icone>
                                            <icone_cliente></icone_cliente><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.fornecedor.total" descricao="Total de Fornecedores Ativos">
                                        <template v-slot:icone>
                                            <icone_fornecedor></icone_fornecedor>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.fornecedor.total_excluido" descricao="Total de Fornecedores Excluidos">
                                        <template v-slot:icone>
                                            <icone_fornecedor></icone_fornecedor><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.marca.total" descricao="Total de Marcas Ativos">
                                        <template v-slot:icone>
                                            <icone_fornecedor></icone_fornecedor><icone_produto></icone_produto>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.marca.total_excluido" descricao="Total de Marcas Excluidos">
                                        <template v-slot:icone>
                                            <icone_fornecedor></icone_fornecedor><icone_produto></icone_produto><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.produto.total" descricao="Total de Produtos Ativos no Catalogo">
                                        <template v-slot:icone>
                                            <icone_produto></icone_produto>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.produto.total_excluido" descricao="Total de Produtos Excluidos">
                                        <template v-slot:icone>
                                            <icone_produto></icone_produto><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.produto.total_pacotes_entregues" descricao="Total de Pacotes Entregues">
                                        <template v-slot:icone>
                                            <icone_produto></icone_produto><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total" descricao="Total de Pedidos realizados">
                                        <template v-slot:icone>
                                            <icone_pedido></icone_pedido>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total_excluido" descricao="Total de Pedidos Excluidos">
                                        <template v-slot:icone>
                                            <icone_pedido></icone_pedido><icone_deletar></icone_deletar>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total_em_aberto" descricao="Total de Pedidos em Aberto">
                                        <template v-slot:icone>
                                            <icone_pedido_aberto></icone_pedido_aberto>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total_aprovado" descricao="Total de Pedidos Aprovados">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total_entregue" descricao="Total de Pedidos Entregues">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.total_pago" descricao="Total de Pedidos Pagos">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.pedido.valor_total_pedidos" descricao="Total de Pagamento Recebido">
                                        <template v-slot:icone>
                                            <icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                            </div> -->
                            <div class="row"> <!-- Dash Power BI -->
                                <iframe title="dashPrototipo01" width="800" height="636" src="https://app.powerbi.com/view?r=eyJrIjoiNmFmZTMyODAtNjBlZi00ODY4LWJhZmEtNGU0M2RmODQ3ZTZiIiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
                            </div>


                        @elsecan('vendedor')
                            {{-- <div class="row">
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.cliente.total" descricao="Total de Clientes Ativos">
                                        <template v-slot:icone>
                                            <icone_cliente></icone_cliente>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col">
                                    <card_02  :valorjson = "dash_contagem.produto.total_pacotes_entregues" descricao="Total de Pacotes Entregues">
                                        <template v-slot:icone>
                                            <icone_produto></icone_produto><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total" descricao="Total de Pedidos realizados">
                                        <template v-slot:icone>
                                            <icone_pedido></icone_pedido>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - em aberto -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_em_aberto" descricao="Total de Pedidos em Aberto">
                                        <template v-slot:icone>
                                            <icone_pedido_aberto></icone_pedido_aberto>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - aprovado -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_aprovado" descricao="Total de Pedidos Aprovados">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - entregue -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_entregue" descricao="Total de Pedidos Entregues">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_entrega></icone_entrega>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - pago -->
                                    <card_02  :valorjson = "dash_contagem.pedido.total_pago" descricao="Total de Pedidos Pagos">
                                        <template v-slot:icone>
                                            <icone_pedido_aprovado></icone_pedido_aprovado><icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                                <div class="col"> <!-- Total - pedido - Valor R$ -->
                                    <card_02  :valorjson = "dash_contagem.pedido.valor_total_pedidos" descricao="Total de Pagamento Recebido">
                                        <template v-slot:icone>
                                            <icone_pagamento></icone_pagamento>
                                        </template>
                                    </card_02>
                                </div>
                            </div>
                            <div class="row" style="color:black;">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="col d-flex align-items-center justify-content-center">
                                            <div class="carousel-item active">

                                                    <graf_line_01 titulo="QTD Pedidos mensais (uni)"
                                                        :c1 = "dash_contagem.pedido.numero_total_pedidos_periodico_coluna_mes"
                                                        :c2 = "dash_contagem.pedido.numero_total_pedidos_periodico_coluna_total"
                                                        graficoid = "pedidomensal"
                                                    ></graf_line_01>

                                            </div>
                                            <div class="carousel-item">
                                                <graf_line_01 titulo="QTD Produtos mensais (pacotes)"
                                                    :c1 = "dash_contagem.produto.numero_total_produtos_periodico_coluna_mes"
                                                    :c2 = "dash_contagem.produto.numero_total_produtos_periodico_coluna_total"
                                                    graficoid = "produtomensal"
                                                ></graf_line_01>
                                            </div>
                                            <div class="carousel-item">
                                                <graf_line_01 titulo="Valor gasto mensal (R$)"
                                                    :c1 = "dash_contagem.pedido.valor_total_pedidos_periodico_coluna_mes"
                                                    :c2 = "dash_contagem.pedido.valor_total_pedidos_periodico_coluna_total"
                                                    graficoid = "valormensal"
                                                ></graf_line_01>
                                            </div>
                                        </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only" style="color:black; margin-right: 100px;">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only" style="color:black;">Next</span>
                                        </a>
                                    </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <graf_donut_01 titulo="Top Bairros"
                                        :c1 = "dash_rank.top_bairros_nome_bairros"
                                        :c2 = "dash_rank.top_bairros_valor_total_bairros"
                                        graficoid = "topbairros"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Cidades"
                                        :c1 = "dash_rank.top_cidades_nome_cidades"
                                        :c2 = "dash_rank.top_cidades_valor_total_cidades"
                                        graficoid = "topcidades"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Estados"
                                        :c1 = "dash_rank.top_estados_nome_estados"
                                        :c2 = "dash_rank.top_estados_valor_total_estados"
                                        graficoid = "topestados"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Pais"
                                        :c1 = "dash_rank.top_pais_nome_pais"
                                        :c2 = "dash_rank.top_pais_valor_total_pais"
                                        graficoid = "toppais"
                                    ></graf_donut_01>
                                </div>
                            </div>
                            <div class="row"><br><br></div>
                            <div class="row">
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd (pc)',conteudo: 'quantidade_total'}
                                        ]"
                                        titulo = "TOP Produtos"
                                        :valorjson = "dash_rank.top_produtos"
                                        >
                                    </table_comum_top>
                                </div>
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd (pc)',conteudo: 'quantidade_total'}
                                        ]"
                                        titulo = "TOP Marcas"
                                        :valorjson = "dash_rank.top_marcas"
                                        >
                                    </table_comum_top>
                                </div>
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd', conteudo: 'quantidade_total'}
                                        ]"
                                        titulo = "TOP Clientes"
                                        :valorjson = "dash_rank.top_clientes"
                                        >
                                    </table_comum_top>
                                </div>
                            </div> --}}
                            <div class="row">
                                <iframe v-if="idUsuario<=13" title="dashVanna" width="800" height="636" src="https://app.powerbi.com/view?r=eyJrIjoiNzJmMmNiYzAtN2E3OS00ZjU2LTgzM2UtNzc0MzNiOTkzNTc3IiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9&filter=vendedors/id eq'idUsuario'" frameborder="0" allowFullScreen="true"></iframe>








                                <iframe v-else title="Report Section" width="800" height="636" src="https://app.powerbi.com/view?r=eyJrIjoiNGVjNDY4M2QtNDNkMS00ZDczLTg5MTUtZDExMjlhMjM3OWRjIiwidCI6ImNmNzJlMmJkLTdhMmItNDc4My1iZGViLTM5ZDU3YjA3Zjc2ZiIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
                            </div>
                        @else
                            Você não tem nenhuma permissão.
                        @endcan
                    </div>

                    <div v-if="titulo !== '' && titulo !== 'Meus dados'"> <!-- cabecalho geral -->
                        <div class="row">
                            <div class="col">
                                <h2>
                                    Novo
                                    <button_add></button_add>
                                </h2>
                            </div>
                            <div class="col">
                                <button_buscar></button_buscar>
                            </div>
                            <paginacao v-if="nomeObjeto !== '' && objetos !== null"></paginacao>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Cadastro/edicao geral -->
            <div class="modal fade" id="modalObjeto" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div v-if="modalErro == false">
                            <!-- conteudo-->
                            <modal_header></modal_header> <!-- Cabecalho modal-->
                            <div v-if="modalSucesso == false">
                                <div v-if="carregandoModal == false">
                                <!-- conteudo modal -->
                                <!-- formulario PEDIDO -->
                                <div v-if="nomeObjeto == 'pedido'" class="modal-body">
                                    <div class="row">
                                        @can('admin')
                                            <div class="col">
                                                <select_geral nome_model="vendedor_id" :obj_dropdown="vendedores"
                                                    nome_atributo="name" id_atributo="id" nome="Defina um vendedor">
                                                </select_geral>
                                            </div>
                                        @elsecan('vendedor')
                                            <div style="display: none">
                                                {{ modelObjetos[0]['vendedor_id'] = '<?php echo Auth::user()->userable->id; ?>' }}
                                            </div>
                                        @elsecan('cliente')
                                            <div style="display: none">
                                                {{ modelObjetos[0]['vendedor_id'] = '<?php echo Auth::user()->userable->vendedor_id; ?>' }}
                                                {{ modelObjetos[0]['cliente_id'] = '<?php echo Auth::user()->userable->id; ?>' }}
                                            </div>
                                        @endcan
                                        @canAny(['admin', 'vendedor'])
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                        v-model="modelObjetos[0]['cliente_id']"
                                                        v-on:change="buscaEnderecos()" required>
                                                        <option v-for="(obj, index) in clientes" v-bind:value="obj.id">
                                                            @{{ obj.name }}</option>
                                                    </select>
                                                    <label for="floatingInput">Defina um cliente</label>
                                                </div>
                                                <!-- <select_geral nome_model="cliente_id" :obj_dropdown="clientes" nome_atributo="name" id_atributo="id" nome="Defina um cliente"></select_geral> -->
                                            </div>
                                        @endcan
                                        <div class="col">
                                            <select_geral nome_model="metodo_pagamento_id"
                                                :obj_dropdown="metodo_pagamentos" nome_atributo="name"
                                                id_atributo="id" nome="Qual a forma de pagamento">
                                            </select_geral>
                                        </div>
                                        @can('admin')
                                            <div class="col">
                                                <input_geral nome="Descontos" tipo="number" nome_model="total_discount">
                                                </input_geral>
                                            </div>
                                        @endcan
                                        <div class="col">
                                            <select_geral nome_model="endereco_id" :obj_dropdown="enderecos"
                                                nome_atributo="name" id_atributo="id" nome="Endereço">
                                            </select_geral>
                                        </div>
                                        <div class="col">
                                            <input_geral nome="Observações" tipo="text" nome_model="observation">
                                            </input_geral>
                                        </div>
                                    </div>
                                    <div class="row"><h5>Encontrar produtos</h5></div>
                                    <div class="row"><hr></div>
                                    <div class="row">
                                        <div class="col">
                                            <div v-if="temPaginacao == true">
                                                <paginacao_produto></paginacao_produto>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button_buscar_produto></button_buscar_produto>
                                        </div>
                                    </div>
                                    <div class="row" v-if="temPaginacao == true">
                                        <table_comum_busca_produtos
                                            :classe_atributos="[
                                                { titulo: 'Nome', conteudo: 'name' },
                                                { titulo: 'Tipo', conteudo: 'tipo_produto', conteudo2: 'name' },
                                                { titulo: 'Preço (pc)', conteudo: 'sale_price' },
                                                { titulo: 'Qtd (pc)', conteudo: 'quantity' },
                                                { titulo: 'Peso (pc)', conteudo: 'weight' },
                                                { titulo: 'Marca', conteudo: 'marca', conteudo2: 'name' }
                                            ]"
                                            :objeto_imp="meuProduto['data']">
                                        </table_comum_busca_produtos>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <h5>Meu carrinho</h5>
                                        </div>
                                        <div class="col">
                                            <h5>Descontos: R$ @{{ modelObjetos[0]['total_discount'] }}</h5>
                                        </div>
                                        <div class="col">
                                            <h5>Total: R$ @{{ modelObjetos[0]['total_price'] }}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <table_comum_meu_carrinho
                                            :classe_atributos="[
                                                { titulo: 'Quantidade', conteudo: 'qty_item' },
                                                { titulo: 'Nome', conteudo: 'name' },
                                                { titulo: 'Marca', conteudo: 'marca' },
                                                { titulo: 'Preço (pc)', conteudo: 'price_item' },
                                                { titulo: 'Subtotal', conteudo: 'total_item' },
                                            ]"
                                            :objeto_imp="meuCarrinho">
                                        </table_comum_meu_carrinho>
                                    </div>
                                </div>
                                @can('admin')
                                    <!-- formulario MEUS DADOS - ADMINISTRADOR-->
                                    <div v-else-if="nomeObjeto == 'administrador/'+idUsuario" class="modal-body">
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" v-model="alterarSenha">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Deseja alterar a
                                                senha</label>
                                        </div>
                                        <hr>
                                        <div v-if="alterarSenha == true">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>
                                    <!-- formulario ADMINISTRADOR-->
                                    <div v-else-if="nomeObjeto == 'administrador'" class="modal-body">
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div v-if="acaoObjeto == 'Criar'">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>
                                    <!-- formulario VENDEDOR-->
                                    <div v-else-if="nomeObjeto == 'vendedor'" class="modal-body">
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div v-if="acaoObjeto == 'Criar'">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>

                                    <!-- formulario FORNECEDOR -->
                                    <div v-else-if="nomeObjeto == 'fornecedor'" class="modal-body">
                                        <input_geral nome="Nome contato" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="Razão Social" tipo="text" nome_model="company_name">
                                        </input_geral>
                                        <input_geral nome="CNPJ" tipo="number" nome_model="cnpj"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                    </div>
                                    <!-- formulario MARCA-->
                                    <div v-else-if="nomeObjeto == 'marca'" class="modal-body">
                                        <input_geral nome="Nome da marca" tipo="text" nome_model="name"></input_geral>
                                        <select_geral nome_model="fornecedor_id" :obj_dropdown="fornecedores"
                                            nome_atributo="company_name" id_atributo="id" nome="Escolha o fornecedor">
                                        </select_geral>
                                    </div>
                                    <!-- formulario PRODUTO-->
                                    <div v-else-if="nomeObjeto == 'produto'" class="modal-body">
                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['fornecedor_id']" v-on:change="buscaMarcas()"
                                                required>
                                                <option v-for="(obj, index) in fornecedores" v-bind:value="obj.id">
                                                    @{{ obj.name }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha o fornecedor</label>
                                        </div>
                                        <select_geral nome_model="marca_id" :obj_dropdown="marcas" nome_atributo="name"
                                            id_atributo="id" nome="Escolha a marca"></select_geral>
                                        <input_geral nome="Nome do produto" tipo="text" nome_model="name">
                                        </input_geral>
                                        <!--<input_geral nome="Tipo" tipo="text" nome_model="type"></input_geral>-->
                                        <select_geral nome_model="tipo_produto_id" :obj_dropdown="tipo_produtos"
                                            nome_atributo="name" id_atributo="id" nome="Escolha o tipo"></select_geral>
                                        <input_geral nome="Quantidade por pacote" tipo="number" nome_model="quantity">
                                        </input_geral>
                                        <input_geral nome="Peso por pacote" tipo="number" nome_model="weight">
                                        </input_geral>
                                        <input_geral nome="Preço de custo" tipo="number" nome_model="cost_price">
                                        </input_geral>
                                        <input_geral nome="Preço de venda" tipo="number" nome_model="sale_price">
                                        </input_geral>
                                        <input_geral nome="Descrição" tipo="text" nome_model="description">
                                        </input_geral>


                                        <div class="row">
                                            <div class="col" v-if="acaoObjeto == 'Alterar' && modelObjetos[0]['image_name'] !== '' && modelObjetos[0]['image_name'] !== null">
                                                <div style="max-width: 200px;">
                                                    <img :src="'storage/'+modelObjetos[0]['image_name']" alt="Imagem" width="200" height="200" >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileInput">
                                                    <label class="custom-file-label" for="fileInput">Escolha uma imagem...</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- formulario TIPO_PRODUTO-->
                                    <div v-else-if="nomeObjeto == 'tipo_produto'" class="modal-body">
                                        <input_geral nome="Nome do tipo" tipo="text" nome_model="name"></input_geral>
                                    </div>
                                    <!-- formulario TIPO_MOVIMENTACAO-->
                                    <div v-else-if="nomeObjeto == 'tipo_movimentacao'" class="modal-body">
                                        <input_geral nome="Nome do tipo" tipo="text" nome_model="name"></input_geral>
                                    </div>
                                    <!-- formulario METODO_PAGAMENTO-->
                                    <div v-else-if="nomeObjeto == 'metodo_pagamento'" class="modal-body">
                                        <input_geral nome="Nome do metodo" tipo="text" nome_model="name">
                                        </input_geral>
                                    </div>
                                    <!-- formulario ESTOQUE-->
                                    <div v-else-if="nomeObjeto == 'estoque'" class="modal-body">
                                        <select_geral nome_model="tipo_movimentacao_id" :obj_dropdown="tipo_movimentacaos"
                                            nome_atributo="name" id_atributo="id" nome="Escolha o tipo"></select_geral>
                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['fornecedor_id']" v-on:change="buscaMarcas()"
                                                required>
                                                <option v-for="(obj, index) in fornecedores" v-bind:value="obj.id">
                                                    @{{ obj.name }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha o fornecedor</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['marca_id']" v-on:change="buscaProdutos()"
                                                required>
                                                <option v-for="(obj, index) in marcas" v-bind:value="obj.id">
                                                    @{{ obj.name }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha a marca</label>
                                        </div>

                                        <select_geral nome_model="produto_id" :obj_dropdown="produtos"
                                            nome_atributo="name" id_atributo="id" nome="Escolha o produto">
                                        </select_geral>
                                        <input_geral nome="Quantidade" tipo="number" nome_model="qty_item">
                                        </input_geral>
                                        <input_geral nome="Observação" tipo="text" nome_model="observation">
                                        </input_geral>
                                    </div>

                                    <!-- formulario PAIS-->
                                    <div v-else-if="nomeObjeto == 'pais'" class="modal-body">
                                        <input_geral nome="Nome do País" tipo="text" nome_model="name_country">
                                        </input_geral>
                                    </div>
                                    <!-- formulario ESTADO-->
                                    <div v-else-if="nomeObjeto == 'estado'" class="modal-body">
                                        <input_geral nome="Nome do Estado" tipo="text" nome_model="name_state">
                                        </input_geral>
                                        <select_geral nome_model="pais_id" :obj_dropdown="paises"
                                            nome_atributo="name_country" id_atributo="id" nome="Escolha o país">
                                        </select_geral>
                                    </div>
                                    <!-- formulario CIDADE-->
                                    <div v-else-if="nomeObjeto == 'cidade'" class="modal-body">
                                        <input_geral nome="Nome" tipo="text" nome_model="name_city"></input_geral>
                                        <select_geral nome_model="estado_id" :obj_dropdown="estados"
                                            nome_atributo="name_state" id_atributo="id" nome="Escolha um estado">
                                        </select_geral>
                                    </div>
                                    <!-- formulario BAIRRO-->
                                    <div v-else-if="nomeObjeto == 'bairro'" class="modal-body">
                                        <input_geral nome="Nome" tipo="text" nome_model="name_neighborhood">
                                        </input_geral>
                                        <select_geral nome_model="cidade_id" :obj_dropdown="cidades"
                                            nome_atributo="name_city" id_atributo="id" nome="Escolha uma cidade">
                                        </select_geral>
                                    </div>
                                @endcan
                                @canAny(['admin', 'vendedor'])
                                    <!-- formulario CLIENTE -->
                                    <div v-else-if="nomeObjeto == 'cliente'" class="modal-body">
                                        @can('admin')
                                            <select_geral nome_model="vendedor_id" :obj_dropdown="vendedores"
                                                nome_atributo="name" id_atributo="id" nome="Defina um vendedor">
                                            </select_geral>
                                        @elsecan('vendedor')
                                            <div style="display: none">
                                                {{ modelObjetos[0]['vendedor_id'] = '<?php echo Auth::user()->userable->id; ?>' }}
                                            </div>
                                        @endcan
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="Razão Social" tipo="text" nome_model="company_name">
                                        </input_geral>
                                        <input_geral nome="CPF ou CNPJ" tipo="number" nome_model="cnpj"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div v-if="acaoObjeto == 'Criar'">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>
                                @endcan
                                @canAny(['admin', 'vendedor', 'cliente'])
                                    <!-- formulario ENDERECO-->
                                    <div v-else-if="nomeObjeto == 'endereco'" class="modal-body">
                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['pais_id']" v-on:change="buscaEstados()"
                                                required>
                                                <option v-for="(obj, index) in paises" v-bind:value="obj.id">
                                                    @{{ obj.name_country }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha o país</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['estado_id']" v-on:change="buscaCidades()"
                                                required>
                                                <option v-for="(obj, index) in estados" v-bind:value="obj.id">
                                                    @{{ obj.name_state }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha o estado</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                v-model="modelObjetos[0]['cidade_id']" v-on:change="buscaBairros()"
                                                required>
                                                <option v-for="(obj, index) in cidades" v-bind:value="obj.id">
                                                    @{{ obj.name_city }}</option>
                                            </select>
                                            <label for="floatingInput">Escolha a cidade</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" list="listaBairro"
                                                id="floatingInput" v-model="modelObjetos[0]['name_neighborhood']"
                                                required>
                                            <label for="floatingInput">Escolha o bairro</label>
                                            <datalist id="listaBairro">
                                                <option v-for="(obj, index) in bairros"> @{{ obj.name_neighborhood }}</option>
                                            </datalist>
                                        </div>
                                        @can('admin')
                                            <div class="form-floating mb-3">
                                                <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                    v-model="modelObjetos[0]['tipoPessoa']" v-on:change="buscaPessoa()"
                                                    required>
                                                    <option value=""> </option>
                                                    <option value="fornecedor"> Fornecedor </option>
                                                    <option value="vendedor"> Vendedor </option>
                                                    <option value="cliente"> Cliente </option>
                                                </select>
                                                <label for="floatingInput">Para que tipo de pessoa</label>
                                            </div>
                                            <select_geral nome_model="enderecoable_id" :obj_dropdown="pessoas"
                                                nome_atributo="name" id_atributo="id" nome="Escolha o proprietario">
                                            </select_geral>
                                        @endcan
                                        @can('vendedor')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" v-model="meuDado">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Meu
                                                    endereço</label>
                                            </div>
                                            <br>
                                            <div v-if="meuDado == true">
                                                <div style="display: none">
                                                    @{{ modelObjetos[0]['tipoPessoa'] = "vendedor" }}
                                                    @{{ modelObjetos[0]['enderecoable_id'] = idUsuario }}
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div style="display: none">
                                                    @{{ modelObjetos[0]['tipoPessoa'] = "cliente" }}
                                                </div>
                                                <select_geral nome_model="enderecoable_id" :obj_dropdown="clientes"
                                                    nome_atributo="name" id_atributo="id" nome="Escolha o cliente">
                                                </select_geral>
                                            </div>
                                        @endcan
                                        @can('cliente')
                                            <div style="display: none">
                                                @{{ modelObjetos[0]['tipoPessoa'] = "cliente" }}
                                                @{{ modelObjetos[0]['enderecoable_id'] = idUsuario }}
                                            </div>
                                        @endcan
                                        <input_geral nome="Nome do endereço" tipo="text" nome_model="name">
                                        </input_geral>
                                        <input_geral nome="Logradouro" tipo="text" nome_model="street_name">
                                        </input_geral>
                                        <input_geral nome="Numero" tipo="number" nome_model="house_number">
                                        </input_geral>
                                        <input_geral nome="CEP" tipo="number" nome_model="cep"></input_geral>
                                        <input_geral nome="Complemento" tipo="text" nome_model="complement">
                                        </input_geral>
                                        <input_geral2 nome="Latitude" tipo="number" nome_model="latitude">
                                        </input_geral2>
                                        <input_geral2 nome="Longitude" tipo="number" nome_model="longitude">
                                        </input_geral2>
                                    </div>

                                    <!-- formulario TELEFONE-->
                                    <div v-else-if="nomeObjeto == 'telefone'" class="modal-body">
                                        @can('admin')
                                            <div class="form-floating mb-3">
                                                <select id="floatingInput" class="form-select" aria-label="Selecione"
                                                    v-model="modelObjetos[0]['tipoPessoa']" v-on:change="buscaPessoa()"
                                                    required>
                                                    <option value=""> </option>
                                                    <option value="fornecedor"> Fornecedor </option>
                                                    <option value="vendedor"> Vendedor </option>
                                                    <option value="cliente"> Cliente </option>
                                                </select>
                                                <label for="floatingInput">Para que tipo de pessoa</label>
                                            </div>
                                            <select_geral nome_model="telefoneable_id" :obj_dropdown="pessoas"
                                                nome_atributo="name" id_atributo="id" nome="Escolha o proprietario">
                                            </select_geral>
                                        @endcan
                                        @can('vendedor')
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked" v-model="meuDado">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Meu
                                                    telefone</label>
                                            </div>
                                            <br>
                                            <div v-if="meuDado == true">
                                                <div style="display: none">
                                                    @{{ modelObjetos[0]['tipoPessoa'] = "vendedor" }}
                                                    @{{ modelObjetos[0]['telefoneable_id'] = idUsuario }}
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div style="display: none">
                                                    @{{ modelObjetos[0]['tipoPessoa'] = "cliente" }}
                                                </div>
                                                <select_geral nome_model="telefoneable_id" :obj_dropdown="clientes"
                                                    nome_atributo="name" id_atributo="id" nome="Escolha o cliente">
                                                </select_geral>
                                            </div>
                                        @endcan
                                        @can('cliente')
                                            <div style="display: none">
                                                @{{ modelObjetos[0]['tipoPessoa'] = "cliente" }}
                                                @{{ modelObjetos[0]['telefoneable_id'] = idUsuario }}
                                            </div>
                                        @endcan
                                        <input_geral nome="Numero Telefone" tipo="text" nome_model="number_phone">
                                        </input_geral>
                                    </div>
                                @endcan
                                @can('vendedor')
                                    <!-- formulario MEUS DADOS - VENDEDOR-->
                                    <div v-else-if="nomeObjeto == 'vendedor/'+idUsuario" class="modal-body">
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" v-model="alterarSenha">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Deseja alterar a
                                                senha</label>
                                        </div>
                                        <hr>
                                        <div v-if="alterarSenha == true">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>
                                @endcan
                                @can('cliente')
                                    <!-- formulario MEUS DADOS - CLIENTE-->
                                    <div v-else-if="nomeObjeto == 'cliente/'+idUsuario" class="modal-body">
                                        <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                        <input_geral nome="Razão Social" tipo="text" nome_model="company_name">
                                        </input_geral>
                                        <input_geral nome="CPF ou CNPJ" tipo="number" nome_model="cnpj"></input_geral>
                                        <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked" v-model="alterarSenha">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Deseja alterar a
                                                senha</label>
                                        </div>
                                        <hr>
                                        <div v-if="alterarSenha == true">
                                            <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                            <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                        </div>
                                    </div>
                                @endcan
                                </div>
                                <div v-else class="text-center">
                                    <span class="spinner-border" style="width: 8rem; height: 8rem;" role="status"
                                        aria-hidden="true"></span>
                                    <h3>Carregando...</h3>
                                </div>
                                <!-- Rodapé -->
                                <div class="modal-footer">
                                    <button_cancelar_modal rotulo="Cancelar"></button_cancelar_modal>
                                    <button_acao></button_acao>
                                </div>
                            </div>
                            <div v-else>
                                <!-- Operação realizada com sucesso -->
                                <modal_sucesso></modal_sucesso>
                            </div>
                        </div>
                        <div v-else>
                            <!-- Erro retornado!-->
                            <modal_erro></modal_erro>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Tabelas -->
            <div v-if="carregandoImpressao == false">
                <div v-if="titulo != '' && impressao == false">
                    @can('admin')
                        <!-- Tabela Pedido -->
                        <div v-if="nomeObjeto == 'pedido' && objetos !== null" class="row">
                            <table_acordion_pedidos
                                :classe_atributos="[
                                    { titulo: 'Nº', conteudo: 'id', ordenacao: 'pedidos.id' },
                                    { titulo: 'Data solicitação', conteudo: 'created_at', ordenacao: 'pedidos.created_at' },
                                    {
                                        titulo: 'Aprovado em',
                                        conteudo: 'approval_date',
                                        ordenacao: 'pedidos.approval_date'
                                    },
                                    { titulo: 'Entrega', conteudo: 'delivery_date', ordenacao: 'pedidos.delivery_date' },
                                    { titulo: 'Pagamento', conteudo: 'payday', ordenacao: 'pedidos.payday' },
                                    { titulo: 'Total', conteudo: 'total_price', ordenacao: 'pedidos.total_price' },
                                    {
                                        titulo: 'Cliente',
                                        conteudo: 'cliente',
                                        conteudo2: 'name',
                                        ordenacao: 'clientes.name'
                                    },
                                    {
                                        titulo: 'Vendedor',
                                        conteudo: 'vendedor',
                                        conteudo2: 'name',
                                        ordenacao: 'vendedors.name'
                                    }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Metodo de pagamento', conteudo: 'metodo_pagamento', conteudo2: 'name' },
                                    { titulo: 'Descontos', conteudo: 'total_discount' },
                                    { titulo: 'Endereço', conteudo: 'endereco', conteudo2: 'name' },
                                    { titulo: 'Observação', conteudo: 'observation' }
                                ]">
                            </table_acordion_pedidos>
                        </div>

                        <!-- Tabela Meus Dados Administradores -->
                        <div v-else-if="nomeObjeto == ('administrador/'+idUsuario) && objetos !== null" class="row">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Nome:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['name'] }}</h4>
                                    </div>
                                    <div class="col">
                                        <button_alter_meus_dados></button_alter_meus_dados>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>E-mail:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['user']['email'] }}</h4>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabela Cliente -->
                        <div v-else-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'clientes.name' },
                                    {
                                        titulo: 'Razão Social',
                                        conteudo: 'company_name',
                                        ordenacao: 'clientes.company_name'
                                    },
                                    { titulo: 'CPF / CNPJ', conteudo: 'cnpj', ordenacao: 'clientes.cnpj' },
                                    { titulo: 'E-mail', conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email' }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Vendedor responsável', conteudo: 'vendedor', conteudo2: 'name' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Vendedor -->
                        <div v-else-if="nomeObjeto == 'vendedor' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'vendedors.name' },
                                    { titulo: 'E-mail', conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email' }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Administradores -->
                        <div v-else-if="nomeObjeto == 'administrador' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'administradors.name' },
                                    { titulo: 'E-mail', conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email' }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Fornecedor -->
                        <div v-else-if="nomeObjeto == 'fornecedor' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome Responsavel', conteudo: 'name', ordenacao: 'fornecedors.name' },
                                    {
                                        titulo: 'Nome Empresa',
                                        conteudo: 'company_name',
                                        ordenacao: 'fornecedors.company_name'
                                    },
                                    { titulo: 'CNPJ', conteudo: 'cnpj', ordenacao: 'fornecedors.cnpj' },
                                    { titulo: 'E-mail', conteudo: 'email', ordenacao: 'fornecedors.email' }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Marca -->
                        <div v-else-if="nomeObjeto == 'marca' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'marcas.name' },
                                    {
                                        titulo: 'Fornecedor',
                                        conteudo: 'fornecedor',
                                        conteudo2: 'company_name',
                                        ordenacao: 'fornecedors.name'
                                    }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Produto -->
                        <div v-else-if="nomeObjeto == 'produto' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'produtos.name' },
                                    { titulo: 'Estoque', conteudo: 'estoques_sum_qty_item', ordenacao: 'produtos.name' },
                                    {
                                        titulo: 'Tipo',
                                        conteudo: 'tipo_produto',
                                        conteudo2: 'name',
                                        ordenacao: 'tipo_produtos.name'
                                    },
                                    { titulo: 'Valor de Venda', conteudo: 'sale_price', ordenacao: 'produtos.sale_price' },
                                    { titulo: 'Marca', conteudo: 'marca', conteudo2: 'name', ordenacao: 'marcas.name' },
                                    {
                                        titulo: 'Fornecedor',
                                        conteudo: 'marca',
                                        conteudo2: 'fornecedor',
                                        conteudo3: 'company_name',
                                        ordenacao: 'fornecedors.name'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Quantidade por Pacote', conteudo: 'quantity' },
                                    { titulo: 'Peso por pacote ', conteudo: 'weight' },
                                    { titulo: 'Preço de custo', conteudo: 'cost_price' },
                                    { titulo: 'Descrição', conteudo: 'description' },
                                    { titulo: 'Imagem nome', conteudo: 'image_name' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Tipo_produto -->
                        <div v-else-if="nomeObjeto == 'tipo_produto' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome do tipo', conteudo: 'name', ordenacao: 'name' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Tipo_movimentacao -->
                        <div v-else-if="nomeObjeto == 'tipo_movimentacao' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome do tipo', conteudo: 'name', ordenacao: 'name' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Metodo_pagamento -->
                        <div v-else-if="nomeObjeto == 'metodo_pagamento' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome do metodo', conteudo: 'name', ordenacao: 'name' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'enderecos.name' },
                                    { titulo: 'Logradouro', conteudo: 'street_name', ordenacao: 'enderecos.street_name' },
                                    {
                                        titulo: 'Bairro',
                                        conteudo: 'bairro',
                                        conteudo2: 'name_neighborhood',
                                        ordenacao: 'bairros.name_neighborhood'
                                    },
                                    {
                                        titulo: 'Cidade',
                                        conteudo: 'bairro',
                                        conteudo2: 'cidade',
                                        conteudo3: 'name_city',
                                        ordenacao: 'cidades.name_city'
                                    },
                                    {
                                        titulo: 'Tipo',
                                        conteudo: 'enderecoable_type',
                                        ordenacao: 'enderecos.enderecoable_type'
                                    },
                                    {
                                        titulo: 'Proprietario',
                                        conteudo: 'enderecoable',
                                        conteudo2: 'name',
                                        ordenacao: 'enderecoable.name'
                                    },
                                    {
                                        titulo: 'Nome empresa',
                                        conteudo: 'enderecoable',
                                        conteudo2: 'company_name',
                                        ordenacao: 'enderecoable.company_name'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Nº', conteudo: 'house_number' },
                                    { titulo: 'Complemento', conteudo: 'complement' },
                                    { titulo: 'CEP', conteudo: 'cep' },
                                    { titulo: 'Latitude', conteudo: 'latitude' },
                                    { titulo: 'Longitude', conteudo: 'longitude' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Bairro -->
                        <div v-else-if="nomeObjeto == 'bairro' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[{
                                        titulo: 'Nome',
                                        conteudo: 'name_neighborhood',
                                        ordenacao: 'bairros.name_neighborhood'
                                    },
                                    {
                                        titulo: 'Cidade',
                                        conteudo: 'cidade',
                                        conteudo2: 'name_city',
                                        ordenacao: 'cidades.name_city'
                                    },
                                    {
                                        titulo: 'Estado',
                                        conteudo: 'cidade',
                                        conteudo2: 'estado',
                                        conteudo3: 'name_state',
                                        ordenacao: 'estados.name_state'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },

                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Cidade -->
                        <div v-else-if="nomeObjeto == 'cidade' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name_city', ordenacao: 'name_city' },
                                    {
                                        titulo: 'Estado',
                                        conteudo: 'estado',
                                        conteudo2: 'name_state',
                                        ordenacao: 'estados.name_state'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'País', conteudo: 'estado', conteudo2: 'pais', conteudo3: 'name_country' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Estado -->
                        <div v-else-if="nomeObjeto == 'estado' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name_state', ordenacao: 'name_state' },
                                    {
                                        titulo: 'País',
                                        conteudo: 'pais',
                                        conteudo2: 'name_country',
                                        ordenacao: 'pais.name_country'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Pais -->
                        <div v-else-if="nomeObjeto == 'pais' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name_country', ordenacao: 'name_country' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nº Telefone', conteudo: 'number_phone', ordenacao: 'telefone.number_phone' },
                                    {
                                        titulo: 'Contato',
                                        conteudo: 'telefoneable_type',
                                        ordenacao: 'telefone.telefoneable_type'
                                    },
                                    {
                                        titulo: 'Nome Contato',
                                        conteudo: 'telefoneable',
                                        conteudo2: 'name',
                                        ordenacao: 'telefone.telefoneable_type'
                                    },
                                    {
                                        titulo: 'Nome Empresa',
                                        conteudo: 'telefoneable',
                                        conteudo2: 'company_name',
                                        ordenacao: 'telefone.telefoneable_type'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Estoque -->
                        <div v-else-if="nomeObjeto == 'estoque' && objetos !== null" class="row">
                            <table_acordion_estoque
                                :classe_atributos="[
                                    { titulo: 'Data', conteudo: 'created_at', ordenacao: 'estoques.created_at' },
                                    { titulo: 'Quantidade', conteudo: 'qty_item', ordenacao: 'estoques.qty_item' },
                                    {
                                        titulo: 'Produto',
                                        conteudo: 'produto',
                                        conteudo2: 'name',
                                        ordenacao: 'produtos.name'
                                    },
                                    {
                                        titulo: 'Marca',
                                        conteudo: 'produto',
                                        conteudo2: 'marca',
                                        conteudo3: 'name',
                                        ordenacao: 'marcas.name'
                                    },
                                    {
                                        titulo: 'Tipo',
                                        conteudo: 'tipo_movimentacao',
                                        conteudo2: 'name',
                                        ordenacao: 'tipo_movimentacaos.name'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Responsavel', conteudo: 'estoqueable', conteudo2: 'name' },
                                    { titulo: 'Observação', conteudo: 'observation' }
                                ]">
                            </table_acordion_estoque>
                        </div>
                    @elsecan('vendedor')
                        <!-- Tabela Pedido -->
                        <div v-if="nomeObjeto == 'pedido' && objetos !== null" class="row">
                            <table_acordion_pedidos_restrito
                                :classe_atributos="[
                                    { titulo: 'Data solicitação', conteudo: 'created_at', ordenacao: 'pedidos.created_at' },
                                    { titulo: 'Total', conteudo: 'total_price', ordenacao: 'pedidos.total_price' },
                                    {
                                        titulo: 'Metodo de pagamento',
                                        conteudo: 'metodo_pagamento',
                                        conteudo2: 'name',
                                        ordenacao: 'metodo_pagamentos.name'
                                    },
                                    {
                                        titulo: 'Cliente',
                                        conteudo: 'cliente',
                                        conteudo2: 'name',
                                        ordenacao: 'clientes.name'
                                    },
                                    {
                                        titulo: 'Vendedor',
                                        conteudo: 'vendedor',
                                        conteudo2: 'name',
                                        ordenacao: 'vendedors.name'
                                    }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Pedido aprovado em', conteudo: 'approval_date' },
                                    { titulo: 'Data entrega', conteudo: 'delivery_date' },
                                    { titulo: 'Data pagamento', conteudo: 'payday' },
                                    { titulo: 'Descontos', conteudo: 'total_discount' },
                                    { titulo: 'Endereço', conteudo: 'endereco', conteudo2: 'name' },
                                    { titulo: 'Observação', conteudo: 'observation' }
                                ]">
                            </table_acordion_pedidos_restrito>
                        </div>
                        <!-- Tabela Meus Dados VENDEDOR -->
                        <div v-else-if="nomeObjeto == ('vendedor/'+idUsuario) && objetos !== null" class="row">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Nome:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['name'] }}</h4>
                                    </div>
                                    <div class="col">
                                        <button_alter_meus_dados></button_alter_meus_dados>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>E-mail:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['user']['email'] }}</h4>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <hr>
                            <div class="card card-body">
                                <div class="card card-header">
                                    <h4>Meus Endereços</h4>
                                </div>
                                <div class="card card-body">
                                    <table_acordion2
                                        :classe_atributos="[
                                            { titulo: 'Logradouro', conteudo: 'street_name' },
                                            { titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood' },
                                            {
                                                titulo: 'Cidade',
                                                conteudo: 'bairro',
                                                conteudo2: 'cidade',
                                                conteudo3: 'name_city'
                                            },
                                            { titulo: 'Nº', conteudo: 'house_number' }

                                        ]"
                                        :objeto_imp="objetos['data']['enderecos']"
                                        :obj_acordion="[
                                            { titulo: 'Criado em', conteudo: 'created_at' },
                                            { titulo: 'Complemento', conteudo: 'complement' },
                                            { titulo: 'CEP', conteudo: 'cep' }
                                        ]">
                                    </table_acordion2>
                                </div>
                            </div>
                            <br><br>
                            <hr>
                            <div class="card card-body">
                                <div class="card card-header">
                                    <h4>Meus Telefones</h4>
                                </div>
                                <div class="card card-body">
                                    <table_acordion2
                                        :classe_atributos="[
                                            { titulo: 'Nº Telefone', conteudo: 'number_phone' }

                                        ]"
                                        :objeto_imp="objetos['data']['telefones']"
                                        :obj_acordion="[
                                            { titulo: 'Criado em', conteudo: 'created_at' }
                                        ]">
                                    </table_acordion2>
                                </div>
                            </div>
                        </div>
                        <!-- Tabela Cliente vend-->
                        <div v-else-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
                            <table_acordion_cliente_restricao
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'clientes.name' },
                                    {
                                        titulo: 'Razão Social',
                                        conteudo: 'company_name',
                                        ordenacao: 'clientes.company_name'
                                    },
                                    { titulo: 'CPF / CNPJ', conteudo: 'cnpj', ordenacao: 'clientes.cnpj' },
                                    { titulo: 'E-mail', conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email' }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Vendedor responsável', conteudo: 'vendedor', conteudo2: 'name' }
                                ]">
                            </table_acordion_cliente_restricao>
                        </div>

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'enderecos.name' },
                                    { titulo: 'Logradouro', conteudo: 'street_name', ordenacao: 'enderecos.street_name' },
                                    {
                                        titulo: 'Bairro',
                                        conteudo: 'bairro',
                                        conteudo2: 'name_neighborhood',
                                        ordenacao: 'bairros.name_neighborhood'
                                    },
                                    {
                                        titulo: 'Cidade',
                                        conteudo: 'bairro',
                                        conteudo2: 'cidade',
                                        conteudo3: 'name_city',
                                        ordenacao: 'cidades.name_city'
                                    },
                                    {
                                        titulo: 'Tipo',
                                        conteudo: 'enderecoable_type',
                                        ordenacao: 'enderecos.enderecoable_type'
                                    },
                                    {
                                        titulo: 'Proprietario',
                                        conteudo: 'enderecoable',
                                        conteudo2: 'name',
                                        ordenacao: 'enderecoable.name'
                                    },
                                    {
                                        titulo: 'Nome empresa',
                                        conteudo: 'enderecoable',
                                        conteudo2: 'company_name',
                                        ordenacao: 'enderecoable.company_name'
                                    }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Nº', conteudo: 'house_number' },
                                    { titulo: 'Complemento', conteudo: 'complement' },
                                    { titulo: 'CEP', conteudo: 'cep' },
                                    { titulo: 'Latitude', conteudo: 'latitude' },
                                    { titulo: 'Longitude', conteudo: 'longitude' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nº Telefone', conteudo: 'number_phone' },
                                    { titulo: 'Contato', conteudo: 'telefoneable_type' },
                                    { titulo: 'Nome Contato', conteudo: 'telefoneable', conteudo2: 'name' },
                                    { titulo: 'Nome Empresa', conteudo: 'telefoneable', conteudo2: 'company_name' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>
                    @elsecan('cliente')
                        <!-- Tabela Meus dados Cliente -->
                        <div v-if="nomeObjeto == ('cliente/'+idUsuario) && objetos !== null" class="row">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Nome:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['name'] }}</h4>
                                    </div>
                                    <div class="col">
                                        <button_alter_meus_dados></button_alter_meus_dados>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>Empresa:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['company_name'] }}</h4>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>CPF / CNPJ:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['cnpj'] }}</h4>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>E-mail:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{ objetos['data']['user']['email'] }}</h4>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <hr>
                            <br><br>
                            <div class="card card-body">
                                <div class="card card-header">
                                    <h4>Meus Endereços</h4>
                                </div>
                                <div class="card card-body">
                                    <table_acordion2
                                        :classe_atributos="[
                                            { titulo: 'Logradouro', conteudo: 'street_name' },
                                            { titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood' },
                                            {
                                                titulo: 'Cidade',
                                                conteudo: 'bairro',
                                                conteudo2: 'cidade',
                                                conteudo3: 'name_city'
                                            },
                                            { titulo: 'Nº', conteudo: 'house_number' }

                                        ]"
                                        :objeto_imp="objetos['data']['enderecos']"
                                        :obj_acordion="[
                                            { titulo: 'Criado em', conteudo: 'created_at' },
                                            { titulo: 'Complemento', conteudo: 'complement' },
                                            { titulo: 'CEP', conteudo: 'cep' }
                                        ]">
                                    </table_acordion2>
                                </div>
                            </div>
                            <br><br>
                            <hr>
                            <br><br>
                            <div class="card card-body">
                                <div class="card card-header">
                                    <h4>Meus Telefones</h4>
                                </div>
                                <div class="card card-body">
                                    <table_acordion2
                                        :classe_atributos="[
                                            { titulo: 'Nº Telefone', conteudo: 'number_phone' }

                                        ]"
                                        :objeto_imp="objetos['data']['telefones']"
                                        :obj_acordion="[
                                            { titulo: 'Criado em', conteudo: 'created_at' }
                                        ]">
                                    </table_acordion2>
                                </div>
                            </div>
                        </div>

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nome', conteudo: 'name', ordenacao: 'enderecos.name' },
                                    { titulo: 'Logradouro', conteudo: 'street_name' },
                                    { titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood' },
                                    { titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city' },
                                    { titulo: 'Tipo', conteudo: 'enderecoable_type' },
                                    { titulo: 'Proprietario', conteudo: 'enderecoable', conteudo2: 'name' },
                                    { titulo: 'Nome empresa', conteudo: 'enderecoable', conteudo2: 'company_name' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' },
                                    { titulo: 'Nº', conteudo: 'house_number' },
                                    { titulo: 'Complemento', conteudo: 'complement' },
                                    { titulo: 'CEP', conteudo: 'cep' },
                                    { titulo: 'Latitude', conteudo: 'latitude' },
                                    { titulo: 'Longitude', conteudo: 'longitude' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion
                                :classe_atributos="[
                                    { titulo: 'Nº Telefone', conteudo: 'number_phone', ordenacao: 'telefone.number_phone' }

                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Criado em', conteudo: 'created_at' }
                                ]">
                            </table_acordion>
                        </div>

                        <!-- Tabela Pedido -->
                        <div v-else-if="nomeObjeto == 'pedido' && objetos !== null" class="row">
                            <table_acordion_pedidos_restrito
                                :classe_atributos="[
                                    { titulo: 'Data solicitação', conteudo: 'created_at', ordenacao: 'pedidos.created_at' },
                                    { titulo: 'Total', conteudo: 'total_price', ordenacao: 'pedidos.total_price' },
                                    {
                                        titulo: 'Metodo de pagamento',
                                        conteudo: 'metodo_pagamento',
                                        conteudo2: 'name',
                                        ordenacao: 'metodo_pagamentos.name'
                                    },
                                    {
                                        titulo: 'Cliente',
                                        conteudo: 'cliente',
                                        conteudo2: 'name',
                                        ordenacao: 'clientes.name'
                                    },
                                    {
                                        titulo: 'Vendedor',
                                        conteudo: 'vendedor',
                                        conteudo2: 'name',
                                        ordenacao: 'vendedors.name'
                                    }
                                ]"
                                :objeto_imp="objetos"
                                :obj_acordion="[
                                    { titulo: 'Pedido aprovado em', conteudo: 'approval_date' },
                                    { titulo: 'Data entrega', conteudo: 'delivery_date' },
                                    { titulo: 'Data pagamento', conteudo: 'payday' },
                                    { titulo: 'Descontos', conteudo: 'total_discount' },
                                    { titulo: 'Endereço', conteudo: 'endereco', conteudo2: 'name' },
                                    { titulo: 'Observação', conteudo: 'observation' }
                                ]">
                            </table_acordion_pedidos_restrito>
                        </div>
                    @endcan
                    <!-- Enquanto Carregando -->
                    <div v-else class="text-center">
                        <br><br>
                        <span class="spinner-border" style="width: 8rem; height: 8rem;" role="status"
                            aria-hidden="true"></span>
                        <h3>Carregando...</h3>
                    </div>
                </div>
                <div v-if="impressao == true">
                        <p v-on:click="impressao = false"><-</p>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td colspan="3"><img src="./logo.png" width="50" height="50"></td>
                                    <td colspan="7">SALGADOS ZILLA</td>
                                </tr>
                                <tr>
                                    <td colspan="7">Vendedor: @{{ pedidoImpressao['data']['vendedor']['name']}}</td>
                                    <td colspan="3" v-if="pedidoImpressao['data']['vendedor']['telefones'][0]">Contato vendedor: @{{ pedidoImpressao['data']['vendedor']['telefones'][0]['number_phone'] }}</td>

                                </tr>
                                <tr>
                                    <td colspan="4">Cliente:  @{{ pedidoImpressao['data']['cliente']['name']}}</td>
                                    <td colspan="3">Razão Social:  @{{ pedidoImpressao['data']['cliente']['company_name']}}</td>
                                    <td colspan="3" v-if="pedidoImpressao['data']['cliente']['telefones'][0]">Contato cliente:  @{{ pedidoImpressao['data']['cliente']['telefones'][0]['number_phone']}}</td> <!-- ERRO -->
                                </tr>
                                <tr>
                                    <td colspan="4">Cidade: @{{ pedidoImpressao['data']['endereco']['bairro']['cidade']['name_city']}}</td>
                                    <td colspan="4">Bairro: @{{ pedidoImpressao['data']['endereco']['bairro']['name_neighborhood']}}</td>
                                    <td colspan="2">CEP: @{{ pedidoImpressao['data']['endereco']['cep']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5">Logradouro: @{{ pedidoImpressao['data']['endereco']['street_name']}}</td>
                                    <td colspan="1">Nº @{{ pedidoImpressao['data']['endereco']['house_number']}}</td>
                                    <td colspan="4">Complemento: @{{ pedidoImpressao['data']['endereco']['complement']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Nº Pedido: @{{ pedidoImpressao['data']['id']}}</td>
                                    <td colspan="3">Forma de pagamento: @{{ pedidoImpressao['data']['metodo_pagamento']['name']}}</td>
                                    <td colspan="2">Descontos: R$ @{{ pedidoImpressao['data']['total_discount']}}</td>
                                    <td colspan="3">Total: R$ @{{ pedidoImpressao['data']['total_price']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Data emissão: @{{ new Date(pedidoImpressao['data']['created_at']).toLocaleString()}}</td>
                                    <td colspan="7">Observações: @{{ pedidoImpressao['data']['observation']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="10">
                                        itens
                                        <table_comum_sem_opcoes
                                            :classe_atributos="[
                                                { titulo: 'Nome', conteudo: 'name'},
                                                { titulo: 'Tipo',conteudo: 'tipo_produto', conteudo2: 'name'},
                                                { titulo: 'Marca', conteudo: 'marca', conteudo2: 'name' },
                                                { titulo: 'Quantidade por Pacote', conteudo: 'quantity' },
                                                { titulo: 'Peso por pacote ', conteudo: 'weight' },
                                                { titulo: 'Valor de Venda', conteudo: 'sale_price'}
                                            ]"
                                            :objeto_imp="pedidoImpressao['data']['produtos']"
                                        >
                                        </table_comum_sem_opcoes>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8">Declaro que recebi os produtos descritos neste pedido <br> Observações adicionais</td>
                                    <td colspan="2"
                                        >Nº Pedido:  @{{ pedidoImpressao['data']['id']}}<br>
                                        Cliente: @{{ pedidoImpressao['data']['cliente']['name']}}<br>
                                        TOTAL: R$ @{{ pedidoImpressao['data']['total_price']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10">Data: ___/___/___ Assinatura:
                                        ________________________________________________________________</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <div v-else class="text-center">
                <br><br>
                <span class="spinner-border" style="width: 8rem; height: 8rem;" role="status"
                    aria-hidden="true"></span>
                <h3>Carregando...</h3>
            </div>
        </div>

    </div>
</body>

@vite(['resources/js/app.js'])


</html>
