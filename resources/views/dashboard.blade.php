{{ Auth::user()->email }}
{{ Auth::user()->id }}
{{ Auth::user()->userable->name }}





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

                                    @can('admin')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('produto', 'Produto')">Produtos</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('fornecedor', 'Fornecedor')">Fornecedores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('estoque', 'Estoque')">Estoque</a></li>

                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Meus Endereços')">Endereço</a></li>


                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </a>
                                <ul class="dropdown-menu">

                                    @can('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>

                                    @elsecan('admin')

                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Cliente')">Gerenciar Clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('administrador', 'Administrador')">Gerenciar Administradores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('vendedor', 'Vendedores')">Gerenciar Vendedores</a></li>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>

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

                        Olá, {{ Auth::user()->userable->name }} , seja bem vindo!

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
                    @can('cliente')
                        Olá cliente seja bem vindo e fique a vontade para explorar a sua ferramenta de diario de trade.
                    @elsecan('admin')
                        Olá Administrador, seja bem vindo ao sistema.
                    @elsecan('vendedor')
                        Olá Vendedor, seja bem vindo ao sistema.
                    @endcan
                </div>




                <h2 v-if="titulo !== ''"> <!-- cabecalho geral -->
                    Novo
                    <button_add></button_add>
                    <button v-on:click=" limparModal(), acaoObjeto = 'Criar'" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalObjeto" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        Add
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
                                <!-- formulario CLIENTE -->
                                <div v-if="nomeObjeto == 'cliente'" class="modal-body">
                                    <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                    <input_geral nome="Razão Social" tipo="text" nome_model="company_name"></input_geral>
                                    <input_geral nome="CPF ou CNPJ" tipo="number" nome_model="cnpj"></input_geral>
                                    <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                </div>
                                <!-- formulario ADMINISTRADOR-->
                                <div v-if="nomeObjeto == 'administrador'" class="modal-body">
                                    <input_geral nome="Nome Completo" tipo="text" nome_model="nome"></input_geral>
                                    <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                    <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                    <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
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


                <div v-if="titulo != ''">
                    <!-- Tabela Cliente -->
                    <div v-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name'},
                                                    {titulo: 'Razão Social', conteudo: 'company_name'},
                                                    {titulo: 'CPF / CNPJ', conteudo: 'cnpj'},
                                                    {titulo: 'Vendedor', conteudo: 'vendedor', conteudo2: 'name' },
                                                    {titulo: 'E-mail',  conteudo: 'user', conteudo2: 'email'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Vendedor -->
                    <div v-if="nomeObjeto == 'vendedor' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name'},
                                                    {titulo: 'E-mail',  conteudo: 'user', conteudo2: 'email'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Administradores -->
                    <div v-else-if="nomeObjeto == 'administrador' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name'},
                                                    {titulo: 'E-mail',  conteudo: 'user', conteudo2: 'email'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
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
