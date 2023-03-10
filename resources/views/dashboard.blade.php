{{ Auth::user()->email }}
{{ Auth::user()->id }}





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Dashboard - Salgados</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script>
    <!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->
    

    

</head>
<body>
    <div id="app">
    {{ idUsuario = "<?php echo Auth::user()->id;?>"  }}
        <!-- Menu -->
        <div >
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Salgado Zilla</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <li class="nav-item">
                                <a class="nav-link" v-on:click="defineClasse('', '')" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <!-- <a class="nav-link" v-on:click="mostrarConteinerObjeto('credencialapibinance')" >Configurações</a> -->
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Configurações
                                </a>
                                <ul class="dropdown-menu">

                                    @can('user')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('credencialapibinance', 'API Binance')">API Binance</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('setup', 'Config Setup')">Setup</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('emocao', 'Config Emoção')">Emoções</a></li>

                                    @elsecan('admin')

                                       

                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </a>
                                <ul class="dropdown-menu">

                                    @can('user')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('diario', 'Diario Trader')">Gerenciar Trades</a></li>

                                    @elsecan('admin')

                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Cliente')">Gerenciar Clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('administrador', 'Administrador')">Gerenciar Administradores</a></li>
                                        
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('diario', 'Diario Trader')">Gerenciar Trades</a></li>

                                    @endcan
                                </ul>
                            </li>
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

                        Olá, {{ Auth::user()->name }} , seja bem vindo!

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link style="margin-left: 5px; margin-bottom: -15px; " class="btn btn-secondary" :href="route('logout')"
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
<!--
        <p>teste</p>
        <div v-for="(value, name) in objetos[0]">
            <p> ok @{{name}}</p>
        </div>
