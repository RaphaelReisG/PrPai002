 //cards

    Vue.component('card_01', {
        props: ['titulocard', 'urlg', 'usuario', 'parametro', 'valorjson'],
        mounted: function(){
            //alert(this.titulo);

            var url =  '/api/'+this.urlg+'/?id='+this.usuario;

            axios
                .get(url)
                    .then(response => (
                        this.valorjson = response.data[this.parametro]
                    ))
                    .catch(error => (this.error = error));
                    //alert(this.valor1);
        },
        template: `
            <div class="card border-secondary mb-3" style="max-width: 10rem;">
                <div class="card-header">
                    <slot name="icone"></slot>
                    {{titulocard}}
                </div>
                <div class="card-body">
                    <p class="card-text" style="text-align: center;">{{valorjson}}</p>
                </div>
            </div>
        `
    });

    Vue.component('card_02', {
        props: ['titulocard','valorjson', 'descricao'],
        template: `
            <div class="card border-secondary mb-3" style="max-width: 6rem;" :title="descricao">
                <div class="card-body" style="padding: 3px;">
                    <p class="card-text" style="text-align: center;"><slot name="icone"></slot>{{titulocard}} {{valorjson}}</p>
                </div>
            </div>
        `
    });

    Vue.component('graf_line_01', {
        props: ['titulo', 'c1', 'c2', 'graficoid'],
        mounted: function(){
            //alert(this.titulo);
            var coluna1 = this.c1;
            var coluna2 = this.c2;

            const ctx = document.getElementById(this.graficoid);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: coluna1,
                    datasets: [{
                        label: this.titulo,
                        data: coluna2,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        template: `
            <div style="max-width: 300px; margin-top: 20px;">
                <canvas :id="graficoid"></canvas>
            </div>
        `
    });

    Vue.component('graf_donut_01', {
        props: ['titulo', 'c1', 'c2', 'graficoid'],
        mounted: function(){
            //alert(this.titulo);
            var coluna1 = this.c1;
            var coluna2 = this.c2;

            const ctx = document.getElementById(this.graficoid);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: coluna1,
                    datasets: [{
                        label: this.titulo,
                        data: coluna2,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        },
        template: `
            <div style="max-width: 300px; margin-top: 20px;">
                <p>{{titulo}}</p>
                <canvas :id="graficoid"></canvas>
            </div>
        `
    });

//-------
//icones
Vue.component('icone_add_pessoa', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
        </svg>
    `
});

Vue.component('icone_imagem', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
        </svg>
    `
});

Vue.component('icone_add_produto', {
    props: ['texto'],

    template: `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
    `
});

Vue.component('icone_administrador', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
        </svg>
    `
});

Vue.component('icone_alterar', {
    props: ['texto'],

    template: `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
    `
});

Vue.component('icone_aprovacao', {
    props: ['texto'],

    template: `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
    `
});

Vue.component('icone_busca', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    `
});

Vue.component('icone_cliente', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
        </svg>
    `
});

Vue.component('icone_deletar', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
        </svg>
    `
});

Vue.component('icone_entrega', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
    `
});

Vue.component('icone_fornecedor', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
            <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z"/>
            <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z"/>
        </svg>
    `
});

Vue.component('icone_imprimir', {
    props: ['texto'],

    template: `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
    `
});

Vue.component('icone_pagamento', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
            <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
        </svg>
    `
});

Vue.component('icone_pedido', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
        </svg>
    `
});

Vue.component('icone_pedido_aberto', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dropbox" viewBox="0 0 16 16">
            <path d="M8.01 4.555 4.005 7.11 8.01 9.665 4.005 12.22 0 9.651l4.005-2.555L0 4.555 4.005 2 8.01 4.555Zm-4.026 8.487 4.006-2.555 4.005 2.555-4.005 2.555-4.006-2.555Zm4.026-3.39 4.005-2.556L8.01 4.555 11.995 2 16 4.555 11.995 7.11 16 9.665l-4.005 2.555L8.01 9.651Z"/>
        </svg>
    `
});

Vue.component('icone_pedido_aprovado', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
        </svg>
    `
});

Vue.component('icone_pessoa', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
        </svg>
    `
});

Vue.component('icone_preencher', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
        </svg>
    `
});

