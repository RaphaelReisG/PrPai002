// paaginação





// -------
//entrada de forms

    Vue.component('input_geral', {
        props: ['nome_model', 'tipo', 'nome'],
        template: `
        <div class="form-floating mb-3">
            <input :type="tipo" class="form-control" id="floatingInput"  v-model="$root.modelObjetos[0][nome_model]">
            <label for="floatingInput">{{nome}}</label>
        </div>
        `
    });

    Vue.component('select_geral', {
        props: ['nome_model','obj_dropdown', 'nome_atributo', 'nome'],
        template: `
            <div class="form-floating mb-3">
                <select id="floatingInput" class="form-select" aria-label="Selecione" v-model="$root.modelObjetos[0][nome_model]">
                    <option v-for="(obj, index) in obj_dropdown" v-bind:value="obj_dropdown[index][nome_atributo]" > {{obj_dropdown[index][nome_atributo]}}</option>
                </select>
                <label for="floatingInput">{{nome}}</label>
            </div>
        `
    });

    Vue.component('textarea_geral', {
        props: ['nome_model', 'nome'],
        template: `
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Escreva" id="floatingTextarea" v-model="$root.modelObjetos[0][nome_model]"></textarea>
                <label for="floatingTextarea">{{nome}}</label>
            </div>
        `
    });

    Vue.component('senha_geral', {
        props: ['nome_model', 'nome'],
        template: `
            <div class="input-group mb-3">
                <input :placeholder="nome" :aria-label="nome" :type="$root.mostrarSenha" class="form-control"   v-model="$root.modelObjetos[0][nome_model]" aria-describedby="button-addon3">
                <button v-if="$root.mostrarSenha == 'password'" v-on:click="$root.mostrarSenha = 'text'" class="btn btn-outline-secondary" type="button" id="button-addon3">Mostrar {{nome}}</button>
                <button v-else v-on:click="$root.mostrarSenha = 'password'" class="btn btn-outline-secondary" type="button" id="button-addon3">Esconder {{nome}}</button>
            </div>


        `
    });


//-------
// Tabelas -----------------------------------------------------------------

    Vue.component('table_config', {
        props: ['classe_atributos', 'objeto_imp'],
        template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample'+obj.id" data-bs-target="#collapseExample" aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">
                        <td v-for="valor in classe_atributos">{{ obj[valor.conteudo] }}</td>
                        <td v-if="obj.user_id == $root.idUsuario">
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                        <td v-else>
                            <p>Configuração pré definida do sistema</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
    });

    Vue.component('table_comum', {
        props: ['classe_atributos','objeto_imp'],
        template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample'+obj.id" data-bs-target="#collapseExample" aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">
                        <td>{{ index+1 }}</td>
                        <td v-for="valor in classe_atributos">{{ obj[valor.conteudo] }}</td>
                        <td>
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
    });

    Vue.component('table_acordion', {
        props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
        template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.conteudo, $root.buscarObjetos() ">
                                {{atributo.titulo }}
                            </div>
                        </th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp['data']">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample' + obj.id"  aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">

                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo !== 'dtEntrada' && valor.conteudo !== 'dtSaida' && valor.conteudo2 == null ">
                                {{ obj[valor.conteudo]  }}
                            </div>
                            <div v-else-if="valor.conteudo2 != null && valor.conteudo3 == null">
                                {{ obj[valor.conteudo][valor.conteudo2]  }}
                            </div>
                            <div v-else-if="valor.conteudo3 != null">
                                {{ obj[valor.conteudo][valor.conteudo2][valor.conteudo3]  }}
                            </div>
                            <div v-else>
                                {{ new Date(obj[valor.conteudo]).toLocaleString() }}
                            </div>
                        </td>
                        <td>
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <div class="collapse" v-bind:id="'collapseExample' + obj.id" >
                                <div class="card card-body">
                                    <div v-for="acord in obj_acordion">


                                        <div v-if="acord.conteudo !== 'created_at' && acord.conteudo !== 'dtEntrada' && acord.conteudo !== 'dtSaida' && acord.conteudo2 == null ">
                                            {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        </div>
                                        <div v-else-if="acord.conteudo2 != null && acord.conteudo3 == null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo3 != null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2][acord.conteudo3]  }}
                                        </div>
                                        <div v-else>
                                            {{acord.titulo }}: {{ new Date(obj[acord.conteudo]).toLocaleString() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
    });

    Vue.component('table_acordion_api', {
        props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
        template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp" style="font-size: 15px;">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample' + obj.orderId"  aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">

                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo !== 'dtEntrada' && valor.conteudo !== 'dtSaida' && valor.conteudo !== 'time' ">
                                {{ obj[valor.conteudo]  }}

                            </div>
                            <div v-else>
                                {{ new Date(obj[valor.conteudo]).toLocaleString() }}
                            </div>
                        </td>
                        <td>
                            <button_preencher :objindex="index"></button_preencher>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <div class="collapse" v-bind:id="'collapseExample' + obj.orderId" >
                                <div class="card card-body">
                                    <div v-for="acord in obj_acordion">
                                        {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
    });




// Botoes --------------------------------------------------------------

Vue.component('button_alter', {
    props: ['objindex'],
    template: `
        <button type="button" class="btn btn-outline-warning" v-on:click="$root.carregaCamposEditarObjeto($root.nomeObjeto, objindex) , $root.acaoObjeto = 'Alterar'"  data-bs-toggle="modal" data-bs-target="#modalObjeto">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
        </button>
    `
});

Vue.component('button_delete', {
    props: ['objid'],
    template: `
        <button type="button" class="btn btn-outline-danger" v-on:click="$root.desativarObjeto($root.nomeObjeto, objid)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
            </svg>
        </button>
    `
});

Vue.component('button_cancelar_modal', {
    props: ['rotulo'],
    template: `
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="$root.limparModal()">{{rotulo}}</button>
    `
});

Vue.component('button_acao', {
    template: `
        <button type="button" class="btn btn-primary" v-on:click="$root.escolheAcaoObjeto($root.acaoObjeto, $root.nomeObjeto)">
            <span v-if="$root.carregando == true" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>
            {{$root.acaoObjeto}}
        </button>
    `
});

Vue.component('button_add', {
    template: `
        <button v-on:click=" $root.limparModal(), $root.acaoObjeto = 'Criar'" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalObjeto" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            Add
        </button>
    `
});

Vue.component('button_buscar', {
    template: `
        <div class="input-group mb-3">
                <input style="max-width: 300px;" type="text" class="form-control" v-model="$root.modelObjetos[0]['buscarObjeto']" aria-describedby="button-addon4">
                <button class="btn btn-outline-secondary" type="button" id="button-addon4" v-on:click="$root.buscarObjetos()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    Buscar
                </button>
        </div>
    `
});

Vue.component('button_preencher', {
    props: ['objindex'],
    template: `
        <button type="button" class="btn btn-outline-secondary" v-on:click="$root.carregaCamposEditarObjeto($root.nomeObjeto, objindex), $root.buscaApi = false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
            </svg>
        </button>
    `
});

//------


// FIm -------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------

