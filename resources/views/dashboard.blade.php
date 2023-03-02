
{{ Auth::user()->email }}
{{ Auth::user()->id }}





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Dashboard - Smart_trade</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>
<body>
    <div id="app">
        <!-- Menu -->
        <div >
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Diario de Trader</a>
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
                                    Relatórios
                                </a>
                                <ul class="dropdown-menu">

                                    @can('cliente')
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalObjeto" v-on:click="defineClasse('credencialapibinance', 'API Binance'), carregaCredencialApi()">API Binance</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('', '')">Setup</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('', '')">Emoções</a></li>

                                    @elsecan('admin')



                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </a>
                                <ul class="dropdown-menu">

                                    @can('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Meus Pedidos')">Pedidos</a></li>

                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos dos meus clientes')">Pedidos</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Meus clientes')">Clientes</a></li>

                                    @elsecan('admin')

                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Clientes')">Clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('vendedor', 'Vendedores')">Vendedores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('administrador', 'Administradores')">Administradores</a></li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('fornecedor', 'Fornecedores')">Fornecedores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('produto', 'Produtos')">Produtos</a></li>

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

                <h2 v-if="titulo !== ''">
                    Novo
                    <button v-on:click=" limparModal(), acaoObjeto = 'Criar'" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalObjeto" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Add Manual
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
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div v-if="modalErro == false"> <!-- conteudo-->
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">@{{acaoObjeto}} @{{titulo}}</h1>
                            </div>
                            <div v-if="modalSucesso == false"> <!-- conteudo modal -->
                                <!-- formulario CLIENTE -->
                                <div v-if="nomeObjeto == 'cliente'" class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="João Pessoa" v-model="modelObjetos['nome']">
                                        <label for="floatingInput">Nome completo</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="modelObjetos['email']">
                                        <label for="floatingInput">E-mail</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['senha']">
                                        <label for="floatingPassword">Senha</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['confirmaSenha']">
                                        <label for="floatingPassword">Confirme a senha</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['chaveApi']">
                                        <label for="floatingPassword">Chave API</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['segredoApi']">
                                        <label for="floatingPassword">Segredo API</label>
                                    </div>
                                </div>
                                <!-- formulario ADMINISTRADOR -->
                                <div v-if="nomeObjeto == 'administrador'" class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="João Pessoa" v-model="modelObjetos['nome']">
                                        <label for="floatingInput">Nome completo</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="modelObjetos['email']">
                                        <label for="floatingInput">E-mail</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['senha']">
                                        <label for="floatingPassword">Senha</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['confirmaSenha']">
                                        <label for="floatingPassword">Confirme a senha</label>
                                    </div>
                                </div>
                                <!-- formulario DIARIO -->
                                <div v-if="nomeObjeto == 'diario'" class="modal-body">
                                    <div class="row">
                                        <div class="col">
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
                                        </div>
                                    </div>
                                </div>
                                 <!-- formulario CredencialApiBinance -->
                                 <div v-if="nomeObjeto == 'credencialapibinance'" class="modal-body">
                                    <div v-if="credencialApi == ''">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['key']">
                                            <label for="floatingPassword">Chave API</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="modelObjetos['secret']">
                                            <label for="floatingPassword">Segredo API</label>
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
                                        <h5>API já cadastrada!</h5>
                                        <button type="button" class="btn btn-outline-warning" v-on:click="credencialApi = '', acaoObjeto = 'Alterar'" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" v-on:click="">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="limparModal()">Sair</button>
                                         </div>
                                    </div>
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
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="BTCUSDT" v-model="modelObjetos['symbol']">
                                                <label for="floatingInput">Simbolo</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="floatingInput" placeholder="10/10/22" v-model="modelObjetos['startTime']">
                                                <label for="floatingInput">Apartir de:</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="floatingInput" placeholder="10/10/22" v-model="modelObjetos['endTime']">
                                                <label for="floatingInput">Até:</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" placeholder="10" v-model="modelObjetos['limite']">
                                                <label for="floatingInput">Limite</label>
                                            </div>
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
                                        <div v-if="objetos != ''">
                                            <div v-if="objetos['msg'] != null"> <!-- erro ao buscar-->
                                                <h3> Um erro foi encontrado ao tentar importar dados da API.</h3>
                                                <br>
                                                Codigo: @{{objetos.code}}
                                                <br>
                                                Mensagem de erro: @{{objetos.msg}}
                                            </div>
                                            <div v-else> <!-- sucesso ao buscar-->
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
                                                    <tbody class="table-group-divider" v-for="(obj, index) in objetos" style="font-size: 10px;">
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
                                        </div>
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

            <div v-if="objetos != ''">
                <!-- Tabela Cliente -->
                <div v-if="nomeObjeto == 'cliente'" class="row">
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
                                    <button type="button" class="btn btn-outline-warning" v-on:click="carregaCamposEditarObjeto(nomeObjeto, index) , acaoObjeto = 'Alterar'" data-bs-toggle="modal" data-bs-target="#modalObjeto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        Editar
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" v-on:click="desativarObjeto(nomeObjeto, obj.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                        Deletar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tabela Administradores -->
                <div v-if="nomeObjeto == 'administrador'" class="row">
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
                                    <button type="button" class="btn btn-outline-warning" v-on:click="carregaCamposEditarObjeto(nomeObjeto, index) , acaoObjeto = 'Alterar'"  data-bs-toggle="modal" data-bs-target="#modalObjeto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        Editar
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" v-on:click="desativarObjeto(nomeObjeto, obj.id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                        </svg>
                                        Deletar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tabela Diario -->
                <div v-if="nomeObjeto == 'diario'" class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Registro</th>
                                <th scope="col">Setup</th>
                                <th scope="col">Emoção</th>
                                <th scope="col">Compra/Venda</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Pontos</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Taxa</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Saída</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" v-for="(obj, index) in objetos">
                            <div>
                                <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample'+obj.id" data-bs-target="#collapseExample" aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">
                                    <th scope="row">@{{ obj.id }}</th>
                                    <td><input style="border: none; max-width: 145px;" readonly type="datetime-local" v-bind:value="obj.dataRegistro" value=""></td>
                                    <td>@{{ obj.setup }}</td>
                                    <td>@{{ obj.emocao }}</td>
                                    <td>@{{ obj.compraVenda }}</td>
                                    <td>@{{ obj.quantidade }}</td>
                                    <td>@{{ obj.pontos }}</td>
                                    <td>R$ @{{ obj.valor }}</td>
                                    <td>@{{ obj.taxa }} %</td>
                                    <td><input style="border: none; max-width: 145px;" readonly type="datetime-local" v-bind:value="obj.dtEntrada" value=""></td>
                                    <td><input style="border: none; max-width: 145px;" readonly type="datetime-local" v-bind:value="obj.dtSaida" value=""></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning" v-on:click="carregaCamposEditarObjeto(nomeObjeto, index) , acaoObjeto = 'Alterar'"  data-bs-toggle="modal" data-bs-target="#modalObjeto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" v-on:click="desativarObjeto(nomeObjeto, obj.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="12">
                                        <div class="collapse" v-bind:id="'collapseExample'+obj.id" id="collapseExample">
                                            <div class="card card-body">
                                                Feedback Emocional: @{{obj.fdEmocional }}
                                                <br><br>
                                                Feedback Imediato: @{{obj.fdImediato }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>

                <!-- Configurações -->
                <div v-if="titulo == 'credencialapibinance'" class="row">

                </div>
            </div>






        </div>
    </div>
</body>
<script src="{{ asset('js/app.js')}}"></script>
</html>
