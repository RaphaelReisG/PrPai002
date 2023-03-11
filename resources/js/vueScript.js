import { forEach } from "lodash";

var app = new Vue({
    el: '#app',
    data: {
        idUsuario: "{{ Auth::user()->id }}",

            banana: false,
            titulo: "",
            acaoObjeto: "",
            nomeObjeto: "",

            resposta: [{}],

            error: null,
            carregando: false,
            carregandoGeral: false,
            objetos: [{}],
            modalErro: false,
            modalSucesso: false,
            modelObjetos:[{
                id: "",

                name: "", email: "",

                company_name: "", cnpj: "",

                setup: "", simbolo: "", emocao: "", compraVenda: "", quantidade: "", valorEntrada: "", valorSaida: "", taxa: "",  setup: "", dtEntrada: "",
                dtSaida: "", fdEmocional: "", fdImediato: "",

                key: "", secret: "",

                symbol: "", startTime: "", endTime: "", limite: "",

                nomeSetup: "",
                nomeEmocao: "",

            }],
            index: "",

            buscaApi: false,
            apiObjetos: [{}],
            credencialApi: [{}],
            setups: [{}],
            emocaos: [{}],
            compra_venda: [{valor: "Compra"}, {valor: "Venda"}],

            mostrarSenha: "password",

            teste:  [{}],
            nomeSetup: ""
    },
    methods: {
        defineClasse: function(classe, titulo ){
            //alert('01');
            //this.objetos = null;
            //this.limparGeral();
            this.nomeObjeto = classe;
            this.titulo = titulo;

            if(classe != ''){
                    this.carregarObjeto(classe);


            }

        },
        carregarObjeto: function(classe){
            //alert('02');
            this.objetos = null;
            this.carregandoGeral = true;
            var url;
            if(classe == "diario"){
                //alert("passou aki");
                url = '/api/diario_usuario/'+this.idUsuario;
            }
            else{
                //url = '/api/'+classe+'/'+this.idUsuario;
                url = '/api/'+classe;
            }

            fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data).finally(this.carregandoGeral = false);

            //this.carregandoGeral = false;

        },
        carregarApiBinance: function(){
            this.carregando = true;
            this.buscaApi = false;
            if(this.modelObjetos[0]['limite'] == null){
                this.modelObjetos[0]['limite'] = 0;
            }
            if(this.modelObjetos[0]['startTime'] == null || this.modelObjetos[0]['startTime'] == ''){
                var startTime = 0;
            }
            else{
                var startTime = new Date(this.modelObjetos[0]['startTime']).getTime();
            }

            if(this.modelObjetos[0]['endTime'] == null || this.modelObjetos[0]['endTime'] == ''){
                var endTime = 0;
            }
            else{
                var endTime = new Date(this.modelObjetos[0]['endTime']).getTime();
            }

            var url = '/api/importar/'+this.idUsuario+'/'+this.modelObjetos[0]['symbol']+'/'+this.modelObjetos[0]['limite']+'/'+startTime+'/'+endTime;
            fetch(url).then((res) => res.json())
                .then((data) => this.apiObjetos = data);

            this.carregando = false;
            this.buscaApi = true;

            alert(url);
        },
        carregaCredencialApi: function(){
            var url = '/api/credencialapibinance/'+this.idUsuario;
            //alert(url);
            fetch(url).then((res) => res.json())
                    .then((data) => this.credencialApi = data);
        },
        carregaSetup: function(){
            this.carregandoGeral = true;
            var url = '/api/setup/'+this.idUsuario;
            //alert(url);
            fetch(url).then((res) => res.json())
                    .then((data) => this.setups = data);
            this.carregandoGeral = false;
        },
        carregaEmocao: function(){
            this.carregandoGeral = true;
            var url = '/api/emocao/'+this.idUsuario;
            //alert(url);
            fetch(url).then((res) => res.json())
                    .then((data) => this.emocaos = data);
            this.carregandoGeral = false;
        },
        escolheAcaoObjeto: function(acao, classe){
            if(this.verificaDados(classe) == true){
                alert("preencha os campos obrigatorios");
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
        addObjeto: function(classe){
            this.carregando = true;
            var url;
            if(classe == "administrador"){
                url = '/api/'+classe+
                    '?nome='+this.modelObjetos['nome']+
                    '&email='+this.modelObjetos['email']+
                    '&senha='+this.modelObjetos['senha'];
            }
            else if(classe == "cliente"){
                url = '/api/'+classe+
                    '?name='+this.modelObjetos[0]['name']+
                    '&email='+this.modelObjetos[0]['email']+
                    '&company_name='+this.modelObjetos[0]['company_name']+
                    '&cnpj='+this.modelObjetos[0]['cnpj']
                ;
            }
            else if(classe == "diario"){
                url = '/api/'+classe+
                    '?simbolo='+this.modelObjetos[0]['simbolo']+
                    '&setup='+this.modelObjetos[0]['setup']+
                    '&emocao='+this.modelObjetos[0]['emocao']+
                    '&compraVenda='+this.modelObjetos[0]['compraVenda']+
                    '&quantidade='+this.modelObjetos[0]['quantidade']+
                    '&valorEntrada='+this.modelObjetos[0]['valorEntrada']+
                    '&valorSaida='+this.modelObjetos[0]['valorSaida']+
                    '&dtEntrada='+this.modelObjetos[0]['dtEntrada']+
                    '&dtSaida='+this.modelObjetos[0]['dtSaida']+
                    '&fdEmocional='+this.modelObjetos[0]['fdEmocional']+
                    '&fdImediato='+this.modelObjetos[0]['fdImediato']+
                    '&user_id='+this.idUsuario
                ;

                /*
                url = '/api/'+classe+
                    '?dataRegistro='+this.modelObjetos['dataRegistro']+
                    '&setup='+this.modelObjetos['setup']+
                    '&emocao='+this.modelObjetos['emocao']+
                    '&compraVenda='+this.modelObjetos['compraVenda']+
                    '&quantidade='+this.modelObjetos['quantidade']

                ;*/
                //alert(url);
            }
            else if(classe == "setup"){
                url = '/api/'+classe+
                    '?nomeSetup='+this.modelObjetos[0]['nomeSetup']+
                    '&user_id='+this.idUsuario;
            }
            else if(classe == "emocao"){
                url = '/api/'+classe+
                    '?nomeEmocao='+this.modelObjetos[0]['nomeEmocao']+
                    '&user_id='+this.idUsuario;
            }
            else if(classe == "credencialapibinance"){
               url = '/api/'+classe+'?key='+this.modelObjetos[0]['key']+'&secret='+this.modelObjetos[0]['secret']+
                '&user_id='+this.idUsuario;
            }
            else{
                alert("Erro, Classe inexistente!");
            }

            fetch(url, { method: 'POST'} ).catch((e) => this.error = e);

            alert(url);

            //fetch(url, { method: 'POST'} ).then((res) => this.error = res);

            //fetch(url).then((res) => res.json())
            //.then((data) => this.objetos = data);

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
            this.carregaSetup();
            this.carregaEmocao();

            if(this.acaoObjeto !== 'AddAPI'){
                this.modelObjetos[0]['id'] = this.objetos['data'][index]['id'];
            }

            //alert("01 - "+index);
            if(this.acaoObjeto == 'AddAPI'){
                if(this.apiObjetos[index]['side'] == 'BUY'){
                    this.modelObjetos[0]['compraVenda'] = "Compra";
                }
                else if(this.apiObjetos[index]['side'] == 'SELL'){
                    this.modelObjetos[0]['compraVenda'] = "Venda";
                }

                var data = new Date(this.apiObjetos[index]['time']);
                data = data.toLocaleString();

                //new Date(obj[valor.conteudo]).toLocaleString()

                var dataFormatada = new Date(data);

                //alert(dataFormatada);
                //alert(data);

                //this.modelObjetos['dataRegistro'] = this.apiObjetos[index]['time'];
                //  this.modelObjetos[0]['dtEntrada'] = data;
                //this.modelObjetos['dataRegistro'] = this.objetos[0]['dataRegistro'];

                //alert(this.modelObjetos['dataRegistro']);

                //this.modelObjetos['emocao'] = this.objetos[index]['emocao'];
                //this.modelObjetos['compraVenda'] = this.objetos[index]['compraVenda'];
                //this.modelObjetos['quantidade'] = this.apiObjetos[index]['qty'];
                //this.modelObjetos['pontos'] = this.objetos[index]['pontos'];
                this.modelObjetos[0]['valorEntrada'] = this.apiObjetos[index]['price'];
                //this.modelObjetos['taxa'] = this.objetos[index]['taxa'];
                //this.modelObjetos['dtEntrada'] = this.objetos[index]['dtEntrada'];
                //this.modelObjetos['dtSaida'] = this.objetos[index]['dtSaida'];
                //this.modelObjetos['fdEmocional'] = this.objetos[index]['fdEmocional'];
                //this.modelObjetos['fdImediato'] = this.objetos[index]['fdImediato'];
            }

            else if(this.nomeObjeto == "cliente"){
                this.modelObjetos[0]['name'] = this.objetos['data'][index]['name'];
                this.modelObjetos[0]['cnpj'] = this.objetos['data'][index]['cnpj'];
                this.modelObjetos[0]['email'] = this.objetos['data'][index]['user']['email'];
                this.modelObjetos[0]['company_name'] = this.objetos['data'][index]['company_name'];
            }

            else if(this.nomeObjeto == "diario"){
                this.modelObjetos[0]['setup'] = this.objetos[index]['setup'];
                this.modelObjetos[0]['simbolo'] = this.objetos[index]['simbolo'];
                this.modelObjetos[0]['emocao'] = this.objetos[index]['emocao'];
                this.modelObjetos[0]['compraVenda'] = this.objetos[index]['compraVenda'];
                this.modelObjetos[0]['quantidade'] = this.objetos[index]['quantidade'];
                this.modelObjetos[0]['pontos'] = this.objetos[index]['pontos'];
                this.modelObjetos[0]['valorEntrada'] = this.objetos[index]['valorEntrada'];
                this.modelObjetos[0]['valorSaida'] = this.objetos[index]['valorSaida'];
                this.modelObjetos[0]['taxa'] = this.objetos[index]['taxa'];
                this.modelObjetos[0]['dtEntrada'] = this.objetos[index]['dtEntrada'];
                this.modelObjetos[0]['dtSaida'] = this.objetos[index]['dtSaida'];
                this.modelObjetos[0]['fdEmocional'] = this.objetos[index]['fdEmocional'];
                this.modelObjetos[0]['fdImediato'] = this.objetos[index]['fdImediato'];

            }
            else if(this.nomeObjeto == "emocao"){
                this.modelObjetos[0]['nomeEmocao'] = this.objetos[index]['nomeEmocao'];
            }
            else if(this.nomeObjeto == "setup"){
                //alert("passou aki");
                this.modelObjetos[0]['nomeSetup'] = this.objetos[index]['nomeSetup'];
            }
            else{

                this.modelObjetos[0]['id'] = this.objetos[index]['id'];

                this.modelObjetos[0]['nome'] = this.objetos[index]['nome'];
                this.modelObjetos[0]['email'] = this.objetos[index]['email'];
                this.modelObjetos[0]['senha'] = this.objetos[index]['senha'];
                this.modelObjetos[0]['confirmaSenha'] = this.objetos[index]['senha'];

                this.modelObjetos[0]['chaveApi'] = this.objetos[index]['chaveApi'];
                this.modelObjetos[0]['segredoApi'] = this.objetos[index]['segredoApi'];

            }

        },
        updateObjeto: function(classe){
            this.carregando = true;
            var url;

            if(classe == "administrador"){
                url = '/api/'+classe+'/'+this.modelObjetos['id']+'?nome='+this.modelObjetos['nome']+'&email='+this.modelObjetos['email']+'&senha='+this.modelObjetos['senha'];
            }
            else if(classe == "cliente"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id']+
                    '?name='+this.modelObjetos[0]['name']+
                    '&email='+this.modelObjetos[0]['email']+
                    '&company_name='+this.modelObjetos[0]['company_name']+
                    '&cnpj='+this.modelObjetos[0]['cnpj'];
            }
            else if(classe == "diario"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id']+
                    '?setup='+this.modelObjetos[0]['setup']+
                    '&emocao='+this.modelObjetos[0]['emocao']+
                    '&simbolo='+this.modelObjetos[0]['simbolo']+
                    '&compraVenda='+this.modelObjetos[0]['compraVenda']+
                    '&quantidade='+this.modelObjetos[0]['quantidade']+
                    '&valorEntrada='+this.modelObjetos[0]['valorEntrada']+
                    '&valorSaida='+this.modelObjetos[0]['valorSaida']+
                    '&taxa='+this.modelObjetos[0]['taxa']+
                    '&dtEntrada='+this.modelObjetos[0]['dtEntrada']+
                    '&dtSaida='+this.modelObjetos[0]['dtSaida']+
                    '&fdEmocional='+this.modelObjetos[0]['fdEmocional']+
                    '&fdImediato='+this.modelObjetos[0]['fdImediato']
                ;
            }
            else if(classe == "setup"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id']+
                    '?nomeSetup='+this.modelObjetos[0]['nomeSetup']
            }
            else if(classe == "emocao"){
                url = '/api/'+classe+'/'+this.modelObjetos[0]['id']+
                    '?nomeEmocao='+this.modelObjetos[0]['nomeEmocao']+'&user_id='+this.idUsuario;
            }
            else if(classe == "credencialapibinance"){

                url = '/api/'+classe+'/'+this.idUsuario+
                    '?key='+this.modelObjetos[0]['key']+'&secret='+this.modelObjetos[0]['secret'];
                    //alert(url);
            }
            else{
                alert("Erro, Classe inexistente!");
            }

            alert(url);

            fetch(url, { method: 'PUT', headers: {"Content-type": "application/json"}} ).then((res) => res.json())
            .then((data) => this.resposta = data)
            .then(json => console.log(json))
            .catch((e) => this.error = e);


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
        desativarObjeto: function(classe, id){
            if( confirm("Tem certeza que deseja deletar? "+id) == true){
                /*
                if(classe !== "diario"){
                    var url = '/api/'+classe+'/'+id+'?ativo=0';
                    alert(url);
                    fetch(url, { method: 'PUT'} ).catch((e) => this.error = e);
                    if(this.error == null){
                        //this.limparModal();
                        //this.modalSucesso = true;
                        alert("Desativado com sucesso");
                    }
                    else{
                        //this.modalErro = true;
                        alert("Um erro foi encontrado:"+this.error);
                        //this.modalErro = false;
                        //this.error = null;
                    }
                    this.carregarObjeto(classe);
                }
                else{
                    */
                    var url = '/api/'+classe+'/'+id;
                    //alert(url);
                    fetch(url, { method: 'DELETE'} ).catch((e) => this.error = e);
                    if(this.error == null){
                        //this.limparModal();
                        //this.modalSucesso = true;
                        alert("Excluido com sucesso");
                    }
                    else{
                        //this.modalErro = true;
                        alert("Um erro foi encontrado:"+this.error);
                        //this.modalErro = false;
                        //this.error = null;
                    }
                    this.carregarObjeto(classe);
                //}

            }
            else{
                alert("Cancelado");
            }
        },
        limparModal: function(){
            //this.modelObjetos= [{}];

            this.modelObjetos[0]['setup'] = "";
            this.modelObjetos[0]['simbolo'] = "";
            this.modelObjetos[0]['emocao'] = "";
            this.modelObjetos[0]['compraVenda'] = "";
            this.modelObjetos[0]['quantidade'] = "";
            this.modelObjetos[0]['pontos'] = "";
            this.modelObjetos[0]['valorEntrada'] = "";
            this.modelObjetos[0]['valorSaida'] = "";
            this.modelObjetos[0]['taxa'] = "";
            this.modelObjetos[0]['dtEntrada'] = "";
            this.modelObjetos[0]['dtSaida'] = "";
            this.modelObjetos[0]['fdEmocional'] = "";
            this.modelObjetos[0]['fdImediato'] = "";
            this.modelObjetos[0]['nomeEmocao'] = "";
            this.modelObjetos[0]['nomeSetup'] = "";

            this.modelObjetos[0]['name'] = "";
            this.modelObjetos[0]['company_name'] = "";
            this.modelObjetos[0]['email'] = "";
            this.modelObjetos[0]['cnpj'] = "";

            this.modelObjetos[0]['key'] = "";
            this.modelObjetos[0]['secret'] = "";

            this.carregaSetup();
            this.carregaEmocao();
        },
        mostrarConteinerObjeto: function(classe){
            if(classe !== ''){
                this.carregarObjeto(classe);
            }
        },
        limparGeral: function(){
            //alert('teste');
            //limparModal();
            this.objetos = null;
            this.titulo = "";
            this.nomeObjeto = "";
            this.acaoObjeto = "";
            this.apiObjetos = null;
            this.credencialApi = null;
            //alert('teste2');
        },
        verificaDados: function(classe){
            if(classe == 'diario'){
                if(
                    this.modelObjetos[0]['setup'] == "" ||
                    this.modelObjetos[0]['simbolo'] == "" ||
                    this.modelObjetos[0]['emocao'] == "" ||
                    this.modelObjetos[0]['compraVenda'] == "" ||
                    this.modelObjetos[0]['quantidade'] == "" ||
                    this.modelObjetos[0]['valorEntrada'] == "" ||
                    this.modelObjetos[0]['dtEntrada'] == ""
                ){
                    alert("erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'credencialapibinance'){
                if(
                    this.modelObjetos[0]['key'] == "" ||
                    this.modelObjetos[0]['secret'] == ""
                ){
                    alert("erro");
                    return true;
                }
                else{
                    return false;
                }

            }
            else if(classe == 'setup'){
                if(
                    this.modelObjetos[0]['nomeSetup'] == ""
                ){
                    alert("erro");
                    return true;
                }
                else{
                    return false;
                }
            }
            else if(classe == 'emocao'){

                if(
                    this.modelObjetos[0]['nomeEmocao'] = ""
                ){
                    alert("erro");
                    return true;
                }
                else{
                    return false;
                }
            }
        }
    }
})