Vue.component('icone_produto', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
        </svg>
    `
});

Vue.component('icone_vendedor', {
    props: ['texto'],

    template: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
        </svg>
    `
});
//------

// paaginação

Vue.component('paginacao', {
    template: `
            <div>
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item" v-if="$root.objetos['current_page'] > 1">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['first_page_url'])">Primeiro</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Primeiro</a>
                        </li>
                        <li class="page-item" v-if="$root.objetos['current_page'] > 1" >
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['prev_page_url'])">&laquo; Anterior</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#" tabindex="-1">&laquo; Anterior</a>
                        </li>
                        <li class="page-item" v-if="$root.objetos['current_page'] > 2">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['links'][$root.objetos['current_page'] - 2]['url'])">{{$root.objetos['current_page'] - 2}}</a>
                        </li>
                        <li class="page-item" v-if="$root.objetos['current_page'] > 1">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['links'][$root.objetos['current_page'] - 1]['url'])">{{$root.objetos['current_page'] - 1}}</a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link"  href="#">{{$root.objetos['current_page']}} <span class="sr-only"></span></a>
                        </li>

                        <li class="page-item" v-if="($root.objetos['current_page'] + 1) <= $root.objetos['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['links'][$root.objetos['current_page'] + 1]['url'])">{{$root.objetos['current_page'] + 1}}</a>
                        </li>
                        <li class="page-item" v-if="($root.objetos['current_page'] + 2) <= $root.objetos['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['links'][$root.objetos['current_page'] + 2]['url'])">{{$root.objetos['current_page'] + 2}}</a>
                        </li>

                        <li class="page-item" v-if="($root.objetos['current_page'] + 1) <= $root.objetos['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['next_page_url'])">Próximo &raquo;</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Próximo &raquo;</a>
                        </li>
                        <li class="page-item" v-if="($root.objetos['current_page'] + 1) <= $root.objetos['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao($root.objetos['last_page_url'])">Ultimo</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Ultimo</a>
                        </li>
                    </ul>
                </nav>
                <p>Maximo por Pagina: {{$root.objetos['per_page']}} | Total: {{$root.objetos['total']}}</p>
            </div>
        `
});

Vue.component('paginacao_produto', {
    template: `
            <div>
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item" v-if="$root.meuProduto['current_page'] > 1">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['first_page_url'])">Primeiro</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Primeiro</a>
                        </li>
                        <li class="page-item" v-if="$root.meuProduto['current_page'] > 1" >
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['prev_page_url'])">&laquo; Anterior</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#" tabindex="-1">&laquo; Anterior</a>
                        </li>
                        <li class="page-item" v-if="$root.meuProduto['current_page'] > 2">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['links'][$root.meuProduto['current_page'] - 2]['url'])">{{$root.meuProduto['current_page'] - 2}}</a>
                        </li>
                        <li class="page-item" v-if="$root.meuProduto['current_page'] > 1">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['links'][$root.meuProduto['current_page'] - 1]['url'])">{{$root.meuProduto['current_page'] - 1}}</a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link"  href="#">{{$root.meuProduto['current_page']}} <span class="sr-only"></span></a>
                        </li>

                        <li class="page-item" v-if="($root.meuProduto['current_page'] + 1) <= $root.meuProduto['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['links'][$root.meuProduto['current_page'] + 1]['url'])">{{$root.meuProduto['current_page'] + 1}}</a>
                        </li>
                        <li class="page-item" v-if="($root.meuProduto['current_page'] + 2) <= $root.meuProduto['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['links'][$root.meuProduto['current_page'] + 2]['url'])">{{$root.meuProduto['current_page'] + 2}}</a>
                        </li>

                        <li class="page-item" v-if="($root.meuProduto['current_page'] + 1) <= $root.meuProduto['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['next_page_url'])">Próximo &raquo;</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Próximo &raquo;</a>
                        </li>
                        <li class="page-item" v-if="($root.meuProduto['current_page'] + 1) <= $root.meuProduto['last_page']">
                            <a class="page-link" href="#" v-on:click="$root.paginacao_produto($root.meuProduto['last_page_url'])">Ultimo</a>
                        </li>
                        <li class="page-item disabled" v-else>
                            <a class="page-link" href="#">Ultimo</a>
                        </li>
                    </ul>
                </nav>
                <p>Maximo por Pagina: {{$root.meuProduto['per_page']}} | Total: {{$root.meuProduto['total']}}</p>
            </div>
        `
});

