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
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Configurações
                                </a>
                                <ul class="dropdown-menu">
                                    @can('admin')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('bairro', 'Bairros')">Bairro</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cidade', 'Cidade')">Cidade</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('estado', 'Estado')">Estado</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pais', 'País')">País</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Endereços dos clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Telefones dos clientes</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('user', 'Acesso')">Acesso</a></li>
                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Endereços dos clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Telefones dos clientes</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('user', 'Acesso')">Acesso</a></li>
                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Meus Endereços')">Meus Endereços</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('telefone', 'Meus Telefones')">Meus Telefones</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('user', 'Acesso')">Acesso</a></li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Opções
                                </a>
                                <ul class="dropdown-menu">
                                    @can('admin')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('administrador', 'Administrador')">Gerenciar Administradores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('vendedor', 'Vendedores')">Gerenciar Vendedores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Cliente')">Gerenciar Clientes</a></li>
                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente', 'Cliente')">Meus Clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>
                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Meus Pedidos</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @can('admin')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Fluxo
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('fornecedor', 'Fornecedor')">Fornecedores</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('marca', 'Marcas')">Marcas</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('produto', 'Produto')">Produtos</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('estoque', 'Estoque')">Estoque</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('pedido', 'Pedidos')">Pedidos</a></li>
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


                <div v-if="titulo !== ''"> <!-- cabecalho geral -->
                    <div class="row">
                        <div class="col">
                        <h2 >
                            Novo
                            <button_add></button_add>
                        </h2>
                    </div>
                        <div class="col">
                            <button_buscar></button_buscar>
                        </div>
                        <div>
                            <p> Ordenação Pendente</p>
                            <nav aria-label="..."> <!-- paginação -->
                                <ul class="pagination">
                                    <li class="page-item" v-if="objetos['current_page'] > 1">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['first_page_url'])">Primeiro</a>
                                    </li>
                                    <li class="page-item disabled" v-else>
                                        <a class="page-link" href="#">Primeiro</a>
                                    </li>
                                    <li class="page-item" v-if="objetos['current_page'] > 1" >
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['prev_page_url'])">&laquo; Anterior</a>
                                    </li>
                                    <li class="page-item disabled" v-else>
                                        <a class="page-link" href="#" tabindex="-1">&laquo; Anterior</a>
                                    </li>
                                    <li class="page-item" v-if="objetos['current_page'] > 2">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['links'][objetos['current_page'] - 2]['url'])">@{{objetos['current_page'] - 2}}</a>
                                    </li>
                                    <li class="page-item" v-if="objetos['current_page'] > 1">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['links'][objetos['current_page'] - 1]['url'])">@{{objetos['current_page'] - 1}}</a>
                                    </li>

                                    <li class="page-item active">
                                        <a class="page-link" href="#">@{{objetos['current_page']}} <span class="sr-only"></span></a>
                                    </li>

                                    <li class="page-item" v-if="(objetos['current_page'] + 1) <= objetos['last_page']">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['links'][objetos['current_page'] + 1]['url'])">@{{objetos['current_page'] + 1}}</a>
                                    </li>
                                    <li class="page-item" v-if="(objetos['current_page'] + 2) <= objetos['last_page']">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['links'][objetos['current_page'] + 2]['url'])">@{{objetos['current_page'] + 2}}</a>
                                    </li>

                                    <li class="page-item" v-if="(objetos['current_page'] + 1) <= objetos['last_page']">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['next_page_url'])">Próximo &raquo;</a>
                                    </li>
                                    <li class="page-item disabled" v-else>
                                        <a class="page-link" href="#">Próximo &raquo;</a>
                                    </li>
                                    <li class="page-item" v-if="(objetos['current_page'] + 1) <= objetos['last_page']">
                                        <a class="page-link" href="#" v-on:click="paginacao(objetos['last_page_url'])">Ultimo</a>
                                    </li>
                                    <li class="page-item disabled" v-else>
                                        <a class="page-link" href="#">Ultimo</a>
                                    </li>
                                </ul>
                            </nav>
                            <p>Maximo por Pagina: @{{objetos['per_page']}} | Total: @{{objetos['total']}}</p>
                        </div>
                    </div>

                </div>
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
                                    <input_geral nome="Nome Completo" tipo="text" nome_model="name"></input_geral>
                                    <input_geral nome="E-mail" tipo="email" nome_model="email"></input_geral>
                                    <div v-if="acaoObjeto == 'Criar'">
                                    <senha_geral nome="Senha" nome_model="senha"></senha_geral>
                                    <senha_geral nome="Confirme a senha" nome_model="confirmaSenha"></senha_geral>
                                    </div>
                                </div>

                                <!-- Rodapé -->
                                <div class="modal-footer">
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
                    <div v-else-if="nomeObjeto == 'vendedor' && objetos !== null" class="row">
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

                    <!-- Tabela Fornecedor -->
                    <div v-else-if="nomeObjeto == 'fornecedor' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome Empresa', conteudo: 'company_name'},
                                                    {titulo: 'E-mail',  conteudo: 'email'},
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Marca -->
                    <div v-else-if="nomeObjeto == 'marca' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name'},
                                                    {titulo: 'Fornecedor',  conteudo: 'fornecedor', conteudo2: 'company_name'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Produto -->
                    <div v-else-if="nomeObjeto == 'produto' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                            {titulo: 'Nome', conteudo: 'name'},
                                                    {titulo: 'Tipo', conteudo: 'type'},
                                                    {titulo: 'Valor de Venda', conteudo: 'sale_price'},
                                                    {titulo: 'Marca',  conteudo: 'marca', conteudo2: 'name'}
                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'},
                                                    {titulo: 'Quantidade por Pacote', conteudo: 'quantity'},
                                                    {titulo: 'Peso por pacote ', conteudo: 'weight'},
                                                    {titulo: 'Preço de custo', conteudo: 'cost_price'},
                                                    {titulo: 'Fornecedor',  conteudo: 'marca', conteudo2: 'fornecedor', conteudo3: 'company_name'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Bairro -->
                    <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Logradouro', conteudo: 'street_name'},
                                                    {titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood'},
                                                    {titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city'},
                                                    {titulo: 'Tipo', conteudo: 'enderecoable_type'},
                                                    {titulo: 'Proprietario',  conteudo: 'enderecoable', conteudo2: 'name'}

                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'},
                                                    {titulo: 'Nº', conteudo: 'house_number'},
                                                    {titulo: 'Complemento', conteudo: 'complement'},
                                                    {titulo: 'CEP', conteudo: 'cep'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Bairro -->
                    <div v-else-if="nomeObjeto == 'bairro' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name_neighborhood'},
                                                    {titulo: 'Cidade',  conteudo: 'cidade', conteudo2: 'name_city'}

                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'},
                                                    {titulo: 'Estado',  conteudo: 'cidade', conteudo2: 'estado', conteudo3: 'name_state'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Cidade -->
                    <div v-else-if="nomeObjeto == 'cidade' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name_city'},
                                                    {titulo: 'Estado',  conteudo: 'estado', conteudo2: 'name_state'}

                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'},
                                                    {titulo: 'País',  conteudo: 'estado', conteudo2: 'pais', conteudo3: 'name_country'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Estado -->
                    <div v-else-if="nomeObjeto == 'estado' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name_state'},
                                                    {titulo: 'País',  conteudo: 'pais', conteudo2: 'name_country'}

                                                ]"
                                                :objeto_imp="objetos"
                                                :obj_acordion="[
                                                    {titulo: 'Criado em', conteudo: 'created_at'}
                                                ]"
                                               >
                        </table_acordion>
                    </div>

                    <!-- Tabela Pais -->
                    <div v-else-if="nomeObjeto == 'pais' && objetos !== null" class="row">
                        <table_acordion     :classe_atributos="[
                                                    {titulo: 'Nome', conteudo: 'name_country'}

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
