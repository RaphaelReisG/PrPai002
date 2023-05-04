
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
        <div style="display: none">
            {{ idUsuario = "<?php echo Auth::user()->userable->id;?>"  }}
            {{ tipoUsuario = "<?php echo Auth::user()->userable_type;?>"  }}
            {{ Auth::user()->email }}
            {{ Auth::user()->id }}
            {{ Auth::user()->userable->name }}
            {{ Auth::user()->userable->id }}
        </div>
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
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('administrador/'+idUsuario, 'Meus dados')">Meus dados</a></li>
                                    @elsecan('vendedor')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Endereços dos clientes</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Telefones dos clientes</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('vendedor/'+idUsuario, 'Meus dados')">Meus dados</a></li>
                                    @elsecan('cliente')
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Meus Endereços')">Meus Endereços</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="carregaMeusTelefones('telefone', 'Meus Telefones', 'cliente')">Meus Telefones</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('cliente/'+idUsuario, 'Meus dados')">Meus dados</a></li>
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
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('endereco', 'Endereços dos clientes')">Lista de endereços</a></li>
                                        <li><a class="dropdown-item" href="#" v-on:click="defineClasse('telefone', 'Telefones dos clientes')">Lista telefonica</a></li>
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

                            <x-responsive-nav-link style="margin-left: 5px; " class="btn btn-secondary" :href="route('logout')"
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
                    @else
                        Quem é você?
                    @endcan
                </div>

                <div v-if="titulo !== '' && titulo !== 'Meus dados'"> <!-- cabecalho geral -->
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
                        <paginacao v-if="nomeObjeto !== '' && objetos !== null && titulo !== 'Meus Telefones' "></paginacao>
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

                                <!-- formulario PAIS-->
                                <div v-if="nomeObjeto == 'pais'" class="modal-body">
                                    <input_geral nome="Nome do País" tipo="text" nome_model="name_country"></input_geral>
                                </div>

                                <!-- formulario TELEFONE-->
                                <div v-if="nomeObjeto == 'telefone'" class="modal-body">
                                    <input_geral nome="Numero Telefone" tipo="text" nome_model="number_phone"></input_geral>
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
                    <!-- Tabela Pedido -->
                    <div v-if="nomeObjeto == 'pedido' && objetos !== null" class="row">
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

                    @can('admin')
                        <!-- Tabela Cliente -->
                        <div v-else-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Nome', conteudo: 'name', ordenacao: 'clientes.name'},
                                                        {titulo: 'Razão Social', conteudo: 'company_name', ordenacao: 'clientes.company_name'},
                                                        {titulo: 'CPF / CNPJ', conteudo: 'cnpj', ordenacao: 'clientes.cnpj'},
                                                        {titulo: 'E-mail',  conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email'}
                                                    ]"
                                                    :objeto_imp="objetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'},
                                                        {titulo: 'Vendedor responsável', conteudo: 'vendedor', conteudo2: 'name'}
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
                                                        {titulo: 'Nome', conteudo: 'name', ordenacao: 'administradors.name'},
                                                        {titulo: 'E-mail',  conteudo: 'user', conteudo2: 'email', ordenacao: 'users.email'}
                                                    ]"
                                                    :objeto_imp="objetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'}
                                                    ]"
                                                >
                            </table_acordion>
                        </div>

                        <!-- Tabela Meus Dados Administradores -->
                        <div v-else-if="nomeObjeto == ('administrador/'+idUsuario) && objetos !== null" class="row">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Nome:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['name']}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>E-mail:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['user']['email']}}</h4>
                                    </div>
                                </div>
                            </div>
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

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Logradouro', conteudo: 'street_name'},
                                                        {titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood'},
                                                        {titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city'},
                                                        {titulo: 'Tipo', conteudo: 'enderecoable_type'},
                                                        {titulo: 'Proprietario',  conteudo: 'enderecoable', conteudo2: 'name'},
                                                        {titulo: 'Nome empresa',  conteudo: 'enderecoable', conteudo2: 'company_name'}

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

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Nº Telefone', conteudo: 'number_phone'},
                                                        {titulo: 'Contato', conteudo: 'telefoneable_type'},
                                                        {titulo: 'Nome Contato', conteudo: 'telefoneable', conteudo2: 'name'},
                                                        {titulo: 'Nome Empresa', conteudo: 'telefoneable', conteudo2: 'company_name'}

                                                    ]"
                                                    :objeto_imp="objetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'}
                                                    ]"
                                                >
                            </table_acordion>
                        </div>
                    @elsecan('vendedor')
                        <!-- Tabela Cliente -->
                        <div v-else-if="nomeObjeto == 'cliente' && objetos !== null" class="row">
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

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Logradouro', conteudo: 'street_name'},
                                                        {titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood'},
                                                        {titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city'},
                                                        {titulo: 'Tipo', conteudo: 'enderecoable_type'},
                                                        {titulo: 'Proprietario',  conteudo: 'enderecoable', conteudo2: 'name'},
                                                        {titulo: 'Nome empresa',  conteudo: 'enderecoable', conteudo2: 'company_name'}

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

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Nº Telefone', conteudo: 'number_phone'},
                                                        {titulo: 'Contato', conteudo: 'telefoneable_type'},
                                                        {titulo: 'Nome Contato', conteudo: 'telefoneable', conteudo2: 'name'},
                                                        {titulo: 'Nome Empresa', conteudo: 'telefoneable', conteudo2: 'company_name'}

                                                    ]"
                                                    :objeto_imp="objetos"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'}
                                                    ]"
                                                >
                            </table_acordion>
                        </div>
                    @elsecan('cliente')
                        <!-- Tabela Meus dados Cliente -->
                        <div v-else-if="nomeObjeto == ('cliente/'+idUsuario) && objetos !== null" class="row">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Nome:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['name']}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>Empresa:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['company_name']}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>CPF / CNPJ:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['cnpj']}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4>E-mail:</h4>
                                    </div>
                                    <div class="col">
                                        <h4>@{{objetos['data']['user']['email']}}</h4>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="card">
                                <div class="card card-header"> <h4>Meus Endereços</h4></div>
                                <div class="card card-body">
                                    <table_acordion2     :classe_atributos="[
                                                                {titulo: 'Logradouro', conteudo: 'street_name'},
                                                                {titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood'},
                                                                {titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city'},
                                                                {titulo: 'Nº', conteudo: 'house_number'}

                                                            ]"
                                                            :objeto_imp="objetos['data']['enderecos']"
                                                            :obj_acordion="[
                                                                {titulo: 'Criado em', conteudo: 'created_at'},
                                                                {titulo: 'Complemento', conteudo: 'complement'},
                                                                {titulo: 'CEP', conteudo: 'cep'}
                                                            ]"
                                                        >
                                    </table_acordion2>
                                </div>
                            </div>
                            <br><br>
                            <div class="card">
                                <div class="card card-header"> <h4>Meus Telefones</h4></div>
                                <div class="card card-body">
                                    <table_acordion2     :classe_atributos="[
                                                        {titulo: 'Nº Telefone', conteudo: 'number_phone'}

                                                    ]"
                                                    :objeto_imp="objetos['data']['telefones']"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'}
                                                    ]"
                                                >
                                    </table_acordion2>
                                </div>
                            </div>
                        </div>

                        <!-- Tabela Endereco -->
                        <div v-else-if="nomeObjeto == 'endereco' && objetos !== null" class="row">
                            <table_acordion     :classe_atributos="[
                                                        {titulo: 'Logradouro', conteudo: 'street_name'},
                                                        {titulo: 'Bairro', conteudo: 'bairro', conteudo2: 'name_neighborhood'},
                                                        {titulo: 'Cidade', conteudo: 'bairro', conteudo2: 'cidade', conteudo3: 'name_city'},
                                                        {titulo: 'Tipo', conteudo: 'enderecoable_type'},
                                                        {titulo: 'Proprietario',  conteudo: 'enderecoable', conteudo2: 'name'},
                                                        {titulo: 'Nome empresa',  conteudo: 'enderecoable', conteudo2: 'company_name'}

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

                        <!-- Tabela Telefone -->
                        <div v-else-if="nomeObjeto == 'telefone' && objetos !== null" class="row">
                            <table_acordion2     :classe_atributos="[
                                                        {titulo: 'Nº Telefone', conteudo: 'number_phone'}

                                                    ]"
                                                    :objeto_imp="objetos['data']['telefones']"
                                                    :obj_acordion="[
                                                        {titulo: 'Criado em', conteudo: 'created_at'}
                                                    ]"
                                                >
                            </table_acordion2>
                        </div>
                    @endcan


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