// -------
//menu superior
Vue.component('menu_titulo', {
    props: ['nome_titulo'],
    template: `
        <a class="navbar-brand" href="/">{{nome_titulo}}</a>

    `
});

Vue.component('menu_item', {
    props: ['label', 'classe', 'titulo'],
    template: `
        <a class="nav-link" v-on:click="$root.defineClasse(classe, titulo)" aria-current="page" href="#">{{label}}</a>
    `
});

Vue.component('menu_dropdown_item', {
    props: ['label', 'classe', 'titulo'],
    template: `
        <li><a class="dropdown-item" href="#" v-on:click="$root.defineClasse(classe, titulo)">{{label}}</a></li>
    `
});

//---------
//modals

Vue.component('modal_header', {
    template: `
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$root.acaoObjeto}} {{$root.titulo}}</h1>
        </div>
    `
});

Vue.component('modal_erro', {
    template: `
        <div>
            <div class="modal-body">
                <p>ALERTA ERRO! O seguinte erro foi encontrado ao realizar a operação:</p>
                <p>Código: {{$root.error.code}}</p>
                <p>Mensagem: {{$root.error.message}}</p>
                <p>Mensagem Especifica: {{$root.error.response.data.message}}</p>
                <p>Status code: {{$root.error.response.status}}</p>
                <p>{{$root.error}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="$root.modalErro = false">OK</button>
            </div>
        </div>
    `
});

Vue.component('modal_sucesso', {
    template: `
        <div>
            <div class="modal-body">
                Operação realizada com sucesso!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="$root.modalSucesso = false">OK</button>
            </div>
        </div>
    `
});

//--------
//entrada de forms

Vue.component('input_geral', {
    props: ['nome_model', 'tipo', 'nome'],
    template: `
        <div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input :type="tipo" class="form-control" id="floatingInput"  v-model="$root.modelObjetos[0][nome_model]" required>
                    <label for="floatingInput">{{nome}}</label>
                </div>
            </div>
            <div class="row" v-if="$root.alertaCampo[0][nome_model] !== ''">
                <span class="alert alert-danger" role="alert" > {{$root.alertaCampo[0][nome_model]}} </span>
            </div>
        </div>
        `
});
Vue.component('input_geral2', {
    props: ['nome_model', 'tipo', 'nome'],
    template: `
        <div>
            <div class="row">
                <div class="form-floating mb-3">
                    <input :type="tipo" class="form-control" id="floatingInput"  v-model="$root.modelObjetos[0][nome_model]" required>
                    <label for="floatingInput">{{nome}}</label>
                </div>
            </div>
        </div>
        `
});

Vue.component('select_geral', {
    props: ['nome_model', 'obj_dropdown', 'nome_atributo', 'nome', 'id_atributo'],
    template: `
        <div>
            <div class="row">
                <div class="form-floating mb-3">
                    <select id="floatingInput" class="form-select" aria-label="Selecione" v-model="$root.modelObjetos[0][nome_model]" required>
                        <option v-for="(obj, index) in obj_dropdown" v-bind:value="obj_dropdown[index][id_atributo]" > {{obj_dropdown[index][nome_atributo]}}</option>
                    </select>
                    <label for="floatingInput">{{nome}}</label>
                </div>
            </div>
            <div class="row" v-if="$root.alertaCampo[0][nome_model] !== ''">
                <span class="alert alert-danger" role="alert" > {{$root.alertaCampo[0][nome_model]}} </span>
            </div>
        </div>
        `
});

Vue.component('select_define', {
    props: ['nome_model', 'obj_dropdown', 'nome_atributo', 'nome', 'id_atributo', 'chamaFuncao'],
    template: `
        <div>
            <div class="row">
                <div class="form-floating mb-3">
                    <select id="floatingInput" class="form-select" aria-label="Selecione" v-model="$root.modelObjetos[0][nome_model]" v-on:change="$root[chamaFuncao]" required>
                        <option v-for="(obj, index) in obj_dropdown" v-bind:value="obj_dropdown[index][id_atributo]" > {{obj_dropdown[index][nome_atributo]}}</option>
                    </select>
                    <label for="floatingInput">{{nome}}</label>
                </div>
            </div>
            <div class="row" v-if="$root.alertaCampo[0][nome_model] !== ''">
                <span class="alert alert-danger" role="alert" > {{$root.alertaCampo[0][nome_model]}} </span>
            </div>
        </div>
        `
});

