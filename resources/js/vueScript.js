import { forEach } from "lodash";

var app = new Vue({
    el: '#app',
    data: {
        idUsuario: "{{ Auth::user()->id }}",
        tipoUsuario: '',
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

            company_name: "", cnpj: "", //clientes

            number_phone: "",

            name_country: "",  // pais

            name_state: "", pais_id: "", // estado

            buscarObjeto: "", ordenacaoBusca: ""

        }],
        index: "",

        paises: [{}],
        vendedores: [{}],

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
            url = '/api/'+classe;

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
                    senha: this.modelObjetos[0]['senha']
                }
            }
            else if(classe == "vendedor"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    senha: this.modelObjetos[0]['senha']
                }
            }
            else if(classe == "cliente"){
                url = '/api/'+classe;
                dados = {
                    name: this.modelObjetos[0]['name'],
                    email: this.modelObjetos[0]['email'],
                    company_name: this.modelObjetos[0]['company_name'],
                    cnpj: this.modelObjetos[0]['cnpj']
                }
            }
            else if(classe == "telefone"){
                url = '/api/'+classe;
                dados = {
                    number_phone: this.modelObjetos[0]['number_phone'],
                    tipoUsuario: this.tipoUsuario,
                    idUsuario: this.idUsuario
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

            if(this.acaoObjeto !== 'AddAPI'){
                this.modelObjetos[0]['id'] = this.objetos['data'][index]['id'];
            }

            //alert("01 - "+index);
            if(this.nomeObjeto == "cliente"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['cnpj'] = this.objetos['data'][index]['cnpj'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
                this.modelObjetos[0]['company_name'] = this.objetos['data'][index]['company_name'];
            }

            else if(this.nomeObjeto == "administrador" || this.nomeObjeto == "vendedor"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
            }

            else if(this.nomeObjeto == "pais"){
                this.modelObjetos[0]['name_country'] = this.objetos['data'][index]['name_country'];
            }

            else if(this.nomeObjeto == "estado"){
                this.modelObjetos[0]['name_state'] = this.objetos['data'][index]['name_state'];
                this.modelObjetos[0]['pais_id'] = this.objetos['data'][index]['pais_id'];
            }
            else{
                alert("Erro! CarregarCamposEditarObjeto | Classe não encontrada");
            }

            this.buscaPaises();
            this.buscaVendedores();

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
                    cnpj: this.modelObjetos[0]['cnpj']
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

            this.modelObjetos[0]['name'] = "";
            this.modelObjetos[0]['company_name'] = "";
            this.modelObjetos[0]['email'] = "";
            this.modelObjetos[0]['cnpj'] = "";

            this.modelObjetos[0]['number_phone'] = "";

            this.modelObjetos[0]['senha'] = "";
            this.modelObjetos[0]['confirmaSenha'] = "";

            //pais
            this.modelObjetos[0]['name_country'] = "";

            //estado
            this.modelObjetos[0]['name_state'] = "";
            this.modelObjetos[0]['pais_id'] = "";



            this.buscaPaises();
            this.buscaVendedores();
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
                    this.modelObjetos[0]['company_name'] == ""
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
            else if(classe == 'telefone'){
                    if(
                        this.modelObjetos[0]['number_phone'] == ""
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
                    this.modelObjetos[0]['name_state'] == "" && this.modelObjetos[0]['pais_id'] == ""
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
            alert('clicado');
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
            url = '/api/pais';

            axios
                .get(url)
                .then(response => (this.paises = response.data.data))
                .catch(error => (this.error = error));
        },
        buscaVendedores: function() {
            this.vendedores = null;
            this.carregandoGeral = true;
            var url;
            url = '/api/vendedor';

            axios
                .get(url)
                .then(response => (this.vendedor = response.data.data))
                .catch(error => (this.error = error));
        },
    }
})


