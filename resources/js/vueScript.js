import { forEach } from "lodash";

var app = new Vue({
    el: '#app',
    data: {
        idUsuario: "{{ Auth::user()->id }}",
        tokenUsuario: "",
        tipoUsuario: '',
        nomeUsuario: '',
        titulo: "",
        acaoObjeto: "",
        nomeObjeto: "",
        meuDado: false,

        impressao: false,

        alterarSenha: false,

        tiposPessoa: [
            {tipo: 'App\\Models\\Cliente', label: 'Cliente'},
            {tipo: 'App\\Models\\Vendedor', label: 'Vendedor'},
            {tipo: 'App\\Models\\Fornecedor', label: 'Fornecedor'},
        ],

        resposta: [{}],

        error: null,
        carregando: false,
        carregandoGeral: false,
        carregandoModal: false,
        carregandoImpressao: false,
        objetos: [{}],
        modalErro: false,
        modalSucesso: false,
        temPaginacao: false,
        modelObjetos:[{
            id: "",

            name: "", email: "", senha: "", confirmaSenha: "", //admin e vendedor

            company_name: "", cnpj: "", vendedor_id: "", //cliente e fornecedor

            number_phone: "", telefoneable_id: "", telefoneable_type: "", //telefone

            fornecedor_id: "", //marca

            tipo_produto_id: "", quantity: "", weight: "", cost_price: "", sale_price: "", marca_id: "",  //produto

            metodo_pagamento_id: "", cliente_id: "", payday: "", delivery_date: "", approval_date: "", total_price: 0, total_discount: 0, endereco_id: "",//pedido

            tipo_movimentacaos_id: "", qty_item: "", observation: "", produto_id: "", //estoque

            name_country: "",  // pais

            name_state: "", pais_id: "", // estado

            name_city: "", estado_id: "", // cidade

            name_neighborhood: "", cidade_id: "", //bairro

            street_name: "", house_number: "", cep: "", complement: "", enderecoable_id: "", enderecoable_type: "",

            buscarObjeto: "", ordenacaoBusca: "", tipoPessoa: "", buscarObjetoProduto: "",

        }],

        alertaCampo: [{
            id: "",

            name: "", email: "", senha: "", confirmaSenha: "", //admin e vendedor

            company_name: "", cnpj: "", vendedor_id: "", //cliente e fornecedor

            number_phone: "", telefoneable_id: "", telefoneable_type: "", //telefone

            fornecedor_id: "", //marca

            tipo_produto_id: "", quantity: "", weight: "", cost_price: "", sale_price: "", marca_id: "", //produto

            metodo_pagamento_id: "", cliente_id: "", payday: "", delivery_date: "", approval_date: "", total_price: 0, total_discount: "", endereco_id: "", //pedido

            tipo_movimentacaos_id: "", qty_item: "", observation: "", produto_id: "", //estoque

            name_country: "",  // pais

            name_state: "", pais_id: "", // estado

            name_city: "", estado_id: "", // cidade

            name_neighborhood: "", cidade_id: "", //bairro

            street_name: "", house_number: "", cep: "", complement: "", enderecoable_id: "", enderecoable_type: "",

            buscarObjeto: "", ordenacaoBusca: "", tipoPessoa: "", buscarObjetoProduto: "",
        }],

        index: "",

        paises: [{}],
        estados: [{}],
        cidades: [{}],
        bairros: [{}],
        enderecos: [{}],
        vendedores: [{}],
        clientes: [{}],
        fornecedores: [{}],
        pessoas: [{}],
        marcas: [{}],
        produtos: [{}],
        tipo_produtos: [{}],
        tipo_movimentacaos: [{}],
        metodo_pagamentos: [{}],
        pedidoImpressao: [{}],

        meuProduto: [],
        meuCarrinho: [],

        mostrarSenha: "password",
        resposta: '',
        respostaData: '',
        variavelBusca: '',
        variavelOrdenacao: '',

        total_pedidos: '',
        total_produtos: '',
        total_valor: '',

        dash_rank:[{}],
        dash_contagem:[{}],

    },
    mounted: async function(){
        var url_rank = null;
        var url_contagem = null;

        if(this.tipoUsuario == 'AppModelsAdministrador'){
            url_rank =  '/api/analise_top_produtos/?id='+this.idUsuario;
            url_contagem =  '/api/analise_total_pedidos/?id='+this.idUsuario;
        }
        else if(this.tipoUsuario == 'AppModelsVendedor'){
            url_rank =  '/api/analise_vendedor_top_produtos/?id='+this.idUsuario;
            url_contagem =  '/api/analise_vendedor_total_pedidos/?id='+this.idUsuario;
        }
        else{
            url_rank =  '/api/analise_cliente_top_produtos/?id='+this.idUsuario;
            url_contagem =  '/api/analise_cliente_total_pedidos/?id='+this.idUsuario;
        }

        await axios
            .get(url_rank)
                .then(response => (
                    this.dash_rank = response.data
                ))
                .catch(error => (alert('Falha ao carregar itens: '+error)));

        await axios
            .get(url_contagem)
                .then(response => (
                    this.dash_contagem = response.data
                ))
                .catch(error => (alert('Falha ao carregar itens: '+error)));

        /* chamadas de graficos e top 10 do admin que foi substituido pelo dash bi
            <div class="row">
                                <div class="col">
                                    <graf_line_01 titulo="QTD Pedidos mensais (uni)"
                                        c1 = "numero_total_pedidos_periodico_coluna_mes"
                                        c2 = "numero_total_pedidos_periodico_coluna_total"
                                        urlg = "analise_total_pedidos"
                                        :usuario = "idUsuario"
                                        graficoid = "pedidomensal"
                                    ></graf_line_01>
                                </div>
                                <div class="col">
                                    <graf_line_01 titulo="QTD Produtos mensais (pacotes)"
                                        c1 = "numero_total_produtos_periodico_coluna_mes"
                                        c2 = "numero_total_produtos_periodico_coluna_total"
                                        urlg = "analise_total_pedidos"
                                        :usuario = "idUsuario"
                                        graficoid = "produtomensal"
                                    ></graf_line_01>
                                </div>
                                <div class="col">
                                    <graf_line_01 titulo="Valor gasto mensal (R$)"
                                        c1 = "valor_total_pedidos_periodico_coluna_mes"
                                        c2 = "valor_total_pedidos_periodico_coluna_total"
                                        urlg = "analise_total_pedidos"
                                        :usuario = "idUsuario"
                                        graficoid = "valormensal"
                                    ></graf_line_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Bairros"
                                        c1 = "top_bairros_nome_bairros"
                                        c2 = "top_bairros_valor_total_bairros"
                                        urlg = "analise_top_produtos"
                                        :usuario = "idUsuario"
                                        graficoid = "topbairros"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Cidades"
                                        c1 = "top_cidades_nome_cidades"
                                        c2 = "top_cidades_valor_total_cidades"
                                        urlg = "analise_top_produtos"
                                        :usuario = "idUsuario"
                                        graficoid = "topcidades"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Estados"
                                        c1 = "top_estados_nome_estados"
                                        c2 = "top_estados_valor_total_estados"
                                        urlg = "analise_top_produtos"
                                        :usuario = "idUsuario"
                                        graficoid = "topestados"
                                    ></graf_donut_01>
                                </div>
                                <div class="col">
                                    <graf_donut_01 titulo="Top Pais"
                                        c1 = "top_pais_nome_pais"
                                        c2 = "top_pais_valor_total_pais"
                                        urlg = "analise_top_produtos"
                                        :usuario = "idUsuario"
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
                                        urlg="analise_top_produtos"
                                        :usuario = "idUsuario"
                                        v1 = "top_produtos"
                                        titulo = "TOP Produtos"
                                        :valorjson = "[{}]"
                                        >
                                    </table_comum_top>
                                </div>
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd (pc)',conteudo: 'quantidade_total'}
                                        ]"
                                        urlg="analise_top_produtos"
                                        :usuario = "idUsuario"
                                        v1 = "top_marcas"
                                        titulo = "TOP Marcas"
                                        :valorjson = "[{}]"
                                        >
                                    </table_comum_top>
                                </div>
                                <div class="col">
                                    <table_comum_top
                                        :classe_atributos="[
                                            { titulo: 'Nome', conteudo: 'name'},
                                            { titulo: 'qtd', conteudo: 'quantidade_total'}
                                        ]"
                                        urlg="analise_top_produtos"
                                        :usuario = "idUsuario"
                                        v1 = "top_clientes"
                                        titulo = "TOP Clientes"
                                        :valorjson = "[{}]"
                                        >
                                    </table_comum_top>
                                </div>
                            </div>

        */


    },
    methods: {
        defineClasse: function(classe, titulo ){
            this.nomeObjeto = classe;
            this.titulo = titulo;
            if(classe != ''){
                this.carregarObjeto(classe);
            }
        },
        carregarObjeto: function(classe){
            this.objetos = null;
            this.carregandoGeral = true;
            var url;
            //const paginacao = 10;
            //url = '/api/'+classe+'?paginacao='+paginacao;
            url = '/api/'+classe;

            if(this.tipoUsuario == 'AppModelsVendedor'){
                //alert('opa, vendedor');
                if(classe == 'endereco' || classe == 'telefone' || classe == 'pedido'){
                    url = url + '?vendedor_id=' + this.idUsuario;
                }
            }

            if(this.tipoUsuario == 'AppModelsCliente'){
                //alert('opa, vendedor');
                if(classe == 'endereco' || classe == 'telefone' || classe == 'pedido'){
                    url = url + '?cliente_id=' + this.idUsuario;
                }
            }

            /*fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);
            */

           var header = {
                Authorization: "Bearer "+this.tokenUsuario
           }

            axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.objetos = response.data, this.resposta = response))
                .catch(error => (this.error = error));

            this.variavelBusca = '';
            this.variavelOrdenacao = '';
            this.modelObjetos[0]['buscarObjeto'] = '';
            this.modelObjetos[0]['ordenacaoBusca'] = '';
        },
        carregarApi: async function(){

        },
        carregaMeusTelefones: function(classe, titulo, tipo){
            this.nomeObjeto = classe;
            this.titulo = titulo;

            this.objetos = null;
            this.carregandoGeral = true;
            var url;



            url = '/api/'+tipo+'/'+this.idUsuario;

            /*fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);
            */

            axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.objetos = response.data, this.resposta = response))
                .catch(error => (this.error = error));

            this.variavelBusca = '';
            this.variavelOrdenacao = '';
            this.modelObjetos[0]['buscarObjeto'] = '';
            this.modelObjetos[0]['ordenacaoBusca'] = '';
        },
        escolheAcaoObjeto: function(acao, classe){
            if(this.verificaDados(classe) == true){
                alert("preencha os campos obrigatorios corretamente.");
            }
            else{
                if(acao == "Criar"){
                    this.addObjeto(classe);
                }
                else if(acao == "Alterar"){
                    this.updateObjeto(classe);
                }
                else{
                    alert("Erro | ação desconhecida");
                }
            }
        },
        addObjeto: async function(classe){
            this.carregando = true;
            var url;
            var dados;
            if(classe == "administrador"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    password: this.modelObjetos[0]['senha']
                }
            }
            else if(classe == "vendedor"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    password: this.modelObjetos[0]['senha']
                }
            }
            else if(classe == "cliente"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    company_name: this.modelObjetos[0]['company_name'],
                    cnpj: this.modelObjetos[0]['cnpj'],
                    vendedor_id: this.modelObjetos[0]['vendedor_id'],
                    password: this.modelObjetos[0]['senha']
                }
            }
            else if(classe == "fornecedor"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    company_name: this.modelObjetos[0]['company_name'],
                    cnpj: this.modelObjetos[0]['cnpj']
                }
            }
            else if(classe == "marca"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    fornecedor_id: this.modelObjetos[0]['fornecedor_id'],
                }
            }
            else if(classe == "produto"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    tipo_produto_id: this.modelObjetos[0]['tipo_produto_id'],
                    quantity: this.modelObjetos[0]['quantity'],
                    weight: this.modelObjetos[0]['weight'],
                    cost_price: this.modelObjetos[0]['cost_price'],
                    sale_price: this.modelObjetos[0]['sale_price'],
                    marca_id: this.modelObjetos[0]['marca_id'],
                    fornecedor_id: this.modelObjetos[0]['fornecedor_id']
                }
            }
            else if(classe == "tipo_produto" || classe == "tipo_movimentacao" || classe == "metodo_pagamento"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name']
                }
            }
            else if(classe == "pedido"){
                url = '/api/'+classe;
                dados = {
                    vendedor_id: this.modelObjetos[0]['vendedor_id'],
                    cliente_id: this.modelObjetos[0]['cliente_id'],
                    endereco_id: this.modelObjetos[0]['endereco_id'],
                    observation: this.modelObjetos[0]['observation'],
                    metodo_pagamento_id: this.modelObjetos[0]['metodo_pagamento_id'],
                    total_price: this.modelObjetos[0]['total_price'],
                    total_discount: this.modelObjetos[0]['total_discount'],
                    produtos: this.meuCarrinho
                }
            }
            else if(classe == "pais"){
                url = '/api/'+classe;
                dados = {
                    name_country: this.modelObjetos[0]['name_country']
                }
            }
            else if(classe == "estado"){
                url = '/api/'+classe;
                dados = {
                    name_state: this.modelObjetos[0]['name_state'],
                    pais_id: this.modelObjetos[0]['pais_id'],
                }
            }
            else if(classe == "cidade"){
                url = '/api/'+classe;
                dados = {
                    name_city: this.modelObjetos[0]['name_city'],
                    estado_id: this.modelObjetos[0]['estado_id'],
                }
            }
            else if(classe == "bairro"){
                url = '/api/'+classe;
                dados = {
                    name_neighborhood: this.modelObjetos[0]['name_neighborhood'],
                    cidade_id: this.modelObjetos[0]['cidade_id'],
                }
            }
            else if(classe == "endereco"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    name_neighborhood: this.modelObjetos[0]['name_neighborhood'],
                    street_name: this.modelObjetos[0]['street_name'],
                    house_number: this.modelObjetos[0]['house_number'],
                    cep: this.modelObjetos[0]['cep'],
                    complement: this.modelObjetos[0]['complement'],
                    tipoUsuario: this.modelObjetos[0]['tipoPessoa'],
                    enderecoable_id: this.modelObjetos[0]['enderecoable_id'],
                    cidade_id: this.modelObjetos[0]['cidade_id'],
                }
            }
            else if(classe == "telefone"){
                url = '/api/'+classe;
                dados = {
                    number_phone: this.modelObjetos[0]['number_phone'],
                    tipoUsuario: this.modelObjetos[0]['tipoPessoa'],
                    telefoneable_id: this.modelObjetos[0]['telefoneable_id']
                }
            }
            else if(classe == "estoque"){
                url = '/api/'+classe;
                dados = {
                    qty_item: this.modelObjetos[0]['qty_item'],
                    observation: this.modelObjetos[0]['observation'],
                    tipo_movimentacao_id: this.modelObjetos[0]['tipo_movimentacao_id'],
                    produto_id: this.modelObjetos[0]['produto_id'],
                    requisitante: this.tipoUsuario,
                    estoqueable_id: this.idUsuario
                }
            }
            else{
                alert("Erro, Classe inexistente!");
            }

            //fetch(url, { method: 'POST'} ).catch((e) => this.error = e);

            await axios
                .post(url, dados, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.respostaData = response.data, this.resposta = response))
                .catch(error => (this.error = error));

            //alert(url);

            if(this.error == null){
                this.limparModal();
                this.carregando = false;
                this.modalSucesso = true;
            }
            else{
                this.carregando = false;
                this.modalErro = true;
                alert("Um erro foi encontrado:"+this.error);
            }
            this.carregarObjeto(classe);
        },
        carregaCamposEditarObjeto: function(classe, index){
            this.index = index;
            //this.modelObjetos = this.objetos;

            if(this.index == 'meusDados'){
                this.modelObjetos[0]['id'] = this.objetos['data']['id'];
            }
            else{
            this.modelObjetos[0]['id'] = this.objetos['data'][index]['id'];
            }


            //alert("01 - "+index);
            if(this.nomeObjeto == "cliente"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['cnpj'] = this.objetos['data'][index]['cnpj'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
                this.modelObjetos[0]['company_name'] = this.objetos['data'][index]['company_name'];
                this.modelObjetos[0]['vendedor_id'] = this.objetos['data'][index]['vendedor_id'];
            }
            else if(this.nomeObjeto == "fornecedor"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['cnpj'] = this.objetos['data'][index]['cnpj'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['email'];
                this.modelObjetos[0]['company_name'] = this.objetos['data'][index]['company_name'];
            }
            else if(this.nomeObjeto == "marca"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['fornecedor_id'] = this.objetos['data'][index]['fornecedor_id'];
            }
            else if(this.nomeObjeto == "produto"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['tipo_produto_id'] = this.objetos['data'][index]['tipo_produto_id'];
                this.modelObjetos[0]['quantity'] = this.objetos['data'][index]['quantity'];
                this.modelObjetos[0]['weight'] = this.objetos['data'][index]['weight'];
                this.modelObjetos[0]['cost_price'] = this.objetos['data'][index]['cost_price'];
                this.modelObjetos[0]['sale_price'] = this.objetos['data'][index]['sale_price'];
                this.modelObjetos[0]['marca_id'] = this.objetos['data'][index]['marca_id'];
                this.modelObjetos[0]['fornecedor_id'] = this.objetos['data'][index]['marca']['fornecedor_id'];
            }
            else if(this.nomeObjeto == "pedido"){
                this.modelObjetos[0]['cliente_id'] = this.objetos['data'][index]['cliente_id'];
                this.buscaEnderecos();
                this.modelObjetos[0]['endereco_id'] = this.objetos['data'][index]['endereco_id'];
                this.modelObjetos[0]['observation'] = this.objetos['data'][index]['observation'];
                this.modelObjetos[0]['vendedor_id'] = this.objetos['data'][index]['vendedor_id'];
                this.modelObjetos[0]['metodo_pagamento_id'] = this.objetos['data'][index]['metodo_pagamento_id'];
                this.modelObjetos[0]['total_discount'] = this.objetos['data'][index]['total_discount'];
                this.modelObjetos[0]['total_price'] = this.objetos['data'][index]['total_price'];
            }
            else if(this.nomeObjeto == "administrador" || this.nomeObjeto == "vendedor"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
            }
            else if(this.nomeObjeto == "administrador/"+this.idUsuario || this.nomeObjeto == "vendedor/"+this.idUsuario){
                this.modelObjetos[0]['name'] = this.objetos['data']['name'];
                this.modelObjetos[0]['email'] = this.objetos['data']['user']['email'];
            }
            else if(this.nomeObjeto == "cliente/"+this.idUsuario ){
                this.modelObjetos[0]['name'] = this.objetos['data']['name'];
                this.modelObjetos[0]['cnpj'] = this.objetos['data']['cnpj'];
                this.modelObjetos[0]['email'] = this.objetos['data']['user']['email'];
                this.modelObjetos[0]['company_name'] = this.objetos['data']['company_name'];
                this.modelObjetos[0]['vendedor_id'] = this.objetos['data']['vendedor_id'];
            }
            else if(this.nomeObjeto == "tipo_produto" || this.nomeObjeto == "tipo_movimentacao" || this.nomeObjeto == "metodo_pagamento"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
            }
            else if(this.nomeObjeto == "pais"){
                this.modelObjetos[0]['name_country'] = this.objetos['data'][index]['name_country'];
            }
            else if(this.nomeObjeto == "estado"){
                this.modelObjetos[0]['name_state'] = this.objetos['data'][index]['name_state'];
                this.modelObjetos[0]['pais_id'] = this.objetos['data'][index]['pais_id'];
            }
            else if(this.nomeObjeto == "cidade"){
                this.modelObjetos[0]['name_city'] = this.objetos['data'][index]['name_city'];
                this.modelObjetos[0]['estado_id'] = this.objetos['data'][index]['estado_id'];
            }
            else if(this.nomeObjeto == "bairro"){
                this.modelObjetos[0]['name_neighborhood'] = this.objetos['data'][index]['name_neighborhood'];
                this.modelObjetos[0]['cidade_id'] = this.objetos['data'][index]['cidade_id'];
            }
            else if(this.nomeObjeto == "endereco"){
                this.buscaPaises();
                this.modelObjetos[0]['pais_id'] = this.objetos['data'][index]['bairro']['cidade']['estado']['pais_id'];
                this.buscaEstados();
                this.modelObjetos[0]['estado_id'] = this.objetos['data'][index]['bairro']['cidade']['estado_id'];
                this.buscaCidades();
                this.modelObjetos[0]['cidade_id'] = this.objetos['data'][index]['bairro']['cidade_id'];
                this.buscaBairros();
                this.modelObjetos[0]['name_neighborhood'] = this.objetos['data'][index]['bairro']['name_neighborhood'];
                //alert(this.objetos['data'][index]['enderecoable_type']);
                if(this.objetos['data'][index]['enderecoable_type'] == "App\\Models\\Fornecedor"){
                    this.modelObjetos[0]['tipoPessoa'] = 'fornecedor';
                }
                else if(this.objetos['data'][index]['enderecoable_type'] == 'App\\Models\\Vendedor'){
                    this.modelObjetos[0]['tipoPessoa'] = 'vendedor';
                }
                else if(this.objetos['data'][index]['enderecoable_type'] == 'App\\Models\\Cliente'){
                    this.modelObjetos[0]['tipoPessoa'] = 'cliente';
                }
                else{
                    alert('Erro CCE - Endereco | Pessoa não identificada');
                }
                this.modelObjetos[0]['enderecoable_type'] = this.objetos['data'][index]['enderecoable_type'];
                this.modelObjetos[0]['enderecoable_id'] = this.objetos['data'][index]['enderecoable_id'];
                this.buscaPessoa();
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['street_name'] = this.objetos['data'][index]['street_name'];
                this.modelObjetos[0]['house_number'] = this.objetos['data'][index]['house_number'];
                this.modelObjetos[0]['cep'] = this.objetos['data'][index]['cep'];
                this.modelObjetos[0]['complement'] = this.objetos['data'][index]['complement'];
            }
            else if(this.nomeObjeto == "telefone"){
                if(this.objetos['data'][index]['telefoneable_type'] == "App\\Models\\Fornecedor"){
                    this.modelObjetos[0]['tipoPessoa'] = 'fornecedor';
                }
                else if(this.objetos['data'][index]['telefoneable_type'] == 'App\\Models\\Vendedor'){
                    this.modelObjetos[0]['tipoPessoa'] = 'vendedor';
                }
                else if(this.objetos['data'][index]['telefoneable_type'] == 'App\\Models\\Cliente'){
                    this.modelObjetos[0]['tipoPessoa'] = 'cliente';
                }
                else{
                    alert('Erro CCE - Telefone | Pessoa não identificada');
                }
                this.buscaPessoa();
                this.modelObjetos[0]['telefoneable_type'] = this.objetos['data'][index]['telefoneable_type'];
                this.modelObjetos[0]['telefoneable_id'] = this.objetos['data'][index]['telefoneable_id'];
                this.modelObjetos[0]['number_phone'] = this.objetos['data'][index]['number_phone'];
            }
            else if(this.nomeObjeto == "estoque"){
                this.buscaFornecedores();
                this.modelObjetos[0]['fornecedor_id'] = this.objetos['data'][index]['produto']['marca']['fornecedor_id'];
                this.buscaMarcas();
                this.modelObjetos[0]['marca_id'] = this.objetos['data'][index]['produto']['marca_id'];
                this.buscaProdutos();
                this.modelObjetos[0]['produto_id'] = this.objetos['data'][index]['produto_id'];
                this.modelObjetos[0]['qty_item'] = this.objetos['data'][index]['qty_item'];
                this.modelObjetos[0]['observation'] = this.objetos['data'][index]['observation'];
                this.modelObjetos[0]['tipo_movimentacao_id'] = this.objetos['data'][index]['tipo_movimentacao_id'];
            }
            else{
                alert("Erro! CarregarCamposEditarObjeto | Classe não encontrada");
            }

            this.error = null;
            if(this.nomeObjeto == 'estado') {this.buscaPaises();}
            if(this.nomeObjeto == 'cidade'){this.buscaEstados();}
            if(this.nomeObjeto == 'bairro'){this.buscaCidades();}
            if(this.nomeObjeto == 'cliente') { this.buscaVendedores();}
            if(this.nomeObjeto == 'marca'){this.buscaFornecedores();}
            if(this.nomeObjeto == 'produto'){this.buscaFornecedores();}
            if(this.nomeObjeto == 'produto'){this.buscaTipo_produtos();}
            if(this.nomeObjeto == 'estoque'){this.buscaTipo_movimentacaos();}
            if(this.nomeObjeto == 'pedido'){this.buscaMetodo_pagamentos();}
            if(this.nomeObjeto == 'pedido'){this.buscaVendedores();}
            if(this.nomeObjeto == 'pedido'){this.buscaClientes();}
            if(this.nomeObjeto == 'pedido'){this.carregaMeuCarrinho(index);}
            if(this.tipoUsuario == 'AppModelsVendedor'){
                if(this.nomeObjeto == 'endereco' || this.nomeObjeto == 'telefone'){
                    this.buscaClientes();
                }
            }

        },
        updateObjeto: async function(classe){
            this.carregando = true;
            var url;
            var dados;
            if(classe == "administrador"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email']
                }
            }
            else if(classe == "administrador/"+this.idUsuario){
                url = '/api/'+classe;
                if(this.modelObjetos[0]['senha'] !== null && this.modelObjetos[0]['senha'] !== '' ){
                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        password: this.modelObjetos[0]['senha']
                    }
                }
                else{
                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        password: this.modelObjetos[0]['senha']
                    }
                }
            }
            else if(classe == "vendedor"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email']
                }
            }
            else if(classe == "vendedor/"+this.idUsuario){
                url = '/api/'+classe;
                if(this.modelObjetos[0]['senha'] !== null && this.modelObjetos[0]['senha'] !== '' ){

                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        password: this.modelObjetos[0]['senha']
                    }
                }else{
                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        password: this.modelObjetos[0]['senha']
                    }
                }
            }
            else if(classe == "cliente"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    company_name: this.modelObjetos[0]['company_name'],
                    cnpj: this.modelObjetos[0]['cnpj'],
                    vendedor_id: this.modelObjetos[0]['vendedor_id']
                }
            }
            else if(classe == "cliente/"+this.idUsuario){
                url = '/api/'+classe;
                if(this.modelObjetos[0]['senha'] !== null && this.modelObjetos[0]['senha'] !== '' ){
                    //alert('aki ' +this.modelObjetos[0]['senha']);

                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        company_name: this.modelObjetos[0]['company_name'],
                        cnpj: this.modelObjetos[0]['cnpj'],
                        vendedor_id: this.modelObjetos[0]['vendedor_id'],
                        password: this.modelObjetos[0]['senha']
                    }
                }
                else{
                    dados = {
                        name: this.modelObjetos[0]['name'],
                        email: this.modelObjetos[0]['email'],
                        company_name: this.modelObjetos[0]['company_name'],
                        cnpj: this.modelObjetos[0]['cnpj'],
                        vendedor_id: this.modelObjetos[0]['vendedor_id']
                    }
                }
            }
            else if(classe == "fornecedor"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    company_name: this.modelObjetos[0]['company_name'],
                    cnpj: this.modelObjetos[0]['cnpj']
                }
            }
            else if(classe == "marca"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name: this.modelObjetos[0]['name'],
                    fornecedor_id: this.modelObjetos[0]['fornecedor_id']
                }
            }
            else if(classe == "produto"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name: this.modelObjetos[0]['name'],
                    tipo_produto_id: this.modelObjetos[0]['tipo_produto_id'],
                    quantity: this.modelObjetos[0]['quantity'],
                    weight: this.modelObjetos[0]['weight'],
                    cost_price: this.modelObjetos[0]['cost_price'],
                    sale_price: this.modelObjetos[0]['sale_price'],
                    marca_id: this.modelObjetos[0]['marca_id']
                }
            }
            else if(classe == "pedido"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    vendedor_id: this.modelObjetos[0]['vendedor_id'],
                    endereco_id: this.modelObjetos[0]['endereco_id'],
                    cliente_id: this.modelObjetos[0]['cliente_id'],
                    observation: this.modelObjetos[0]['observation'],
                    metodo_pagamento_id: this.modelObjetos[0]['metodo_pagamento_id'],
                    total_price: this.modelObjetos[0]['total_price'],
                    total_discount: this.modelObjetos[0]['total_discount'],
                    produtos: this.meuCarrinho
                }
            }
            else if(classe == "tipo_produto" || classe == "tipo_movimentacao" || classe == "metodo_pagamento"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name: this.modelObjetos[0]['name']
                }
            }
            else if(classe == "pais"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name_country: this.modelObjetos[0]['name_country']
                }
            }
            else if(classe == "estado"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name_state: this.modelObjetos[0]['name_state'],
                    pais_id: this.modelObjetos[0]['pais_id']
                }
            }
            else if(classe == "cidade"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name_city: this.modelObjetos[0]['name_city'],
                    estado_id: this.modelObjetos[0]['estado_id'],
                }
            }
            else if(classe == "bairro"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    name_neighborhood: this.modelObjetos[0]['name_neighborhood'],
                    cidade_id: this.modelObjetos[0]['cidade_id'],
                }
            }
            else if(classe == "endereco"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);

                if(this.modelObjetos[0]['tipoPessoa'] == 'fornecedor'){
                    this.modelObjetos[0]['enderecoable_type'] = "App\\Models\\Fornecedor";
                }
                else if(this.modelObjetos[0]['tipoPessoa'] == 'vendedor'){
                    this.modelObjetos[0]['enderecoable_type'] = "App\\Models\\Vendedor";
                }
                else if(this.modelObjetos[0]['tipoPessoa'] == 'cliente'){
                    this.modelObjetos[0]['enderecoable_type'] = "App\\Models\\Cliente";
                }

                dados = {
                    name: this.modelObjetos[0]['name'],
                    name_neighborhood: this.modelObjetos[0]['name_neighborhood'],
                    street_name: this.modelObjetos[0]['street_name'],
                    house_number: this.modelObjetos[0]['house_number'],
                    cep: this.modelObjetos[0]['cep'],
                    complement: this.modelObjetos[0]['complement'],
                    tipoUsuario: this.modelObjetos[0]['tipoPessoa'],
                    enderecoable_id: this.modelObjetos[0]['enderecoable_id'],
                    cidade_id: this.modelObjetos[0]['cidade_id'],
                    enderecoable_type: this.modelObjetos[0]['enderecoable_type']
                }
            }
            else if(classe == "telefone"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);

                if(this.modelObjetos[0]['tipoPessoa'] == 'fornecedor'){
                    this.modelObjetos[0]['telefoneable_type'] = "App\\Models\\Fornecedor";
                }
                else if(this.modelObjetos[0]['tipoPessoa'] == 'vendedor'){
                    this.modelObjetos[0]['telefoneable_type'] = "App\\Models\\Vendedor";
                }
                else if(this.modelObjetos[0]['tipoPessoa'] == 'cliente'){
                    this.modelObjetos[0]['telefoneable_type'] = "App\\Models\\Cliente";
                }

                dados = {
                    number_phone: this.modelObjetos[0]['number_phone'],
                    tipoUsuario: this.modelObjetos[0]['tipoPessoa'],
                    telefoneable_id: this.modelObjetos[0]['telefoneable_id'],
                    telefoneable_type: this.modelObjetos[0]['telefoneable_type']
                }
            }
            else if(classe == "estoque"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                //alert(url);
                dados = {
                    qty_item: this.modelObjetos[0]['qty_item'],
                    observation: this.modelObjetos[0]['observation'],
                    tipo_movimentacao_id: this.modelObjetos[0]['tipo_movimentacao_id'],
                    produto_id: this.modelObjetos[0]['produto_id'],
                    //requisitante: this.tipoUsuario,
                    //estoqueable_id: this.idUsuario
                }
            }
            else{
                alert("Erro, Update |  Classe inexistente!");
            }

            //alert(url);

            /*fetch(url, { method: 'PUT', headers: {"Content-type": "application/json"}} ).then((res) => res.json())
            .then((data) => this.resposta = data)
            .then(json => console.log(json))
            .catch((e) => this.error = e);*/

            await axios
                .put(url, dados, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.respostaData = response.data, this.resposta = response))
                .catch(error => (this.error = error));


            if(this.error == null){
                this.limparModal();
                this.modalSucesso = true;
            }
            else{
                this.modalErro = true;
                alert("Um erro foi encontrado:"+this.error);
            }
            this.carregarObjeto(classe);
            this.carregando = false;
        },
        desativarObjeto: async function(classe, id){
            this.error = null;
            if( confirm("Tem certeza que deseja deletar? "+id) == true){
                    var url = '/api/'+classe+'/'+id;
                    //fetch(url, { method: 'DELETE'} ).catch((e) => this.error = e);
                    await axios
                        .delete(url, {
                            headers: {
                              Authorization: 'Bearer '+this.tokenUsuario
                            }
                          })
                        .then(response => (this.respostaData = response.data, this.resposta = response))
                        .catch(error => (this.error = error));
                    if(this.error == null){
                        alert("Excluido com sucesso");
                    }
                    else{
                        alert("Um erro foi encontrado:"+this.error);
                    }
                    this.carregarObjeto(classe);
            }
            else{
                alert("Cancelado");
            }
        },
        limparModal: function(){
            this.limparErroValidacao();

            this.temPaginacao = false;
            this.alterarSenha = false;

            this.modelObjetos[0]['buscarObjetoProduto'] = "",

            this.modelObjetos[0]['tipoPessoa'] = "";

            this.modelObjetos[0]['name'] = "";
            this.modelObjetos[0]['company_name'] = "";
            this.modelObjetos[0]['email'] = "";
            this.modelObjetos[0]['cnpj'] = "";
            this.modelObjetos[0]['vendedor_id'] = "";

            this.modelObjetos[0]['senha'] = "";
            this.modelObjetos[0]['confirmaSenha'] = "";

            //pais
            this.modelObjetos[0]['name_country'] = "";

            //estado
            this.modelObjetos[0]['name_state'] = "";
            this.modelObjetos[0]['pais_id'] = "";

            //cidade
            this.modelObjetos[0]['name_city'] = "";
            this.modelObjetos[0]['estado_id'] = "";

            //bairro
            this.modelObjetos[0]['name_neighborhood'] = "";
            this.modelObjetos[0]['cidade_id'] = "";

            //endereco
            this.modelObjetos[0]['street_name'] = "";
            this.modelObjetos[0]['house_number'] = "";
            this.modelObjetos[0]['cep'] = "";
            this.modelObjetos[0]['complement'] = "";
            this.modelObjetos[0]['tipoPessoa'] = "";
            this.modelObjetos[0]['enderecoable_id'] = "";

            //telefone
            this.modelObjetos[0]['number_phone'] = "";
            this.modelObjetos[0]['telefoneable_id'] = "";
            this.modelObjetos[0]['telefoneable_type'] = "";

            //marca
            this.modelObjetos[0]['fornecedor_id'] = "";

            //produto
            this.modelObjetos[0]['name'] = "";
            this.modelObjetos[0]['tipo_produto_id'] = "";
            this.modelObjetos[0]['quantity'] = "";
            this.modelObjetos[0]['weight'] = "";
            this.modelObjetos[0]['cost_price'] = "";
            this.modelObjetos[0]['sale_price'] = "";
            this.modelObjetos[0]['marca_id'] = "";

            //estoque
            this.modelObjetos[0]['tipo_movimentacao_id'] = "";
            this.modelObjetos[0]['produto_id'] = "";
            this.modelObjetos[0]['qty_item'] = "";
            this.modelObjetos[0]['observation'] = "";

            //pedido
            this.modelObjetos[0]['metodo_pagamento_id'] = "";
            this.modelObjetos[0]['endereco_id'] = "";
            this.modelObjetos[0]['cliente_id'] = "";
            this.modelObjetos[0]['payday'] = "";
            this.modelObjetos[0]['delivery_date'] = "";
            this.modelObjetos[0]['approval_date'] = "";
            this.modelObjetos[0]['total_price'] = 0;
            this.modelObjetos[0]['total_discount'] = 0;



            this.paises = [{}];
            this.estados =  [{}];
            this.cidades = [{}];
            this.bairros = [{}];
            this.vendedores = [{}];
            this.clientes = [{}];
            this.fornecedores = [{}];
            this.pessoas = [{}];
            this.marcas = [{}];
            this.produtos = [{}];
            this.tipo_produtos = [{}];
            this.tipo_movimentacaos = [{}];
            this.metodo_pagamentos = [{}];

            this.meuProduto = [];
            this.meuCarrinho = [];

            this.error = null;
            this.index = null;
            if(this.nomeObjeto == 'estado' || this.nomeObjeto == 'endereco') {this.buscaPaises();}
            if(this.nomeObjeto == 'cidade'){this.buscaEstados();}
            if(this.nomeObjeto == 'bairro'){this.buscaCidades();}
            if(this.nomeObjeto == 'cliente') { this.buscaVendedores();}
            if(this.nomeObjeto == 'marca' || this.nomeObjeto == 'estoque'){this.buscaFornecedores();}
            if(this.nomeObjeto == 'produto'){this.buscaFornecedores();}
            if(this.nomeObjeto == 'produto'){this.buscaTipo_produtos();}
            if(this.nomeObjeto == 'estoque'){this.buscaTipo_movimentacaos();}
            if(this.nomeObjeto == 'pedido'){this.buscaMetodo_pagamentos();}
            if(this.nomeObjeto == 'pedido'){this.buscaVendedores();}
            if(this.nomeObjeto == 'pedido'){this.buscaClientes();}
            if(this.tipoUsuario == 'AppModelsVendedor'){
                if(this.nomeObjeto == 'endereco' || this.nomeObjeto == 'telefone'){
                    this.buscaClientes();
                }
            }
            if(this.tipoUsuario == 'AppModelsCliente'){
                if(this.nomeObjeto == 'pedido'){
                    this.modelObjetos[0]['cliente_id'] = this.idUsuario;
                    this.buscaEnderecos();
                }
            }
            //if(this.nomeObjeto == 'estoque'){this.buscaProdutos();}
        },
        limparErroValidacao: function(){
            this.alertaCampo[0]['tipoPessoa'] = "";

            this.alertaCampo[0]['name'] = "";
            this.alertaCampo[0]['company_name'] = "";
            this.alertaCampo[0]['email'] = "";
            this.alertaCampo[0]['cnpj'] = "";
            this.alertaCampo[0]['vendedor_id'] = "";

            this.alertaCampo[0]['senha'] = "";
            this.alertaCampo[0]['confirmaSenha'] = "";

            //pais
            this.alertaCampo[0]['name_country'] = "";

            //estado
            this.alertaCampo[0]['name_state'] = "";
            this.alertaCampo[0]['pais_id'] = "";

            //cidade
            this.alertaCampo[0]['name_city'] = "";
            this.alertaCampo[0]['estado_id'] = "";

            //bairro
            this.alertaCampo[0]['name_neighborhood'] = "";
            this.alertaCampo[0]['cidade_id'] = "";

            //endereco
            this.alertaCampo[0]['street_name'] = "";
            this.alertaCampo[0]['house_number'] = "";
            this.alertaCampo[0]['cep'] = "";
            this.alertaCampo[0]['complement'] = "";
            this.alertaCampo[0]['tipoPessoa'] = "";
            this.alertaCampo[0]['enderecoable_id'] = "";

            //telefone
            this.alertaCampo[0]['number_phone'] = "";
            this.alertaCampo[0]['telefoneable_id'] = "";
            this.alertaCampo[0]['telefoneable_type'] = "";

            //marca
            this.alertaCampo[0]['fornecedor_id'] = "";

            //produto
            this.alertaCampo[0]['name'] = "";
            this.alertaCampo[0]['tipo_produto_id'] = "";
            this.alertaCampo[0]['quantity'] = "";
            this.alertaCampo[0]['weight'] = "";
            this.alertaCampo[0]['cost_price'] = "";
            this.alertaCampo[0]['sale_price'] = "";
            this.alertaCampo[0]['marca_id'] = "";

            //estoque
            this.alertaCampo[0]['tipo_movimentacao_id'] = "";
            this.alertaCampo[0]['produto_id'] = "";
            this.alertaCampo[0]['qty_item'] = "";
            this.alertaCampo[0]['observation'] = "";

            //pedido
            this.alertaCampo[0]['metodo_pagamento_id'] = "";
            this.alertaCampo[0]['endereco_id'] = "";
            this.alertaCampo[0]['cliente_id'] = "";
            this.alertaCampo[0]['payday'] = "";
            this.alertaCampo[0]['delivery_date'] = "";
            this.alertaCampo[0]['approval_date'] = "";
            this.alertaCampo[0]['total_price'] = 0;
            this.alertaCampo[0]['total_discount'] = "";
        },
        limparGeral: function(){
            this.objetos = null;
            this.titulo = "";
            this.nomeObjeto = "";
            this.acaoObjeto = "";
        },
        verificaDados: function(classe){
            this.limparErroValidacao();
            if(classe == 'cliente'){
                var error = false;
                if(
                    this.modelObjetos[0]['name'] == ""
                ){
                    this.alertaCampo[0]['name'] = "Nome do Cliente é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "Maximo de 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['email'] == "") {
                    this.alertaCampo[0]['email'] = "Email do Cliente é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['email'].length > 45) {
                    this.alertaCampo[0]['email'] = "Maximo de 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['cnpj'] == "") {
                    this.alertaCampo[0]['cnpj'] = "CPF ou CNPJ do Cliente é obrigatório";
                    error = true;
                }
                if(this.modelObjetos[0]['cnpj'].length < 11 || this.modelObjetos[0]['cnpj'].length > 14 ) {
                    this.alertaCampo[0]['cnpj'] = "O CPF ou CNPJ deve estar entre 11 e 14 dígitos";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'] == "") {
                    this.alertaCampo[0]['company_name'] = "O nome da companhia é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'].length > 45) {
                    this.alertaCampo[0]['company_name'] = "Maximo de 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['vendedor_id'] == "") {
                    this.alertaCampo[0]['vendedor_id'] = "O ID do vendedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['senha'] == "") {
                    this.alertaCampo[0]['senha'] = "A senha é obrigatória";
                    error = true
                }
                if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                    this.alertaCampo[0]['senha'] = "As senhas devem ser iguais";
                    error = true
                }
                if(this.modelObjetos[0]['confirmaSenha'] == "") {
                    this.alertaCampo[0]['confirmaSenha'] = "A confirmação da senha é obrigatória";
                    error = true
                }

                if(error == true) {
                    return true;
                }

                else{
                    return false;
                }
            }
            else if(classe == 'fornecedor'){
                var error = false;
                if(this.modelObjetos[0]['name'] == ""){
                    this.alertaCampo[0]['name'] = "O nome do fornecedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "O nome do fornecedor deve ter no máximo 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['email'] == "") {
                    this.alertaCampo[0]['email'] = "O e-mail do fornecedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['email'].length > 45) {
                    this.alertaCampo[0]['email'] = "O e-mail do fornecedor deve ter no máximo 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['cnpj'] == "") {
                    this.alertaCampo[0]['cnpj'] = "O CNPJ do fornecedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['cnpj'].length > 14) {
                    this.alertaCampo[0]['cnpj'] = "O CNPJ tem apenas caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'] == "") {
                    this.alertaCampo[0]['company_name'] = "A razão social é obrigatória";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'].length > 45) {
                    this.alertaCampo[0]['company_name'] = "A razão social deve ter no máximo 45 caracteres";
                    error = true
                }

                if(error == true) {
                    return true;
                }

                else{
                    return false;
                }
            }
            else if(classe == 'marca'){
                var error = false
                if(this.modelObjetos[0]['name'] == ""){
                    this.alertaCampo[0]['name'] = "O nome da marca é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "O nome da marca deve ter no máximo 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['fornecedor_id'] == ""){
                    this.alertaCampo[0]['fornecedor_id'] = "É obrigatório ter um fornecedor";
                    error = true
                }

                if (error == true) {
                    return true;
                }

                else{
                    return false;
                }
            }
            else if(classe == 'produto'){
                var error = false

                if(this.modelObjetos[0]['name'] == "" ){
                    this.alertaCampo[0]['name'] = "O nome do produto é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "O nome do produto deve ter no máximo 45 caracteres";
                    error = true
                }
                if (this.modelObjetos[0]['type'] == "") {
                    this.alertaCampo[0]['type'] = "O tipo do produto é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['quantity'] == "") {
                    this.alertaCampo[0]['quantity'] = "É obrigatório ter a quantidade";
                    error = true
                }
                if(this.modelObjetos[0]['weight'] == "") {
                    this.alertaCampo[0]['weight'] = "É obrigatório ter o peso";
                    error = true
                }
                if(this.modelObjetos[0]['cost_price'] == "") {
                    this.alertaCampo[0]['cost_price'] = "É obrigatório ter o preço de custo";
                    error = true
                }
                if (this.modelObjetos[0]['sale_price'] == "") {
                    this.alertaCampo[0]['sale_price'] = "É obrigatório ter o preço de venda";
                    error = true
                }
                if (this.modelObjetos[0]['marca_id'] == "") {
                    this.alertaCampo[0]['marca_id'] = "O obrigatório ter a marca";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'administrador' || classe == 'vendedor'){
                if(this.acaoObjeto == "Criar"){
                    var error = false
                    if(this.modelObjetos[0]['name'] == ""){
                        this.alertaCampo[0]['name'] = "O nome é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['name'].length > 45) {
                        this.alertaCampo[0]['name'] = "O nome deve ter no máximo 45 caracteres";
                        error = true
                    }
                    if (this.modelObjetos[0]['email'] == "") {
                        this.alertaCampo[0]['email'] = "O e-mail é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['email'].length > 45) {
                        this.alertaCampo[0]['email'] = "O e-mail deve ter no máximo 45 caracteres";
                        error = true
                    }
                    if (this.modelObjetos[0]['senha'] == "") {
                        this.alertaCampo[0]['senha'] = "A senha é obrigatória";
                        error = true
                    }
                    if (this.modelObjetos[0]['confirmaSenha'] == "") {
                        this.alertaCampo[0]['confirmaSenha'] = "É obrigatório confirmar a senha";
                        error = true
                    }

                    if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                        this.alertaCampo[0]['confirmaSenha'] = "As senhas devem ser iguais";
                        error = true
                    }

                    if (error == true) {
                        return true
                    }

                    else{
                        return false;
                    }
                }
                else if(this.acaoObjeto == "Alterar"){
                    var error = false
                    if(this.modelObjetos[0]['name'] == ""){
                        this.alertaCampo[0]['name'] = "O nome é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['name'].length > 45) {
                        this.alertaCampo[0]['name'] = "O nome deve ter no máximo 45 caracteres";
                        error = true
                    }
                    if(this.modelObjetos[0]['email'] == ""){
                        this.alertaCampo[0]['email'] = "O e-mail é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['email'].length > 45) {
                        this.alertaCampo[0]['email'] = "O e-mail deve ter no máximo 45 caracteres";
                        error = true
                    }

                    if(error == true) {
                        return true
                    }

                    else{
                        return false;
                    }
                }
                else{
                    alert("Erro na verificação");
                    return true;
                }

            }
            else if(classe == 'administrador/'+this.idUsuario || classe == 'vendedor/'+this.idUsuario ){
                var error = false
                    if(this.modelObjetos[0]['name'] == ""){
                        this.alertaCampo[0]['name'] = "O nome é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['name'].length > 45) {
                        this.alertaCampo[0]['name'] = "O nome deve ter no máximo 45 caracteres";
                        error = true
                    }
                    if (this.modelObjetos[0]['email'] == "") {
                        this.alertaCampo[0]['email'] = "O e-mail é obrigatório";
                        error = true
                    }
                    if (this.modelObjetos[0]['email'].length > 45) {
                        this.alertaCampo[0]['email'] = "O e-mail deve ter no máximo 45 caracteres";
                        error = true
                    }
                    if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                        this.alertaCampo[0]['confirmaSenha'] = "As senhas devem ser iguais";
                        error = true
                    }

                    if (error == true) {
                        return true
                    }

                    else{
                        return false;
                    }


            }
            else if(classe == 'cliente/'+this.idUsuario  ){
                var error = false
                if(this.modelObjetos[0]['name'] == ""){
                    this.alertaCampo[0]['name'] = "O nome é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "O nome deve ter no máximo 45 caracteres";
                    error = true
                }
                if (this.modelObjetos[0]['email'] == "") {
                    this.alertaCampo[0]['email'] = "O e-mail é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['email'].length > 45) {
                    this.alertaCampo[0]['email'] = "O e-mail deve ter no máximo 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['cnpj'] == "") {
                    this.alertaCampo[0]['cnpj'] = "O CNPJ do fornecedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['cnpj'].length > 14) {
                    this.alertaCampo[0]['cnpj'] = "O CNPJ tem apenas caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'] == "") {
                    this.alertaCampo[0]['company_name'] = "A razão social é obrigatória";
                    error = true
                }
                if(this.modelObjetos[0]['company_name'].length > 45) {
                    this.alertaCampo[0]['company_name'] = "A razão social deve ter no máximo 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['vendedor_id'] == "") {
                    this.alertaCampo[0]['vendedor_id'] = "O ID do vendedor é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                    this.alertaCampo[0]['confirmaSenha'] = "As senhas devem ser iguais";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }


            }
            else if(classe == 'telefone'){
                var error = false
                    if(this.tipoUsuario == 'AppModelsCliente'){
                        this.modelObjetos[0]['telefoneable_id'] = this.idUsuario;
                        this.modelObjetos[0]['tipoPessoa'] = 'cliente';
                    }
                    if(this.modelObjetos[0]['number_phone'] == ""){
                        this.alertaCampo[0]['number_phone'] = "O número de telefone é obrigatório";
                        error = true
                    }
                    if(this.modelObjetos[0]['number_phone'].length > 15) {
                        this.alertaCampo[0]['number_phone'] = "O número de dígitos não pode ser maior que 15 caracteres";
                        error = true
                    }
                    if(this.modelObjetos[0]['telefoneable_id'] == ""){
                        this.alertaCampo[0]['telefoneable_id'] = "É obrigatório informar o proprietário";
                        error = true
                    }

                    if (error == true) {
                        return true
                    }

                    else{
                        return false;
                    }
            }
            else if(classe == "tipo_produto" || classe == "tipo_movimentacao" || classe == "metodo_pagamento"){
                var error = false
                if(this.modelObjetos[0]['name'] == ""){
                    this.alertaCampo[0]['name'] = "O nome é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['name'].length > 45) {
                    this.alertaCampo[0]['name'] = "O nome deve ter no máximo 45 caracteres";
                    error = true
                }

                if(error == true){
                    return true;
                }

                else{
                    return false;
                }
            }
            else if(classe == 'pais'){
                var error = false
                if(
                    this.modelObjetos[0]['name_country'] == ""
                ){
                    this.alertaCampo[0]['name_country'] = "O nome do país é obrigatório";
                    error = true
                }
                else if(this.modelObjetos[0]['name_country'].length > 45){
                    this.alertaCampo[0]['name_country'] = "Maximo de 45 caracteres";
                    error = true
                }

                if (error == true) {
                    return true;
                }

                else{
                    return false;
                }
            }
            else if(classe == 'estado'){
                var error = false
                if(
                    this.modelObjetos[0]['name_state'] == ""
                ){
                    this.alertaCampo[0]['name_state'] = "O nome do estado é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['name_state'].length > 45) {
                    this.alertaCampo[0]['name_state'] = "Maximo de 45 caracteres";
                    error = true
                }
                if (this.modelObjetos[0]['pais_id'] == "") {
                    this.alertaCampo[0]['pais_id'] = "É obrigatório ter o país";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'cidade'){
                var error = false
                if(this.modelObjetos[0]['name_city'] == ""){
                    this.alertaCampo[0]['name_city'] = "O nome da cidade é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['name_city'].length > 45) {
                    this.alertaCampo[0]['name_city'] = "Maximo de 45 caracteres";
                    error = true
                }
                if (this.modelObjetos[0]['estado_id'] == "") {
                    this.alertaCampo[0]['estado_id'] = "É obrigatório ter o estado";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'bairro'){
                var error = false
                if(this.modelObjetos[0]['name_neighborhood'] == ""){
                    this.alertaCampo[0]['name_neighborhood'] = "O nome do bairro é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['name_neighborhood'].length > 45) {
                    this.alertaCampo[0]['name_neighborhood'] = "Maximo de 45 caracteres";
                    error = true
                }
                if (this.modelObjetos[0]['cidade_id'] == "") {
                    this.alertaCampo[0]['cidade_id'] = "É obrigatório ter a cidade";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'endereco'){
                var error = false
                if(this.tipoUsuario == 'AppModelsCliente'){
                    this.modelObjetos[0]['enderecoable_id'] = this.idUsuario;
                    this.modelObjetos[0]['tipoPessoa'] = 'cliente';
                }
                if(this.modelObjetos[0]['street_name'] == ""){
                    this.alertaCampo[0]['street_name'] = "O nome da rua é obrigatório";
                    error = true
                }
                if (this.modelObjetos[0]['street_name'].length > 45) {
                    this.alertaCampo[0]['street_name'] = "Maximo de 45 caracteres";
                    error = true
                }
                if(this.modelObjetos[0]['bairro_id'] == ""){
                    this.alertaCampo[0]['bairro_id'] = "O nome do bairro é obrigatório";
                    error = true
                }
                if(this.modelObjetos[0]['enderecoable_id'] == ""){
                    this.alertaCampo[0]['enderecoable_id'] = "É obrigatório ter p endereço";
                    error = true
                }
                if(this.modelObjetos[0]['enderecoable_id'] == ""){
                    this.alertaCampo[0]['enderecoable_id'] = "É obrigatório ter p endereço";
                    error = true
                }
                if(this.modelObjetos[0]['house_number'] == ""){
                    this.alertaCampo[0]['house_number'] = "É obrigatório ter o número";
                    error = true
                }
                if(this.modelObjetos[0]['cep'] == ""){
                    this.alertaCampo[0]['cep'] = "É obrigatório ter o CEP";
                    error = true
                }
                if (this.modelObjetos[0]['cep'].length > 10) {
                    this.alertaCampo[0]['cep'] = "Maximo de 10 caracteres";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'estoque'){
                var error = false
                if(this.modelObjetos[0]['qty_item'] == ""){
                    this.alertaCampo[0]['qty_item'] = "É obrigatório ter a quantidade";
                    error = true
                }
                if(this.modelObjetos[0]['tipo_movimentacao_id'] == ""){
                    this.alertaCampo[0]['tipo_movimentacao_id'] = "É obrigatório ter o tipo da movimentação";
                    error = true
                }
                if(this.modelObjetos[0]['produto_id'] == ""){
                    this.alertaCampo[0]['produto_id'] = "É obrigatório ter o produto";
                    error = true
                }
                if(this.modelObjetos[0]['produto_id'] == ""){
                    this.alertaCampo[0]['produto_id'] = "É obrigatório ter o produto";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else if(classe == 'pedido'){
                var error = false
                if(this.modelObjetos[0]['cliente_id'] == ""){
                    this.alertaCampo[0]['cliente_id'] = "É obrigatório ter o cliente";
                    error = true
                }
                if(this.modelObjetos[0]['endereco_id'] == ""){
                    this.alertaCampo[0]['endereco_id'] = "É obrigatório ter o endereço";
                    error = true
                }
                if(this.modelObjetos[0]['vendedor_id'] == ""){
                    this.alertaCampo[0]['vendedor_id'] = "É obrigatório ter o vendedor";
                    error = true
                }
                if(this.modelObjetos[0]['metodo_pagamento_id'] == ""){
                    this.alertaCampo[0]['metodo_pagamento_id'] = "É obrigatório ter o método de pagamento";
                    error = true
                }
                if(this.modelObjetos[0]['total_price'] <= 0){
                    this.alertaCampo[0]['total_price'] = "É obrigatório ter o preço total";
                    error = true
                }

                if (error == true) {
                    return true
                }

                else{
                    return false;
                }
            }
            else{
                alert("Erro: VerificaDados | Classe não encontrada.");
                return true;
            }
        },
        paginacao: function(url){
            this.objetos = null;

            if(this.variavelBusca !== ''){
                url = url + '&buscarObjeto=' + this.variavelBusca;
            }
            if(this.variavelOrdenacao !== ''){
                url = url + '&ordenacaoBusca=' + this.variavelOrdenacao;
            }
            axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.objetos = response.data, this.resposta = response))
                .catch(error => (this.error = error));
        },
        paginacao_produto: function(url){
            //this.objetos = null;
            //this.carregandoGeral = true;
            //var url;
            //url = '/api/'+classe;

            /*fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);
            */
            //alert(url);
            this.meuProduto = null;

            if(this.variavelBusca !== ''){
                url = url + '&buscarObjeto=' + this.variavelBusca;
            }
            if(this.variavelOrdenacao !== ''){
                url = url + '&ordenacaoBusca=' + this.variavelOrdenacao;
            }
            axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.meuProduto = response.data, this.resposta = response))
                .catch(error => (this.error = error));
        },
        buscarObjetos: function(){
            //alert('clicado');
            var classe = this.nomeObjeto;
            var url;
            var dados;
            if(this.modelObjetos[0]['buscarObjeto'] !== '' &&  this.modelObjetos[0]['ordenacaoBusca'] !== '' ){
                //alert('orde e busca');
                //this.objetos = null;
                //this.carregandoGeral = true;

                //url = '/api/'+classe+'/busca';
                url = '/api/'+classe+'?buscarObjeto='+this.modelObjetos[0]['buscarObjeto'];
                url = url + '&ordenacaoBusca=' + this.modelObjetos[0]['ordenacaoBusca'];
                /*dados = {
                    buscarObjeto: this.modelObjetos[0]['buscarObjeto']
                }*/
                //alert(dados.buscarObjeto);


            }
            else if(this.modelObjetos[0]['buscarObjeto'] !== '' &&  this.modelObjetos[0]['ordenacaoBusca'] == ''){
                //alert('busca');
                url = '/api/'+classe+'?buscarObjeto='+this.modelObjetos[0]['buscarObjeto'];
            }
            else if(this.modelObjetos[0]['buscarObjeto'] == '' &&  this.modelObjetos[0]['ordenacaoBusca'] !== ''){
                //alert('orde');
                url = '/api/' + classe + '?ordenacaoBusca=' + this.modelObjetos[0]['ordenacaoBusca'];
            }
            else{
                //alert("campos vazios, mas vc clicou em buscar mesmo assim, recarregando tudo.");
                this.variavelBusca = '';
                this.variavelOrdenacao = '';
                this.carregarObjeto(classe);
                return;
            }

            axios
            .get(url, {
                headers: {
                  Authorization: 'Bearer '+this.tokenUsuario
                }
              })
            .then(response => (this.objetos = response.data, this.resposta = response))
            .catch(error => (this.error = error));

            if(this.error == null){
                this.variavelBusca = this.modelObjetos[0]['buscarObjeto'];
                this.variavelOrdenacao = this.modelObjetos[0]['ordenacaoBusca'];
            }


        },
        ordenacao: function(coluna){
            //alert('clicado ordenacao');
            var classe = this.nomeObjeto;


                //this.objetos = null;
                //this.carregandoGeral = true;
                var url;

                url = '/api/'+classe+'?ordenacaoBusca='+coluna;

                axios
                    .get(url, {
                        headers: {
                          Authorization: 'Bearer '+this.tokenUsuario
                        }
                      })
                    .then(response => (this.objetos = response.data, this.resposta = response))
                    .catch(error => (this.error = error));

        },
        buscaPaises: async function() {
            this.paises = null;
            this.carregandoGeral = true;
            this.carregandoModal = true;
            var url;
            const paginacao = '?paginacao=false';
            //if() {var where = '&atributo='+atributo+'&valor='+valor;}
            url = '/api/pais'+paginacao;

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.paises = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaEstados: async function() {
            this.estados = null;
            this.carregandoGeral = true;
            this.carregandoModal = true;
            var url;
            if(this.nomeObjeto == 'endereco'){
                url = '/api/estado'+'?paginacao=false&pais_id='+this.modelObjetos[0]['pais_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/estado'+'?paginacao=false';
            }


            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.estados = response.data))
                .catch(error => (this.error = error));
            //alert('opa');
            this.carregandoModal = false;
        },
        buscaCidades: async function() {
            this.cidades = null;
            this.carregandoGeral = true;
            this.carregandoModal = true;
            var url;
            //url = '/api/cidade'+'?paginacao=false';

            if(this.nomeObjeto == 'endereco'){
                url = '/api/cidade'+'?paginacao=false&estado_id='+this.modelObjetos[0]['estado_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/cidade'+'?paginacao=false';
            }

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.cidades = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaBairros: async function() {

            this.bairros = null;
            this.carregandoGeral = true;
            this.carregandoModal = true;
            var url;
            //url = '/api/bairro'+'?paginacao=false';

            if(this.nomeObjeto == 'endereco'){
                url = '/api/bairro'+'?paginacao=false&cidade_id='+this.modelObjetos[0]['cidade_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/bairro'+'?paginacao=false';
            }

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.bairros = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaEnderecos: async function() {
            //alert('opa');
            this.carregandoModal = true;
            this.enderecos = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/endereco'+'?paginacao=false&cliente_id='+this.modelObjetos[0]['cliente_id']; //vc parou nessa linha
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.enderecos = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaPessoa: async function() {
            //alert('opa')
            this.pessoas = null;
            this.carregandoGeral = true;
            this.carregandoModal = true;
            var url;
            //alert(this.modelObjetos[0]['tipoPessoa']);
            url = '/api/'+this.modelObjetos[0]['tipoPessoa']+'?paginacao=false';
            //alert(url);

            if(this.tipoUsuario == 'AppModelsVendedor'){
                //alert('opa, vendedor de novo');
                if(this.nomeObjeto == 'endereco' || this.nomeObjeto == 'telefone'){
                    url = url + '&vendedor_id=' + this.idUsuario;
                }
            }

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.pessoas = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaClientes: async function() {
            this.carregandoModal = true;
            this.clientes = null;
            this.carregandoGeral = true;
            var url;
            if(this.tipoUsuario == 'AppModelsVendedor'){
                url = '/api/cliente'+'?paginacao=false'+'&vendedor_id=' + this.idUsuario;
            }
            else{
                url = '/api/cliente'+'?paginacao=false';
            }
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.clientes = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaVendedores: async function() {
            this.carregandoModal = true;
            this.vendedores = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/vendedor'+'?paginacao=false';
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.vendedores = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaFornecedores: async function() {
            this.carregandoModal = true;
            this.fornecedores = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/fornecedor'+'?paginacao=false';
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.fornecedores = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaMarcas: async function() {
            this.carregandoModal = true;
            this.marcas = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/marca'+'?paginacao=false';

            if(this.nomeObjeto == 'estoque'){
                url = '/api/marca'+'?paginacao=false&fornecedor_id='+this.modelObjetos[0]['fornecedor_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/marca'+'?paginacao=false';
            }
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.marcas = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaProdutos: async function() {
            this.carregandoModal = true;
            this.produtos = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/marca'+'?paginacao=false';
            //alert(this.modelObjetos[0]['marca_id'])
            if(this.nomeObjeto == 'estoque'){
                url = '/api/produto'+'?paginacao=false&marca_id='+this.modelObjetos[0]['marca_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/produto'+'?paginacao=false';
            }
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.produtos = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscarMeuProduto: async function() {
            this.carregandoModal = true;
            //this.meuProduto = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/marca'+'?paginacao=false';
            //alert(this.modelObjetos[0]['marca_id'])
            url = '/api/produto?buscarObjeto='+this.modelObjetos[0]['buscarObjetoProduto'];

            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.meuProduto = response.data))
                .catch(error => (this.error = error));

            this.temPaginacao = true;
            this.carregandoModal = false;
        },
        buscaTipo_produtos: async function() {
            this.carregandoModal = true;
            this.tipo_produtos = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/tipo_produto'+'?paginacao=false';
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.tipo_produtos = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaTipo_movimentacaos: async function() {
            this.carregandoModal = true;
            this.tipo_movimentacaos = null;
            this.carregandoGeral = true;
            var url;
            const paginacao = false;
            url = '/api/tipo_movimentacao'+'?paginacao=false';
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.tipo_movimentacaos = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        buscaMetodo_pagamentos: async function() {
            this.carregandoModal = true;
            this.metodo_pagamentos = null;
            this.carregandoGeral = true;
            var url;
            const paginacao = false;
            url = '/api/metodo_pagamento'+'?paginacao=false';
            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.metodo_pagamentos = response.data))
                .catch(error => (this.error = error));
            this.carregandoModal = false;
        },
        addProdutoCarrinho: function(index){
            if(this.meuCarrinho.find(item => item.id === this.meuProduto['data'][index]['id'])){
                alert('Este item já existe no carrinho');
            }
            else{
                this.meuCarrinho.push({
                    name: this.meuProduto['data'][index]['name'],
                    marca: this.meuProduto['data'][index]['marca']['name'],
                    id: this.meuProduto['data'][index]['id'],
                    qty_item: 1,
                    price_item: this.meuProduto['data'][index]['sale_price'],
                    total_item: this.meuProduto['data'][index]['sale_price']
                });
                this.modelObjetos[0]['total_price'] = this.modelObjetos[0]['total_price'] + parseFloat(this.meuCarrinho[this.meuCarrinho.length - 1]['price_item']);
            }
        },
        removerProdutoCarrinho: function(index){
            //this.modelObjetos[0]['total_price'] = this.modelObjetos[0]['total_price'] - (this.meuCarrinho[index]['qty_item'] * this.meuCarrinho[index]['price_item']);
            this.meuCarrinho.splice(index, 1);
            this.atualizaTotal();
        },
        atualizaTotalItem: function(index){
            //alert('opa'+this.meuCarrinho[index]['total_item']);
            this.meuCarrinho[index]['total_item'] = this.meuCarrinho[index]['qty_item'] * this.meuCarrinho[index]['price_item'];
            this.atualizaTotal();
        },
        atualizaTotal: function(){
            this.modelObjetos[0]['total_price'] = parseFloat(this.meuCarrinho.reduce(function(total, item) {
                    return parseFloat(total) + parseFloat(item.total_item);
                }, 0))
            ;
        },
        carregaMeuCarrinho: function(index){
            //alert('carregado');
            for(var produto of this.objetos['data'][index]['produtos']){
                this.meuCarrinho.push({
                    name: produto['name'],
                    marca: produto['marca']['name'],
                    id: produto['id'],
                    qty_item: produto['pivot']['qty_item'],
                    price_item: produto['pivot']['price_item'],
                    total_item: produto['pivot']['qty_item'] * produto['pivot']['price_item']
                });
            }
        },
        aprovarPedido: async function(id){
            //alert('aprova'+ new Date());
            this.error = null;
            if( confirm("Tem certeza que deseja aprovar este pedido? "+id) == true){
                    var url = '/api/pedido_aprovacao/'+id;
                    //fetch(url, { method: 'DELETE'} ).catch((e) => this.error = e);
                    var dados;
                    dados = {
                        id: id,
                        approval_date: new Date()
                    }
                    await axios
                        .put(url, dados, {
                            headers: {
                              Authorization: 'Bearer '+this.tokenUsuario
                            }
                          })
                        .then(response => (this.respostaData = response.data, this.resposta = response))
                        .catch(error => (this.error = error));
                    if(this.error == null){
                        alert("Aprovado com sucesso");
                    }
                    else{
                        alert("Um erro foi encontrado:"+this.error);
                    }
                    this.carregarObjeto('pedido');
            }
            else{
                alert("Cancelado");
            }
        },
        confirmarEntrega: async function(id){
            //alert('entrega');
            this.error = null;
            if( confirm("Tem certeza que deseja confirmar a entrega deste pedido? "+id) == true){
                    var url = '/api/pedido_entrega/'+id;
                    //fetch(url, { method: 'DELETE'} ).catch((e) => this.error = e);
                    var dados;
                    dados = {
                        id: id
                    }
                    await axios
                        .put(url, dados, {
                            headers: {
                              Authorization: 'Bearer '+this.tokenUsuario
                            }
                          })
                        .then(response => (this.respostaData = response.data, this.resposta = response))
                        .catch(error => (this.error = error));
                    if(this.error == null){
                        alert("Entrega confirmada com sucesso");
                    }
                    else{
                        alert("Um erro foi encontrado:"+this.error);
                    }
                    this.carregarObjeto('pedido');
            }
            else{
                alert("Cancelado");
            }
        },
        confirmarPagamento: async function(id){
            //alert('pagamento');
            this.error = null;
            if( confirm("Tem certeza que deseja confirmar o pagamento deste pedido? "+id) == true){
                    var url = '/api/pedido_pagamento/'+id;
                    //fetch(url, { method: 'DELETE'} ).catch((e) => this.error = e);
                    var dados;
                    dados = {
                        id: id
                    }
                    await axios
                        .put(url, dados, {
                            headers: {
                              Authorization: 'Bearer '+this.tokenUsuario
                            }
                          })
                        .then(response => (this.respostaData = response.data, this.resposta = response))
                        .catch(error => (this.error = error));
                    if(this.error == null){
                        alert("Pagamento confirmado com sucesso");
                    }
                    else{
                        alert("Um erro foi encontrado:"+this.error);
                    }
                    this.carregarObjeto('pedido');
            }
            else{
                alert("Cancelado");
            }
        },
        imprimePedido: async function(id){
            this.carregandoImpressao = true;
            this.pedidoImpressao = null;

            this.carregandoGeral = true;

            var url = '/api/pedido/'+id;

            //alert(url);

            await axios
                .get(url, {
                    headers: {
                      Authorization: 'Bearer '+this.tokenUsuario
                    }
                  })
                .then(response => (this.pedidoImpressao = response.data))
                .catch(error => (this.error = error));

            this.impressao = true;
            //alert('opa2');
            this.carregandoImpressao = false;

                /*
                const pdf = new jsPDF();
                pdf.html(document.body, {
                  callback: function (pdf) {
                    pdf.save("pagina.pdf");
                  },
                });*/

        }
    }
})
