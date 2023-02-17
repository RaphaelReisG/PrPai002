const { createApp } = Vue
    createApp({
    
    data() {
        return {
            idUsuario: "{{ Auth::user()->id }}",

            titulo: "",
            acaoObjeto: "",
            nomeObjeto: "",

            error: null,
            carregando: false,
            objetos: [{}],
            modalErro: false,
            modalSucesso: false,
            modelObjetos:{},

            buscaApi: false,
            apiObjetos: [{}],
            credencialApi: [{}]

        };
    },
    mounted(){
        
    },
    methods: {
        defineClasse(classe, titulo ){
            this.nomeObjeto = classe;
            this.titulo = titulo;
            if(classe != ''){
                this.carregarObjeto(classe);
            }
            
        },
        carregarObjeto(classe){
            if(classe == "diario"){
                url = '/api/diario_usuario/'+this.idUsuario;
            }
            else{
                url = '/api/'+classe;
            }
            fetch(url).then((res) => res.json())
                    .then((data) => this.objetos = data);
        },
        carregarApiBinance(){
            this.carregando = true;
            this.buscaApi = false;
            if(this.modelObjetos['limite'] == null){
                this.modelObjetos['limite'] = 0;
            }
            if(this.modelObjetos['startTime'] == null || this.modelObjetos['startTime'] == ''){
                var startTime = 0;
            }
            else{
                var startTime = new Date(this.modelObjetos['startTime']).getTime();
            }   

            if(this.modelObjetos['endTime'] == null || this.modelObjetos['endTime'] == ''){
                var endTime = 0;
            }
            else{
                var endTime = new Date(this.modelObjetos['endTime']).getTime();
            } 

            url = '/api/importar/'+this.modelObjetos['symbol']+'/'+this.modelObjetos['limite']+'/'+startTime+'/'+endTime;
            fetch(url).then((res) => res.json())
                .then((data) => this.apiObjetos = data);

            this.carregando = false;
            this.buscaApi = true;  
        },
        carregaCredencialApi(){
            url = '/api/credencialapibinance/'+this.idUsuario;
            alert(url);
            fetch(url).then((res) => res.json())
                    .then((data) => this.credencialApi = data);
        },
        escolheAcaoObjeto(acao, classe){
            if(acao == "Criar"){
                this.addObjeto(classe);
            }
            else if(acao == "Alterar"){
                this.updateObjeto(classe);
            }
            else{
                alert("deu ruim na escolha de acao");
            }
        },
        addObjeto(classe){
            this.carregando = true;

            if(classe == "administrador"){
                url = '/api/'+classe+
                    '?nome='+this.modelObjetos['nome']+
                    '&email='+this.modelObjetos['email']+
                    '&senha='+this.modelObjetos['senha'];
            }
            else if(classe == "cliente"){
                url = '/api/'+classe+
                    '?nome='+this.modelObjetos['nome']+
                    '&email='+this.modelObjetos['email']+
                    '&senha='+this.modelObjetos['senha']+
                    '&chaveApi='+this.modelObjetos['chaveApi']+
                    '&segredoApi='+this.modelObjetos['segredoApi']
                ;
            }
            else if(classe == "diario"){
                url = '/api/'+classe+
                    '?dataRegistro='+this.modelObjetos['dataRegistro']+
                    '&setup='+this.modelObjetos['setup']+
                    '&emocao='+this.modelObjetos['emocao']+
                    '&compraVenda='+this.modelObjetos['compraVenda']+
                    '&quantidade='+this.modelObjetos['quantidade']+
                    '&pontos='+this.modelObjetos['pontos']+
                    '&valor='+this.modelObjetos['valor']+
                    '&taxa='+this.modelObjetos['taxa']+
                    '&dtEntrada='+this.modelObjetos['dtEntrada']+
                    '&dtSaida='+this.modelObjetos['dtSaida']+
                    '&fdEmocional='+this.modelObjetos['fdEmocional']+
                    '&fdImediato='+this.modelObjetos['fdImediato']+
                    '&idUsuario='+this.idUsuario
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
            else{
                alert("Erro, Classe inexistente!");
            }

            fetch(url, { method: 'POST'} ).catch((e) => this.error = e);

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
        carregaCamposEditarObjeto(classe, index){
            this.modelObjetos['id'] = this.objetos[index]['id'];

            this.modelObjetos['nome'] = this.objetos[index]['nome'];
            this.modelObjetos['email'] = this.objetos[index]['email'];
            this.modelObjetos['senha'] = this.objetos[index]['senha'];
            this.modelObjetos['confirmaSenha'] = this.objetos[index]['senha'];

            this.modelObjetos['chaveApi'] = this.objetos[index]['chaveApi'];
            this.modelObjetos['segredoApi'] = this.objetos[index]['segredoApi'];

            if(this.objetos[index]['side'] == "BUY"){
                this.objetos[index]['compraVenda'] = "Compra";
            }
            else if(this.objetos[index]['side'] == "SELL"){
                this.objetos[index]['compraVenda'] = "Venda";
            }
            

            //this.objetos[index]['valor'] = this.objetos[index]['price'];
            //this.objetos[index]['quantidade'] = this.objetos[index]['executedQty'];
            //this.objetos[index]['pontos'] = this.objetos[index]['pontos'];
            //this.objetos[index]['taxa'] = this.objetos[index]['taxa'];
            //this.objetos[index]['dtEntrada'] = new Date(this.objetos[index]['time']);
            //alert(this.objetos[index]['dtEntrada']);
            //this.objetos[index]['dtSaida'] = new Date(this.objetos[index]['updateTime']);



            this.modelObjetos['dataRegistro'] = this.objetos[index]['dataRegistro'];
            this.modelObjetos['setup'] = this.objetos[index]['setup'];
            this.modelObjetos['emocao'] = this.objetos[index]['emocao'];
            this.modelObjetos['compraVenda'] = this.objetos[index]['compraVenda'];
            this.modelObjetos['quantidade'] = this.objetos[index]['quantidade'];
            this.modelObjetos['pontos'] = this.objetos[index]['pontos'];
            this.modelObjetos['valor'] = this.objetos[index]['valor'];
            this.modelObjetos['taxa'] = this.objetos[index]['taxa'];
            this.modelObjetos['dtEntrada'] = this.objetos[index]['dtEntrada'];
            this.modelObjetos['dtSaida'] = this.objetos[index]['dtSaida'];
            this.modelObjetos['fdEmocional'] = this.objetos[index]['fdEmocional'];
            this.modelObjetos['fdImediato'] = this.objetos[index]['fdImediato'];

            

            //this.modelObjetos['idUsuario'] = '{{ Auth::user()->id }}';
        },
        updateObjeto(classe){
            this.carregando = true;

            if(classe == "administrador"){
                url = '/api/'+classe+'/'+this.modelObjetos['id']+'?nome='+this.modelObjetos['nome']+'&email='+this.modelObjetos['email']+'&senha='+this.modelObjetos['senha'];
            }
            else if(classe == "cliente"){
                url = '/api/'+classe+'/'+this.modelObjetos['id']+'?nome='+this.modelObjetos['nome']+'&email='+this.modelObjetos['email']+'&senha='+this.modelObjetos['senha']
                        +'&chaveApi='+this.modelObjetos['chaveApi']+
                        '&segredoApi='+this.modelObjetos['segredoApi'];
            }
            else if(classe == "diario"){
                url = '/api/'+classe+'/'+this.modelObjetos['id']+
                    '?dataRegistro='+this.modelObjetos['dataRegistro']+
                    '&setup='+this.modelObjetos['setup']+
                    '&emocao='+this.modelObjetos['emocao']+
                    '&compraVenda='+this.modelObjetos['compraVenda']+
                    '&quantidade='+this.modelObjetos['quantidade']+
                    '&pontos='+this.modelObjetos['pontos']+
                    '&valor='+this.modelObjetos['valor']+
                    '&taxa='+this.modelObjetos['taxa']+
                    '&dtEntrada='+this.modelObjetos['dtEntrada']+
                    '&dtSaida='+this.modelObjetos['dtSaida']+
                    '&fdEmocional='+this.modelObjetos['fdEmocional']+
                    '&fdImediato='+this.modelObjetos['fdImediato']
                ;
            }
            else{
                alert("Erro, Classe inexistente!");
            }

            fetch(url, { method: 'PUT'} ).catch((e) => this.error = e);
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
        desativarObjeto(classe, id){
            if( confirm("Tem certeza que deseja deletar? ") == true){

                if(classe !== "diario"){
                    var url = '/api/'+classe+'/'+id+'?ativo=0';
                    //alert(url);
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
                }
                
            }
            else{
                alert("Cancelado");
            }
        },
        limparModal(){
            this.modelObjetos= [];
        },
        mostrarConteinerObjeto(classe){
            if(classe !== ''){
                this.carregarObjeto(classe);
            }
        }
    }
    }).mount('#app')