Vue.component('textarea_geral', {
    props: ['nome_model', 'nome'],
    template: `
        <div>
            <div class="row">
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Escreva" id="floatingTextarea" v-model="$root.modelObjetos[0][nome_model]"></textarea>
                    <label for="floatingTextarea">{{nome}}</label>
                </div>
            </div>
            <div class="row" v-if="$root.alertaCampo[0][nome_model] !== ''">
                <span class="alert alert-danger" role="alert" > {{$root.alertaCampo[0][nome_model]}} </span>
            </div>
        </div>
        `
});

Vue.component('senha_geral', {
    props: ['nome_model', 'nome'],
    template: `
        <div>
            <div class="row">
                <div class="input-group mb-3">
                    <input :placeholder="nome" :aria-label="nome" :type="$root.mostrarSenha" class="form-control"   v-model="$root.modelObjetos[0][nome_model]" aria-describedby="button-addon3" required>
                    <button v-if="$root.mostrarSenha == 'password'" v-on:click="$root.mostrarSenha = 'text'" class="btn btn-outline-secondary" type="button" id="button-addon3">Mostrar {{nome}}</button>
                    <button v-else v-on:click="$root.mostrarSenha = 'password'" class="btn btn-outline-secondary" type="button" id="button-addon3">Esconder {{nome}}</button>
                </div>
            </div>
            <div class="row" v-if="$root.alertaCampo[0][nome_model] !== ''">
                <span class="alert alert-danger" role="alert" > {{$root.alertaCampo[0][nome_model]}} </span>
            </div>
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
                <tbody class="table-group-divider" >
                    <tr v-for="(obj, index) in objeto_imp">
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
    props: ['classe_atributos', 'objeto_imp'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    <tr v-for="(obj, index) in objeto_imp">
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

Vue.component('table_comum_sem_opcoes', {
    props: ['classe_atributos', 'objeto_imp'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    <tr v-for="(obj, index) in objeto_imp">
                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo2 == null ">
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
                    </tr>
                </tbody>
            </table>
        `
});