-->



        <!-- Conteudo Geral CRUDs -->
        <div class="container-lg">
            <div class="row">
                <h1>@{{titulo}}</h1>
            </div>
            <div class="row"><hr></div>
            <div class="row">
                <div v-if="titulo == ''">
                    @can('user')
                        Olá cliente seja bem vindo e fique a vontade para explorar a sua ferramenta de diario de trade.
                    @elsecan('admin')
                        Olá Administrador, seja bem vindo ao sistema.
                    @endcan
                </div>
                

                

                <h2 v-if="titulo !== ''"> <!-- cabecalho geral -->
                    Novo
                    <button v-on:click=" limparModal(), acaoObjeto = 'Criar'" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalObjeto" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Add
                    </button>
                    <button style="margin-left: 10px;" v-if="nomeObjeto == 'diario'" v-on:click=" limparModal(), acaoObjeto = 'AddAPI'" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalObjetoApi" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Add por API
                    </button>
                </h2>
            </div>
            
            
            <!-- Modal Cadastro/edicao geral -->
            <div class="modal fade" id="modalObjeto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div v-if="modalErro == false"> <!-- conteudo-->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">@{{acaoObjeto}} @{{titulo}}</h1>
                            </div>
                            <div v-if="modalSucesso == false"> <!-- conteudo modal -->
                                <!-- formulario CLIENTE / ADMINISTRADOR-->
                                <div v-if="nomeObjeto == 'cliente' || nomeObjeto == 'administrador'" class="modal-body">
                                    <input_geral nome="Nome Completo" tipo="text" nome_model="nome"></input_geral>
                                    <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                    <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                    <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                </div> 
                                <!-- formulario DIARIO -->
                                <div v-if="nomeObjeto == 'diario'" class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <select_geral nome="Setup" :obj_dropdown="setups" nome_atributo="nomeSetup"  nome_model="setup"></select_geral>
                                            <select_geral nome="Emoção" :obj_dropdown="emocaos" nome_atributo="nomeEmocao"  nome_model="emocao"></select_geral>
                                            <input_geral nome="Simbolo (PAR)" tipo="text" nome_model="simbolo"></input_geral>
                                            <select_geral nome="Compra/Venda" :obj_dropdown="compra_venda" nome_atributo="valor"  nome_model="compraVenda"></select_geral>
                                            <input_geral nome="Quantidade" tipo="number" nome_model="quantidade"></input_geral>
                                        </div>
                                        <div class="col">
                                            <input_geral nome="Valor Entrada" tipo="number" nome_model="valorEntrada"></input_geral>
                                            <input_geral nome="Valor Saida" tipo="number" nome_model="valorSaida"></input_geral>
                                            <input_geral nome="Taxa" tipo="number" nome_model="taxa"></input_geral>
                                            <input_geral nome="Entrada" tipo="datetime-local" nome_model="dtEntrada"></input_geral>
                                            <input_geral nome="Saida" tipo="datetime-local" nome_model="dtSaida"></input_geral>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <textarea_geral nome="Feedback Emocional" nome_model="fdEmocional"></textarea_geral>
                                        <textarea_geral nome="Feedback Imediato" nome_model="fdImediato"></textarea_geral>
                                    </div>
                                </div>
                                 <!-- formulario CredencialApiBinance -->
                                 <div v-if="nomeObjeto == 'credencialapibinance'" class="modal-body">
                                    <div v-if="objetos['key'] == 'Api Vazia' || acaoObjeto == 'Alterar'" >
                                        <senha_geral nome="Chave API" nome_model="key"></senha_geral>
                                        <senha_geral nome="Segredo API" nome_model="secret"></senha_geral>

                                        <div class="modal-footer">
                                            <button_cancelar_modal rotulo="Cancelar"></button_cancelar_modal>
                                            <button_acao></button_acao>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="row">
                                            <div class="col"> <h5>API já cadastrada! </h5>  </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button_cancelar_modal rotulo="Sair"></button_cancelar_modal>
                                        </div>
                                    </div>
                                </div> 
                                <!-- formulario SETUP -->
                                <div v-if="nomeObjeto == 'setup'" class="modal-body">
                                    <input_geral nome="Nome Setup" tipo="text" nome_model="nomeSetup"></input_geral>
                                </div> 
                                <!-- formulario EMOCAO -->
                                <div v-if="nomeObjeto == 'emocao'" class="modal-body">
                                    <input_geral nome="Nome Emoção" tipo="text" nome_model="nomeEmocao"></input_geral>
                                </div> 

                                <!-- Rodapé -->
                                <div class="modal-footer" v-if="nomeObjeto != 'credencialapibinance'">
                                    <button_cancelar_modal rotulo="Cancelar"></button_cancelar_modal>
                                    <button_acao></button_acao>
                                </div>
                                
                            </div>
                            <div v-else> <!-- Operação realizada com sucesso -->
                                <div class="modal-body">
                                    Operação realizada com sucesso!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="modalSucesso = false">OK</button>
                                </div>
                            </div>
                        </div>
                        <div v-else> <!-- Erro retornado!-->
                            <div class="modal-body">
                                <p>ALERTA ERRO! O seguinte erro foi encontrado ao realizar a operação:</p>
                                <p>@{{error}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="modalErro = false">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal cadastro Diario importando por API Binance -->
            <div class="modal fade" id="modalObjetoApi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl ">
                    <div class="modal-content">
                        <div v-if="modalErro == false"> <!-- conteudo-->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">@{{acaoObjeto}} @{{titulo}}</h1>
                            </div>
                            <div v-if="modalSucesso == false"> <!-- conteudo-->
                                <div class="modal-body"> <!-- conteudo-->
                                    <div class="row"><!-- formulario de busca de dados API-->
                                        <div class="col">
                                            <input_geral nome="Simbolo" tipo="text" nome_model="symbol"></input_geral>
                                        </div>
                                        <div class="col">
                                            <input_geral nome="Apartir de" tipo="date" nome_model="startTime"></input_geral>
                                        </div>
                                        <div class="col">
                                            <input_geral nome="Até" tipo="date" nome_model="endTime"></input_geral>
                                        </div>
                                        <div class="col">
                                            <input_geral nome="Limite" tipo="number" nome_model="limite"></input_geral>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary" v-on:click="carregarApiBinance()">
                                                <span v-if="carregando == true" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                                                Buscar
                                            </button>
                                        </div>
                                    </div>

                                    <hr>

                                    <div v-if="buscaApi == true" class="row">
                                        <div v-if="apiObjetos != ''">
                                            <div v-if="apiObjetos['msg'] != null"> <!-- erro ao buscar-->
                                                <h3> Um erro foi encontrado ao tentar importar dados da API.</h3>
                                                <br>
                                                Codigo: @{{apiObjetos.code}}
                                                <br>
                                                Mensagem de erro: @{{apiObjetos.msg}}
                                            </div>
                                            <div v-else> <!-- sucesso ao buscar-->
                                                <table_acordion_api
                                                    :classe_atributos="[
                                                        {titulo: 'Data', conteudo: 'time'},
                                                        {titulo: 'Status', conteudo: 'status'},
                                                        {titulo: 'Preço ordem', conteudo: 'price'},
                                                        {titulo: 'Preço médio - AVG', conteudo: 'avgPrice'},
                                                        {titulo: 'Tipo', conteudo: 'type'},
                                                        {titulo: 'Compra/Venda', conteudo: 'side'},
                                                    ]"
                                                    :objeto_imp="apiObjetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Id Order', conteudo: 'orderId'},
                                                        {titulo: 'ClientOrderId', conteudo: 'clientOrderId'},
                                                        {titulo: 'Valor - OrigQty', conteudo: 'origQty'},
                                                        {titulo: 'Preço Executado - executedQty', conteudo: 'executedQty'},
                                                        {titulo: 'Simbolo', conteudo: 'symbol'},
                                                        {titulo: 'Total - cumQuote', conteudo: 'cumQuote'},

                                                        {titulo: 'timeInForce', conteudo: 'timeInForce'},
                                                        {titulo: 'Somente Redução - reduceOnly', conteudo: 'reduceOnly'},
                                                        {titulo: 'closePosition', conteudo: 'closePosition'},
                                                        

                                                        {titulo: 'Aposta - positionSide', conteudo: 'positionSide'},
                                                        {titulo: 'stopPrice', conteudo: 'stopPrice'},
                                                        {titulo: 'workingType', conteudo: 'workingType'},
                                                        {titulo: 'priceProtect', conteudo: 'priceProtect'},
                                                        {titulo: 'origType', conteudo: 'origType'},
                                                        {titulo: 'updateTime', conteudo: 'updateTime'}

                                                    ]"
                                                >
                                                </table_acordion_api>
                                                <!--
                                                <table_acordion_api
                                                    :classe_atributos="[
                                                        {titulo: 'Data', conteudo: 'time'},
                                                        {titulo: 'Preço moeda', conteudo: 'price'},
                                                        {titulo: 'Qtd', conteudo: 'qty'},
                                                        {titulo: 'Preço x Qty', conteudo: 'quoteQty'}
                                                    ]"
                                                    :objeto_imp="apiObjetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Id Order', conteudo: 'orderId'},
                                                        {titulo: 'Id', conteudo: 'id'},
                                                        {titulo: 'Order List', conteudo: 'orderListId'},
                                                        {titulo: 'Simbolo', conteudo: 'symbol'},
                                                        {titulo: 'Comission', conteudo: 'comission'},
                                                        {titulo: 'IsBuyer', conteudo: 'isBuyer'},
                                                        {titulo: 'IsMaker', conteudo: 'isMaker'},
                                                        {titulo: 'IsBestMatch', conteudo: 'isBestMatch'},
                                                    ]"
                                                >
                                                </table_acordion_api>
                                                    -->
                                            </div>

                                            <div v-if="banana == true"> <!-- sucesso ao buscar-->
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Data</th>
                                                            <th scope="col">Tipo</th>
                                                            <th scope="col">Side</th>
                                                            <th scope="col">Preço</th>
                                                            <th scope="col">Avg Preço</th>
                                                            <th scope="col">Executado</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">UpdateTime</th>
                                                            <th scope="col">Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-group-divider" v-for="(obj, index) in apiObjetos" style="font-size: 10px;">
                                                        <div> <!-- linha-->
                                                            <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample'+obj.orderId" data-bs-target="#collapseExample" aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">
                                                                <th scope="row">@{{ new Date(obj.time) }}</th>
                                                                <td>@{{ obj.origType }}</td>
                                                                <td>@{{ obj.side }}</td>
                                                                <td>@{{ obj.price }}</td>
                                                                <td>R$ @{{ obj.avgPrice }}</td>
                                                                <td>@{{ obj.executedQty }} </td>
                                                                <td>@{{ obj.cumQuote }}</td>
                                                                <td>@{{ obj.status }}</td>
                                                                <td>@{{ new Date(obj.updateTime) }}</td>
                                                                <td>
                                                                    <button type="button" class="btn btn-outline-secondary" v-on:click="carregaCamposEditarObjeto(nomeObjeto, index), buscaApi = false"> 
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="12"> <!-- acordion-->
                                                                    <div class="collapse" v-bind:id="'collapseExample'+obj.orderId" id="collapseExample"> 
                                                                        <div class="card card-body">
                                                                            ID Order: @{{ obj.orderId }}
                                                                            <br><br>
                                                                            Simbolo: @{{ obj.symbol }}
                                                                            <br><br>
                                                                            ClientOrderId: @{{obj.clientOrderId }}
                                                                            <br><br>
                                                                            origQty: @{{obj.origQty }}
                                                                            <br><br>
                                                                            TimeInForce: @{{obj.timeInForce }}
                                                                            <br><br>
                                                                            ReduceOnly: @{{obj.reduceOnly }}
                                                                            <br><br>
                                                                            closePosition: @{{obj.closePosition }}
                                                                            <br><br>
                                                                            positionSide: @{{obj.positionSide }}
                                                                            <br><br>
                                                                            stopPrice: @{{obj.stopPrice }}
                                                                            <br><br>
                                                                            workingType: @{{obj.workingType }}
                                                                            <br><br>
                                                                            priceProtect: @{{obj.priceProtect }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </div>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row"> <!-- formulario Diario padrão-->
                                        <div class="row">
                                            <div class="col">
                                                <select_geral nome="Setup" :obj_dropdown="setups" nome_atributo="nomeSetup"  nome_model="setup"></select_geral>
                                                <select_geral nome="Emoção" :obj_dropdown="emocaos" nome_atributo="nomeEmocao"  nome_model="emocao"></select_geral>
                                                <input_geral nome="Simbolo (PAR)" tipo="text" nome_model="simbolo"></input_geral>
                                                <select_geral nome="Compra/Venda" :obj_dropdown="compra_venda" nome_atributo="valor"  nome_model="compraVenda"></select_geral>
                                                <input_geral nome="Quantidade" tipo="number" nome_model="quantidade"></input_geral>
                                            </div>
                                            <div class="col">
                                                <input_geral nome="Valor Entrada" tipo="number" nome_model="valorEntrada"></input_geral>
                                                <input_geral nome="Valor Saida" tipo="number" nome_model="valorSaida"></input_geral>
                                                <input_geral nome="Taxa" tipo="number" nome_model="taxa"></input_geral>
                                                <input_geral nome="Entrada" tipo="datetime-local" nome_model="dtEntrada"></input_geral>
                                                <input_geral nome="Saida" tipo="datetime-local" nome_model="dtSaida"></input_geral>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <textarea_geral nome="Feedback Emocional" nome_model="fdEmocional"></textarea_geral>
                                            <textarea_geral nome="Feedback Imediato" nome_model="fdImediato"></textarea_geral>
                                        </div>
                                        <!--
                                        <div class="col">
                                            <input type="hidden" readonly v-model="modelObjetos['idUsuario']" >
                                            <div class="form-floating mb-3">
                                                <input type="datetime-local" class="form-control" id="floatingInput" placeholder="10/10/22" v-model="modelObjetos['dataRegistro']">
                                                <label for="floatingInput">Registro</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" list="listaSetup" class="form-control" id="floatingInput" placeholder="Principe" v-model="modelObjetos['setup']">
                                                <label for="floatingInput">Setup</label>
                                                <datalist id="listaSetup">
                                                    <option value="Agressão">
                                                    <option value="Rompimento">
                                                    <option value="Reversão Abertura">
                                                    <option value="Fluxo">
                                                    <option value="Ajuste">
                                                    <option value="Erro Operacional">
                                                    <option value="Principe">
                                                    <option value="Martelo">
                                                    <option value="Estrela">
                                                </datalist>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" list="listaEmocao" class="form-control" id="floatingInput" placeholder="Alegria" v-model="modelObjetos['emocao']">
                                                <label for="floatingInput">Emoção</label>
                                                <datalist id="listaEmocao">
                                                    <option value="Alegria">
                                                    <option value="Raiva">
                                                    <option value="Ansiedade">
                                                    <option value="Tristeza">
                                                    <option value="Frustração">
                                                    <option value="Empolgação">
                                                    <option value="Tédio">
                                                    <option value="Vingança">
                                                    <option value="Confiante">
                                                    <option value="Recesso">
                                                </datalist>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select id="floatingInput" class="form-select" aria-label="Selecione Compra ou Venda" v-model="modelObjetos['compraVenda']">
                                                    <option value="Compra">Compra</option>
                                                    <option value="Venda">Venda</option>
                                                </select>
                                                <label for="floatingInput">Compra/Venda</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="10" v-model="modelObjetos['quantidade']">
                                                <label for="floatingInput">Quantidade</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="10" v-model="modelObjetos['pontos']">
                                                <label for="floatingInput">Pontos</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="10,00" v-model="modelObjetos['valor']">
                                                <label for="floatingInput">Valor</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="10%" v-model="modelObjetos['taxa']">
                                                <label for="floatingInput">Taxa</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="datetime-local" class="form-control" id="floatingInput" placeholder="10" v-model="modelObjetos['dtEntrada']">
                                                <label for="floatingInput">Entrada</label>
                                            </div>
                                            <div class="form-floating">
                                                <input type="datetime-local" class="form-control" id="floatingInput" placeholder="10/10/22" v-model="modelObjetos['dtSaida']">
                                                <label for="floatingInput">Saída</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Escreva seu feedback emocional aqui." id="floatingTextarea" v-model="modelObjetos['fdEmocional']"></textarea>
                                                <label for="floatingTextarea">Feedback Emocional</label>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Escreva seu feedback imediato aqui" id="floatingTextarea" v-model="modelObjetos['fdImediato']"></textarea>
                                                <label for="floatingTextarea">Feedback Imediato</label>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="limparModal()">Cancelar</button>
                                    <button type="button" class="btn btn-primary" v-on:click="escolheAcaoObjeto(acaoObjeto, nomeObjeto)">
                                        <span v-if="carregando == true" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
                                        @{{acaoObjeto}}
                                    </button>
                                </div>
                            </div>
                            <div v-else>
                                <div class="modal-body"> <!-- operação com sucesso-->
                                    Operação realizada com sucesso
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="modalSucesso = false">OK</button>
                                </div>
                            </div>
                        </div>
                        <div v-else> <!-- erro encontrado ao cadastrar-->
                            <div class="modal-body">
                                <p>ALERTA ERRO! O seguinte erro foi encontrado ao tentar um novo cadastro:</p>
                                <p>@{{error}}</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="modalErro = false">OK</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

           
                <div v-if="titulo != ''">
                    <!-- Tabela Cliente -->
                    <div v-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
                        <table class="table">
                            <thead> <!-- CABECALHO VARIA CONFORME CLASSE -->
                                <tr>  
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome Completo</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider"> <!-- CORPO VARIA CNFORME CLASSE -->
                                <tr v-for="(obj, index) in objetos">
                                    <th scope="row">@{{obj.id}} </th>
                                    <td>@{{ obj.nome }}</td>
                                    <td>@{{ obj.email }}</td>
                                    <td>
                                        <button_alter :objindex="index"></button_alter>
                                        <button_delete v-bind:objid= "obj.id"></button_delete>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabela Administradores -->
                    <div v-else-if="nomeObjeto == 'administrador' && objetos !== null" class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome Completo</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="(obj, index) in objetos">
                                    <th scope="row">@{{ obj.id }}</th>
                                    <td>@{{ obj.nome }}</td>
                                    <td>@{{ obj.email }}</td>
                                    <td>
                                        <button_alter :objindex="index"></button_alter>
                                        <button_delete v-bind:objid= "obj.id"></button_delete>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Tabela Diario -->
                    <div v-else-if="nomeObjeto == 'diario' && objetos !== null" class="row">
                        
                            <table_acordion     :classe_atributos="[
                                                    {titulo: 'Registro', conteudo: 'created_at'},
                                                    {titulo: 'Setup', conteudo: 'setup'},
                                                    {titulo: 'Emoção', conteudo: 'emocao'},
                                                    {titulo: 'Simbolo', conteudo: 'simbolo'},
                                                    {titulo: 'Compra/Venda',  conteudo: 'compraVenda'},
                                                    {titulo: 'Quantidade', conteudo: 'quantidade' },
                                                    {titulo: 'Valor Entrada', conteudo: 'valorSaida'},
                                                    {titulo: 'Valor Saida', conteudo: 'valorSaida'},
                                                    {titulo: 'Entrada', conteudo: 'dtEntrada'},
                                                    {titulo: 'Saida', conteudo: 'dtSaida'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Feedback Emocional', conteudo: 'fdEmocional'},
                                                    {titulo: 'Feedback Imediato', conteudo: 'fdImediato'}
                                                ]"
                                               >
                            </table_acordion>
                        
                      
                                                
                    </div>

                    <!-- Tabela Setup -->
                    <div v-else-if="nomeObjeto == 'setup' && objetos !== null" class="row">
                        <table_config       :classe_atributos="[{titulo: 'Nome Setup', conteudo: 'nomeSetup'}]"
                                            :objeto_imp="objetos">
                        </table_config>
                    </div>

                    <!-- Tabela Emocao -->
                    <div v-else-if="nomeObjeto == 'emocao' && objetos !== null" class="row">
                        <table_config       :classe_atributos="[{titulo: 'Nome Emoção', conteudo: 'nomeEmocao'}]"
                                            :objeto_imp="objetos">
                        </table_config>
                    </div>

                    <!-- Credencial API Binance -->
                    <div v-else-if="nomeObjeto == 'credencialapibinance' && objetos !== null" class="row">
                        <div v-if="objetos['key'] == 'Api Vazia'">
                            <p>Nenhuma API Cadastrada.</p>
                        </div>
                        <div v-else>
                        <div class="row">
                            <div class="col"> <h5>API já cadastrada! </h5>  </div>
                            <div class="col">
                                <h5> Chave: @{{objetos[0]['key'].substr(0, 4)}}...  </h5>
                            </div>
                            <div class="col">
                                <button_alter :objindex="0"></button_alter>
                                <button_delete :objid= "idUsuario"></button_delete>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enquanto Carregando -->
                    <div v-else class="text-center">
                        <br><br>
                        <span class="spinner-border" style="width: 8rem; height: 8rem;" role="status" aria-hidden="true" ></span>
                        <h3>Carregando...</h3>
                    </div>
                </div>
            

            
        </div>
    </div>
</body>

@vite(['resources/js/app.js'])
</html>