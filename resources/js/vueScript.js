import { forEach } from "lodash";

var app = new Vue({
    el: '#app',
    data: {
        idUsuario: "{{ Auth::user()->id }}",
        tipoUsuario: '',
        nomeUsuario: '',
        titulo: "",
        acaoObjeto: "",
        nomeObjeto: "",

        tiposPessoa: [
            {tipo: 'App\\Models\\Cliente', label: 'Cliente'},
            {tipo: 'App\\Models\\Vendedor', label: 'Vendedor'},
            {tipo: 'App\\Models\\Fornecedor', label: 'Fornecedor'},
        ],

        resposta: [{}],

        error: null,
        carregando: false,
        carregandoGeral: false,
        objetos: [{}],
        modalErro: false,
        modalSucesso: false,
        modelObjetos:[{
            id: "",

            name: "", email: "", senha: "", confirmaSenha: "", //admin e vendedor

            company_name: "", cnpj: "", vendedor_id: "", //cliente e fornecedor

            number_phone: "", telefoneable_id: "", telefoneable_type: "", //telefone

            fornecedor_id: "", //marca

            tipo_produto_id: "", quantity: "", weight: "", cost_price: "", sale_price: "", marca_id: "", //produto

            tipo_movimentacaos_id: "", qty_item: "", observation: "", produto_id: "", //estoque

            name_country: "",  // pais

            name_state: "", pais_id: "", // estado

            name_city: "", estado_id: "", // cidade

            name_neighborhood: "", cidade_id: "", //bairro

            street_name: "", house_number: "", cep: "", complement: "", enderecoable_id: "", enderecoable_type: "",

            buscarObjeto: "", ordenacaoBusca: "", tipoPessoa: ""

        }],
        index: "",

        paises: [{}],
        estados: [{}],
        cidades: [{}],
        bairros: [{}],
        vendedores: [{}],
        clientes: [{}],
        fornecedores: [{}],
        pessoas: [{}],
        marcas: [{}],
        produtos: [{}],
        tipo_produtos: [{}],
        tipo_movimentacaos: [{}],

        mostrarSenha: "password",
        resposta: '',
        respostaData: '',
        variavelBusca: '',
        variavelOrdenacao: ''
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
                alert('opa, vendedor');
                if(classe == 'endereco' || classe == 'telefone'){
                    url = url + '?vendedor_id=' + this.idUsuario;
                }
            }

            /*fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);
            */

            axios
                .get(url)
                .then(response => (this.objetos = response.data, this.resposta = response))
                .catch(error => (this.error = error));

            this.variavelBusca = '';
            this.variavelOrdenacao = '';
            this.modelObjetos[0]['buscarObjeto'] = '';
            this.modelObjetos[0]['ordenacaoBusca'] = '';
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
                .get(url)
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
                if(acao == "Criar" || acao == "AddAPI"){
                    this.addObjeto(classe);
                }
                else if(acao == "Alterar"){
                    this.updateObjeto(classe);
                }
                else{
                    alert("deu ruim na escolha de acao");
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
                    marca_id: this.modelObjetos[0]['marca_id']
                }
            }
            else if(classe == "tipo_produto" || classe == "tipo_movimentacao" || classe == "metodo_pagamento"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name']
                }
            }
            /*else if(classe == "telefone"){
                url = '/api/'+classe;
                dados = {
                    number_phone: this.modelObjetos[0]['number_phone'],
                    tipoUsuario: this.tipoUsuario,
                    idUsuario: this.idUsuario
                }
            }*/
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
                .post(url, dados)
                .then(response => (this.respostaData = response.data, this.resposta = response))
                .catch(error => (this.error = error));

            alert(url);

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
            }
            else if(this.nomeObjeto == "administrador" || this.nomeObjeto == "vendedor"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
            }
            else if(this.nomeObjeto == "administrador/"+this.idUsuario || this.nomeObjeto == "vendedor"){
                this.modelObjetos[0]['name'] = this.objetos['data']['name'];
                this.modelObjetos[0]['email'] = this.objetos['data']['user']['email'];
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
                this.buscaPessoa();3
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
            if(this.nomeObjeto == 'produto'){this.buscaMarcas();}
            if(this.nomeObjeto == 'produto'){this.buscaTipo_produtos();}
            if(this.nomeObjeto == 'estoque'){this.buscaTipo_movimentacaos();}
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
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email']
                }
            }
            else if(classe == "vendedor"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id'];
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email']
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

            alert(url);

            /*fetch(url, { method: 'PUT', headers: {"Content-type": "application/json"}} ).then((res) => res.json())
            .then((data) => this.resposta = data)
            .then(json => console.log(json))
            .catch((e) => this.error = e);*/

            await axios
                .put(url, dados)
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
                        .delete(url)
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


            this.error = null;
            if(this.nomeObjeto == 'estado' || this.nomeObjeto == 'endereco') {this.buscaPaises();}
            if(this.nomeObjeto == 'cidade'){this.buscaEstados();}
            if(this.nomeObjeto == 'bairro'){this.buscaCidades();}
            if(this.nomeObjeto == 'cliente') { this.buscaVendedores();}
            if(this.nomeObjeto == 'marca' || this.nomeObjeto == 'estoque'){this.buscaFornecedores();}
            if(this.nomeObjeto == 'produto'){this.buscaMarcas();}
            if(this.nomeObjeto == 'produto'){this.buscaTipo_produtos();}
            if(this.nomeObjeto == 'estoque'){this.buscaTipo_movimentacaos();}
            if(this.tipoUsuario == 'AppModelsVendedor'){
                if(this.nomeObjeto == 'endereco' || this.nomeObjeto == 'telefone'){
                    this.buscaClientes();
                }
            }
            //if(this.nomeObjeto == 'estoque'){this.buscaProdutos();}
        },
        limparGeral: function(){
            this.objetos = null;
            this.titulo = "";
            this.nomeObjeto = "";
            this.acaoObjeto = "";
        },
        verificaDados: function(classe){
            if(classe == 'cliente'){
                if(
                    this.modelObjetos[0]['name'] == "" ||
                    this.modelObjetos[0]['email'] == "" ||
                    this.modelObjetos[0]['cnpj'] == "" ||
                    this.modelObjetos[0]['company_name'] == "" ||
                    this.modelObjetos[0]['vendedor_id'] == "" ||
                    this.modelObjetos[0]['senha'] == "" ||
                        this.modelObjetos[0]['confirmaSenha'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                    alert("Erro: Senhas diferentes");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'fornecedor'){
                if(
                    this.modelObjetos[0]['name'] == "" ||
                    this.modelObjetos[0]['email'] == "" ||
                    this.modelObjetos[0]['cnpj'] == "" ||
                    this.modelObjetos[0]['company_name'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'marca'){
                if(
                    this.modelObjetos[0]['name'] == "" || this.modelObjetos[0]['fornecedor_id'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'produto'){
                if(
                    this.modelObjetos[0]['name'] == "" ||
                    this.modelObjetos[0]['type'] == "" ||
                    this.modelObjetos[0]['quantity'] == "" ||
                    this.modelObjetos[0]['weight'] == "" ||
                    this.modelObjetos[0]['cost_price'] == "" ||
                    this.modelObjetos[0]['sale_price'] == "" ||
                    this.modelObjetos[0]['marca_id'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'administrador' || classe == 'vendedor'){
                if(this.acaoObjeto == "Criar"){
                    if(
                        this.modelObjetos[0]['name'] == "" ||
                        this.modelObjetos[0]['email'] == "" ||
                        this.modelObjetos[0]['senha'] == "" ||
                        this.modelObjetos[0]['confirmaSenha'] == ""
                    ){
                        alert("Erro");
                        return true;
                    }
                    else if(this.modelObjetos[0]['senha'] !=  this.modelObjetos[0]['confirmaSenha']){
                        alert("Erro: Senhas diferentes");
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else if(this.acaoObjeto == "Alterar"){
                    if(
                        this.modelObjetos[0]['name'] == "" ||
                        this.modelObjetos[0]['email'] == ""
                    ){
                        alert("Erro");
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    alert("Erro inexplicavel");
                    return true;
                }

            }
            else if(classe == 'administrador/'+this.idUsuario ){

                    if(
                        this.modelObjetos[0]['name'] == "" ||
                        this.modelObjetos[0]['email'] == ""
                    ){
                        alert("Erro");
                        return true;
                    }
                    else{
                        return false;
                    }


            }
            else if(classe == 'telefone'){
                    if(
                        this.modelObjetos[0]['number_phone'] == "" ||
                        this.modelObjetos[0]['telefoneable_id'] == ""
                    ){
                        alert("Erro");
                        return true;
                    }
                    else{
                        return false;
                    }
            }
            else if(classe == "tipo_produto" || classe == "tipo_movimentacao" || classe == "metodo_pagamento"){
                if(
                    this.modelObjetos[0]['name'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'pais'){
                if(
                    this.modelObjetos[0]['name_country'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'estado'){
                if(
                    this.modelObjetos[0]['name_state'] == "" || this.modelObjetos[0]['pais_id'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'cidade'){
                if(
                    this.modelObjetos[0]['name_city'] == "" || this.modelObjetos[0]['estado_id'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'bairro'){
                if(
                    this.modelObjetos[0]['name_neighborhood'] == "" || this.modelObjetos[0]['cidade_id'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'endereco'){
                if(
                    this.modelObjetos[0]['street_name'] == "" ||
                    this.modelObjetos[0]['bairro_id'] == "" ||
                    this.modelObjetos[0]['enderecoable_id'] == "" ||
                    this.modelObjetos[0]['house_number'] == "" ||
                    this.modelObjetos[0]['cep'] == ""
                ){
                    alert("Erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'estoque'){
                if(
                    this.modelObjetos[0]['qty_item'] == "" ||
                    this.modelObjetos[0]['tipo_movimentacao_id'] == "" ||
                    this.modelObjetos[0]['produto_id'] == "" ||
                    this.modelObjetos[0]['qty_item'] == ""
                ){
                    alert("Erro");
                    return true;
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
            //this.objetos = null;
            //this.carregandoGeral = true;
            //var url;
            //url = '/api/'+classe;

            /*fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);
            */
            alert(url);
            this.objetos = null;

            if(this.variavelBusca !== ''){
                url = url + '&buscarObjeto=' + this.variavelBusca;
            }
            if(this.variavelOrdenacao !== ''){
                url = url + '&ordenacaoBusca=' + this.variavelOrdenacao;
            }
            axios
                .get(url)
                .then(response => (this.objetos = response.data, this.resposta = response))
                .catch(error => (this.error = error));
        },
        buscarObjetos: function(){
            //alert('clicado');
            var classe = this.nomeObjeto;
            var url;
            var dados;
            if(this.modelObjetos[0]['buscarObjeto'] !== '' &&  this.modelObjetos[0]['ordenacaoBusca'] !== '' ){
                alert('orde e busca');
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
                alert('busca');
                url = '/api/'+classe+'?buscarObjeto='+this.modelObjetos[0]['buscarObjeto'];
            }
            else if(this.modelObjetos[0]['buscarObjeto'] == '' &&  this.modelObjetos[0]['ordenacaoBusca'] !== ''){
                alert('orde');
                url = '/api/' + classe + '?ordenacaoBusca=' + this.modelObjetos[0]['ordenacaoBusca'];
            }
            else{
                alert("campos vazios, mas vc clicou em buscar mesmo assim, recarregando tudo.");
                this.variavelBusca = '';
                this.variavelOrdenacao = '';
                this.carregarObjeto(classe);
                return;
            }

            axios
            .get(url)
            .then(response => (this.objetos = response.data, this.resposta = response))
            .catch(error => (this.error = error));

            if(this.error == null){
                this.variavelBusca = this.modelObjetos[0]['buscarObjeto'];
                this.variavelOrdenacao = this.modelObjetos[0]['ordenacaoBusca'];
            }


        },
        ordenacao: function(coluna){
            alert('clicado ordenacao');
            var classe = this.nomeObjeto;


                //this.objetos = null;
                //this.carregandoGeral = true;
                var url;

                url = '/api/'+classe+'?ordenacaoBusca='+coluna;

                axios
                    .get(url)
                    .then(response => (this.objetos = response.data, this.resposta = response))
                    .catch(error => (this.error = error));

        },
        buscaPaises: function() {
            this.paises = null;
            this.carregandoGeral = true;
            var url;
            const paginacao = '?paginacao=false';
            //if() {var where = '&atributo='+atributo+'&valor='+valor;}
            url = '/api/pais'+paginacao;

            axios
                .get(url)
                .then(response => (this.paises = response.data))
                .catch(error => (this.error = error));
        },
        buscaEstados: function() {
            this.estados = null;
            this.carregandoGeral = true;
            var url;
            if(this.nomeObjeto == 'endereco'){
                url = '/api/estado'+'?paginacao=false&pais_id='+this.modelObjetos[0]['pais_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/estado'+'?paginacao=false';
            }


            axios
                .get(url)
                .then(response => (this.estados = response.data))
                .catch(error => (this.error = error));
        },
        buscaCidades: function() {
            this.cidades = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/cidade'+'?paginacao=false';

            if(this.nomeObjeto == 'endereco'){
                url = '/api/cidade'+'?paginacao=false&estado_id='+this.modelObjetos[0]['estado_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/cidade'+'?paginacao=false';
            }

            axios
                .get(url)
                .then(response => (this.cidades = response.data))
                .catch(error => (this.error = error));
        },
        buscaBairros: function() {

            this.bairros = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/bairro'+'?paginacao=false';

            if(this.nomeObjeto == 'endereco'){
                url = '/api/bairro'+'?paginacao=false&cidade_id='+this.modelObjetos[0]['cidade_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/bairro'+'?paginacao=false';
            }

            axios
                .get(url)
                .then(response => (this.bairros = response.data))
                .catch(error => (this.error = error));
        },
        buscaPessoa: function() {
            //alert('opa')
            this.pessoas = null;
            this.carregandoGeral = true;
            var url;
            alert(this.modelObjetos[0]['tipoPessoa']);
            url = '/api/'+this.modelObjetos[0]['tipoPessoa']+'?paginacao=false';
            alert(url);

            if(this.tipoUsuario == 'AppModelsVendedor'){
                alert('opa, vendedor de novo');
                if(this.nomeObjeto == 'endereco' || this.nomeObjeto == 'telefone'){
                    url = url + '&vendedor_id=' + this.idUsuario;
                }
            }

            axios
                .get(url)
                .then(response => (this.pessoas = response.data))
                .catch(error => (this.error = error));
        },
        buscaClientes: function() {
            this.clientes = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/cliente'+'?paginacao=false'+'&vendedor_id=' + this.idUsuario;
            //alert(url);

            axios
                .get(url)
                .then(response => (this.clientes = response.data))
                .catch(error => (this.error = error));
        },
        buscaVendedores: function() {
            this.vendedores = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/vendedor'+'?paginacao=false';
            //alert(url);

            axios
                .get(url)
                .then(response => (this.vendedores = response.data))
                .catch(error => (this.error = error));
        },
        buscaFornecedores: function() {
            this.fornecedores = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/fornecedor'+'?paginacao=false';
            //alert(url);

            axios
                .get(url)
                .then(response => (this.fornecedores = response.data))
                .catch(error => (this.error = error));
        },
        buscaMarcas: function() {
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

            axios
                .get(url)
                .then(response => (this.marcas = response.data))
                .catch(error => (this.error = error));
        },
        buscaProdutos: function() {
            this.produtos = null;
            this.carregandoGeral = true;
            var url;
            //url = '/api/marca'+'?paginacao=false';
            alert(this.modelObjetos[0]['marca_id'])
            if(this.nomeObjeto == 'estoque'){
                url = '/api/produto'+'?paginacao=false&marca_id='+this.modelObjetos[0]['marca_id'];
                //alert('passou aki '+this.modelObjetos[0]['pais_id'])
            }
            else{
                url = '/api/produto'+'?paginacao=false';
            }
            //alert(url);

            axios
                .get(url)
                .then(response => (this.produtos = response.data))
                .catch(error => (this.error = error));
        },
        buscaTipo_produtos: function() {
            this.tipo_produtos = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/tipo_produto'+'?paginacao=false';
            //alert(url);

            axios
                .get(url)
                .then(response => (this.tipo_produtos = response.data))
                .catch(error => (this.error = error));
        },
        buscaTipo_movimentacaos: function() {
            this.tipo_movimentacaos = null;
            this.carregandoGeral = true;
            var url;
            const paginacao = false;
            url = '/api/tipo_movimentacao'+'?paginacao=false';
            //alert(url);

            axios
                .get(url)
                .then(response => (this.tipo_movimentacaos = response.data))
                .catch(error => (this.error = error));
        }

    }
})