Vue.component('table_comum_busca_produtos', {
    props: ['classe_atributos', 'objeto_imp'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Opções</th>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    <tr v-for="(obj, index) in objeto_imp">
                        <td>
                            <div class="row">
                                <div class="col">
                                    <button_add_produto :objindex="index"></button_add_produto>
                                </div>
                                <div class="col">
                                    <div v-if="obj['image_name'] !== null && obj['image_name'] !== ''  ">
                                        <div class="tooltip2">
                                            <icone_imagem></icone_imagem>
                                            <div style="max-width: 200px;" class="tooltiptext2">
                                                <img :src="'storage/'+obj['image_name']" alt="Imagem" width="200" height="200" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td v-for="valor in classe_atributos">

                            <div v-if="valor.conteudo2 == null ">
                                {{ obj[valor.conteudo]  }}
                            </div>
                            <div v-else-if="valor.conteudo2 != null && valor.conteudo3 == null">
                                {{ obj[valor.conteudo][valor.conteudo2]  }}
                            </div>
                            <div v-else-if="valor.conteudo3 != null">
                                {{ obj[valor.conteudo][valor.conteudo2][valor.conteudo3]  }}
                            </div>
                            <div v-else>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        `
});

Vue.component('table_comum_meu_carrinho', {
    props: ['classe_atributos', 'objeto_imp'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Opções</th>
                        <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" >
                    <tr v-for="(obj, index) in objeto_imp">
                        <td>
                            <button_remover_produto :objindex="index"></button_remover_produto>
                        </td>
                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo2 == null && valor.conteudo !== 'qty_item'">
                                {{ obj[valor.conteudo]  }}
                            </div>
                            <div v-if="valor.conteudo == 'qty_item' ">
                                <input
                                    style="max-width: 80px;"
                                    type="number"
                                    class="form-control"
                                    v-model="$root.meuCarrinho[index]['qty_item']"
                                    min="1"
                                    v-on:change="$root.atualizaTotalItem(index)"
                                >
                            </div>
                            <div v-else-if="valor.conteudo2 != null && valor.conteudo3 == null">
                                {{ obj[valor.conteudo][valor.conteudo2]  }}
                            </div>
                            <div v-else-if="valor.conteudo3 != null">
                                {{ obj[valor.conteudo][valor.conteudo2][valor.conteudo3]  }}
                            </div>
                            <div v-else>
                            </div>
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
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
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
                                        <div v-if="acord.conteudo !== 'created_at' && acord.conteudo !== 'image_name' && acord.conteudo !== 'dtEntrada' && acord.conteudo !== 'dtSaida' && acord.conteudo2 == null ">
                                            {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        </div>
                                        <div v-else-if="acord.conteudo === 'image_name' && obj[acord.conteudo] != null && obj[acord.conteudo] != ''">
                                            imagem do Produto:
                                            <div  style="max-width: 200px;">
                                                <img :src="'storage/'+obj[acord.conteudo]" alt="Imagem" width="200" height="200" >
                                            </div>
                                            <div v-else>
                                                ---
                                            </div>
                                        </div>
                                        <div v-else-if="acord.conteudo2 != null && acord.conteudo3 == null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo3 != null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2][acord.conteudo3]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo === 'created_at' || acord.conteudo === 'dtEntrada' || acord.conteudo === 'dtSaida' ">
                                            {{acord.titulo }}: {{ new Date(obj[acord.conteudo]).toLocaleString() }}
                                        </div>
                                        <div v-else>

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

Vue.component('table_acordion_estoque', {
    props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
                                {{atributo.titulo }}
                            </div>
                        </th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp['data']">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample' + obj.id"  aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">

                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo2 == null ">
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
                        <td v-if="obj['estoqueable_id'] == $root.idUsuario && obj['estoqueable']['name'] == $root.nomeUsuario">
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                        <td v-else>
                            <p>Somente o proprietario pode alterar</p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <div class="collapse" v-bind:id="'collapseExample' + obj.id" >
                                <div class="card card-body">
                                    <div v-for="acord in obj_acordion">
                                        <div v-if="acord.conteudo !== 'created_at' && acord.conteudo2 == null ">
                                            {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        </div>
                                        <div v-else-if="acord.conteudo != 'estoqueable' && acord.conteudo2 != null && acord.conteudo3 == null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo3 != null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2][acord.conteudo3]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo === 'estoqueable' && acord.conteudo2 != null && acord.conteudo3 == null">
                                            <div v-if="obj[acord.conteudo][acord.conteudo2]">
                                                {{acord.titulo}}: Administrador {{ obj[acord.conteudo][acord.conteudo2]  }}
                                            </div>
                                            <div v-else>
                                                {{acord.titulo}}: Pedido nº {{ obj['estoqueable']['id']  }}
                                            </div>
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

Vue.component('table_acordion_cliente_restricao', {
    props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
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
                        <td v-if="obj['vendedor_id'] == $root.idUsuario">
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                        <td v-else>
                            <p>Sem permissão</p>
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

Vue.component('table_acordion_endereco_restricao', {
    props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
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
                        <td v-if="obj['enderecoable']['vendedor_id'] == $root.idUsuario">
                            <button_alter :objindex="index"></button_alter>
                            <button_delete :objid= "obj.id"></button_delete>
                        </td>
                        <td v-else>
                            <p>Sem permissão</p>
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

Vue.component('table_acordion_pedidos', {
    props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
                                {{atributo.titulo }}
                            </div>
                        </th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp['data']">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample' + obj.id"  aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">

                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo !== 'approval_date' && valor.conteudo !== 'delivery_date' && valor.conteudo !== 'payday' && valor.conteudo2 == null ">
                                {{ obj[valor.conteudo]  }}
                            </div>
                            <div v-else-if="valor.conteudo2 != null && valor.conteudo3 == null">
                                {{ obj[valor.conteudo][valor.conteudo2]  }}
                            </div>
                            <div v-else-if="valor.conteudo3 != null">
                                {{ obj[valor.conteudo][valor.conteudo2][valor.conteudo3]  }}
                            </div>
                            <div v-else>
                                <div v-if=" obj[valor.conteudo] == null">
                                    <div v-if=" valor.conteudo == 'approval_date' && valor.conteudo !== 'delivery_date' && valor.conteudo !== 'payday'">
                                        <button_aprovacao :objid="obj.id"></button_aprovacao>
                                    </div>
                                    <div v-else-if=" valor.conteudo == 'delivery_date' && obj['approval_date'] !== null">
                                        <button_entrega :objid="obj.id"></button_entrega>
                                    </div>
                                    <div v-else-if=" valor.conteudo == 'payday' && obj['approval_date'] !== null">
                                        <button_pagamento :objid="obj.id"></button_pagamento>
                                    </div>
                                    <div v-else>
                                        Pendente
                                    </div>
                                </div>
                                <div v-else>
                                    {{ new Date(obj[valor.conteudo]).toLocaleString() }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div v-if="obj['approval_date'] !== null">
                                <button_delete :objid= "obj.id"></button_delete>
                                <button_imprimir :objid= "obj.id"></button_imprimir>
                            </div>
                            <div v-else>
                                <button_alter :objindex="index"></button_alter>
                                <button_delete :objid= "obj.id"></button_delete>
                                <button_imprimir :objid= "obj.id"></button_imprimir>
                            </div>

                        </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <div class="collapse" v-bind:id="'collapseExample' + obj.id" >
                                <div class="card card-body">
                                    <div v-for="acord in obj_acordion">
                                        <div v-if="acord.conteudo !== 'created_at' && acord.conteudo !== 'approval_date' && acord.conteudo !== 'delivery_date' && acord.conteudo !== 'payday' && acord.conteudo2 == null ">
                                            {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        </div>
                                        <div v-else-if="acord.conteudo2 != null && acord.conteudo3 == null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo3 != null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2][acord.conteudo3]  }}
                                        </div>
                                        <div v-else>
                                            <div v-if=" obj[acord.conteudo] == null">
                                                Pendente
                                            </div>
                                            <div v-else>
                                                {{acord.titulo }}: {{ new Date(obj[acord.conteudo]).toLocaleString() }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Itens do pedido</h5>
                                    <div v-for="item in objeto_imp['data'][index]['produtos']">
                                        nome: {{item.name}} marca: {{item.marca.name}} qtd: {{item.pivot.qty_item}} preço R$ {{item.pivot.price_item}} estoque
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
});

Vue.component('table_acordion_pedidos_restrito', {
    props: ['classe_atributos', 'objeto_imp', 'obj_acordion'],
    template: `
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" v-for="atributo in classe_atributos" >
                            <div style="cursor: pointer;" v-on:click="$root.modelObjetos[0]['ordenacaoBusca'] = atributo.ordenacao, $root.buscarObjetos() ">
                                {{atributo.titulo }}
                            </div>
                        </th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp['data']">
                    <tr data-bs-toggle="collapse" v-bind:data-bs-target="'#collapseExample' + obj.id"  aria-expanded="false" v-bind:aria-controls="'collapseExample'+obj.id" aria-controls="collapseExample">
                        <td v-for="valor in classe_atributos">
                            <div v-if="valor.conteudo !== 'created_at' && valor.conteudo !== 'approval_date' && valor.conteudo !== 'delivery_date' && valor.conteudo !== 'payday' && valor.conteudo2 == null ">
                                {{ obj[valor.conteudo]  }}
                            </div>
                            <div v-else-if="valor.conteudo2 != null && valor.conteudo3 == null">
                                {{ obj[valor.conteudo][valor.conteudo2]  }}
                            </div>
                            <div v-else-if="valor.conteudo3 != null">
                                {{ obj[valor.conteudo][valor.conteudo2][valor.conteudo3]  }}
                            </div>
                            <div v-else>
                                <div v-if=" obj[valor.conteudo] == null">
                                    Pendente
                                </div>
                                <div v-else>
                                    {{ new Date(obj[valor.conteudo]).toLocaleString() }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div v-if="obj['approval_date'] !== null">
                                <button_imprimir :objid= "obj.id"></button_imprimir>
                            </div>
                            <div v-else>
                                <button_alter :objindex="index"></button_alter>
                                <button_delete :objid= "obj.id"></button_delete>
                                <button_imprimir :objid= "obj.id"></button_imprimir>
                            </div>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12">
                            <div class="collapse" v-bind:id="'collapseExample' + obj.id" >
                                <div class="card card-body">
                                    <div v-for="acord in obj_acordion">
                                        <div v-if="acord.conteudo !== 'created_at' && acord.conteudo !== 'approval_date' && acord.conteudo !== 'delivery_date' && acord.conteudo !== 'payday' && acord.conteudo2 == null ">
                                            {{acord.titulo}}: {{obj[acord.conteudo] }}
                                        </div>
                                        <div v-else-if="acord.conteudo2 != null && acord.conteudo3 == null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2]  }}
                                        </div>
                                        <div v-else-if="acord.conteudo3 != null">
                                            {{acord.titulo}}: {{ obj[acord.conteudo][acord.conteudo2][acord.conteudo3]  }}
                                        </div>
                                        <div v-else>
                                            <div v-if=" obj[acord.conteudo] == null">
                                                {{acord.titulo}}: Pendente
                                            </div>
                                            <div v-else>
                                                {{acord.titulo }}: {{ new Date(obj[acord.conteudo]).toLocaleString() }}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Itens do pedido</h5>
                                    <div v-for="item in objeto_imp['data'][index]['produtos']">
                                        nome: {{item.name}} marca: {{item.marca.name}} qtd: {{item.pivot.qty_item}} preço R$ {{item.pivot.price_item}}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        `
});

Vue.component('table_acordion2', {
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
                    </tr>
                </thead>
                <tbody class="table-group-divider" v-for="(obj, index) in objeto_imp">
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

Vue.component('table_comum_top', {
    props: ['classe_atributos', 'titulo', 'valorjson'],
    template: `
            <div>
                <h5>{{titulo}}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" v-for="atributo in classe_atributos">{{atributo.titulo}}</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" >
                        <tr v-for="(obj, index) in valorjson">
                            <td>{{ index+1 }}</td>
                            <td v-for="valor in classe_atributos">{{ obj[valor.conteudo] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
});

// ----------
// Meus dados

//----------


// Botoes --------------------------------------------------------------

Vue.component('button_alter', {
    props: ['objindex'],
    template: `
        <button type="button" class="btn btn-outline-warning" v-on:click="$root.carregaCamposEditarObjeto($root.nomeObjeto, objindex) , $root.acaoObjeto = 'Alterar'"  data-bs-toggle="modal" data-bs-target="#modalObjeto">
            <icone_alterar></icone_alterar>
        </button>
    `
});

Vue.component('button_imprimir', {
    props: ['objid'],
    template: `
        <button type="button" class="btn btn-outline-primary" v-on:click="$root.imprimePedido(objid)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
        </button>
    `
});

Vue.component('button_add_produto', {
    props: ['objindex'],
    template: `
        <button type="button" class="btn btn-outline-success" v-on:click="$root.addProdutoCarrinho(objindex)" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
        </button>
    `
});

Vue.component('button_alter_meus_dados', {
    template: `
        <button type="button" class="btn btn-outline-warning" v-on:click="$root.carregaCamposEditarObjeto($root.nomeObjeto, 'meusDados') , $root.acaoObjeto = 'Alterar'"  data-bs-toggle="modal" data-bs-target="#modalObjeto">
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

Vue.component('button_aprovacao', {
    props: ['objid'],
    template: `
        <button type="button" class="btn btn-outline-success" v-on:click="$root.aprovarPedido(objid)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
            </svg>
        </button>
    `
});

Vue.component('button_entrega', {
    props: ['objid'],
    template: `
        <button type="button" class="btn btn-outline-success" v-on:click="$root.confirmarEntrega(objid)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
        </button>
    `
});

Vue.component('button_pagamento', {
    props: ['objid'],
    template: `
        <button type="button" class="btn btn-outline-success" v-on:click="$root.confirmarPagamento(objid)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
            </svg>
        </button>
    `
});

Vue.component('button_remover_produto', {
    props: ['objindex'],
    template: `
        <button type="button" class="btn btn-outline-danger" v-on:click="$root.removerProdutoCarrinho(objindex)">
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
        <button type="submit" class="btn btn-primary" v-on:click="$root.escolheAcaoObjeto($root.acaoObjeto, $root.nomeObjeto)">
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

Vue.component('button_buscar_produto', {
    template: `
        <div class="input-group mb-3">
                <input style="max-width: 300px;" type="text" class="form-control" v-model="$root.modelObjetos[0]['buscarObjetoProduto']" aria-describedby="button-addon4">
                <button class="btn btn-outline-secondary" type="button" id="button-addon4" v-on:click="$root.buscarMeuProduto()">
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

