@extends("layouts/layout")

@section('title', 'Vendas')
@section('local', $action=='edit' ? 'Alterar venda':'Novo venda')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/criar.css?v=' . localtime()[0]) }}">
    <link rel="stylesheet" href="{{ asset('css/lista.css?v=' . localtime()[0]) }}">
    <style>
        .filtro-barra {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            align-items: center;
        }

        .filtro-barra button,
        .filtro-barra .filtro-tag {
            background-color: var(--vinho);
            color: var(--branco);
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .filtro-tag {
            background-color: var(--rosa);
        }

        .filtro-barra input[type="text"] {
            background-color: var(--cinza-escuro);
            border-radius: 6px;
            border: none;
            padding: 6px 10px;
            color: var(--branco);
        }

        .tabela{
            max-height: 300px;
            overflow: auto;
        }

        .tabela-produtos {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabela-produtos th,
        .tabela-produtos td {
            padding: 10px;
            text-align: left;
            color: var(--branco);
        }

        .tabela-produtos th {
            background-color: var(--vinho);
        }

        .tabela-produtos tr:nth-child(even) {
            background-color: var(--cinza-claro-transparente);
        }

        .quantidade-input {
            background-color: var(--cinza-escuro);
            color: var(--branco);
            border: none;
            border-radius: 6px;
            width: 40%;
            padding: 5px;
        }

        .quantidade-input::placeholder {

            color: #666;

        }

        .paginacao {
            text-align: center;
            margin-top: 10px;
        }

        .paginacao button {
            background-color: transparent;
            color: var(--branco);
            border: none;
            cursor: pointer;
            margin: 0 5px;
        }

        .paginacao .ativo {
            color: var(--rosa);
            font-weight: bold;
        }

        .botoes-rodape {
            position: sticky;
            bottom: 20px;
            display: flex;
            justify-content: space-between;
            background-color: var(--cinza-claro-transparente);
            padding: 15px 20px;
            border-radius: 12px;
            z-index: 10;
        }


        .botoes-rodape button {
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }


        .items-lista {
            flex-grow: 0;
        }

        .formulario {
            padding: 0px 0px;
            background: none;

        }

        .container-paginas {
            margin-top: 15px;
        }


        .venda-container {
            background-color: var(--cinza-claro-transparente);
            padding: 15px 25px;
            border-radius: 16px;

            height: calc(100vh - 130px);
        }

        .venda {
            width: 50%;
        }

        .titulo-venda {
            font-size: 20px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .formulario h3 {
            font-size: 15px;
            !important font-weight: 600;
            margin-bottom: 0px;
            color: var(--branco);
        }

        /* Informações */
        .vendedor {
            font-size: 16px;
            margin: 8px 0 0;
        }

        .subinfo {
            font-size: 10px;
            color: #aaa;
        }

        .data,
        .origem {
            font-size: 14px;
            font-weight: 400;
            margin: 8px 0 0;
        }

        /* bloco que contém nome à esquerda e data à direita */
        .info-section {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .info-bloco {
            display: flex;
            flex-direction: column;
        }

        .info-bloco.direita {
            text-align: right;

        }

        /* Produtoos */




        .linha {
            display: flex;
            justify-content: space-between;
            margin: 6px 0;
            font-size: 15px;
            font-weight: 400;
        }

        .cabecalho {
            font-weight: 500;
            border-bottom: 1px solid #888;
            padding-bottom: 6px;
            margin-bottom: 6px;
        }


        .total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 600;
        }




        .item-lista:hover {
            background-color: var(--cinza-escuro-detalhes);
        }
    </style>
@endsection

@section('content')
    <div class="cadastro-container">
        <div class="etapas">
            <div class="etapa ativa" data-step="1">
                <div class="numero">1</div>
                <div class="info">
                    <p class="dados">Carrinho</p>
                    <p class="descricao">defina os produtos vendidos aqui</p>
                </div>
            </div>
            <div class="etapa-caminho"></div>
            <div class="etapa" data-step="2">
                <div class="numero">2</div>
                <div class="info">
                    <p class="dados">Visão geral</p>
                    <p class="descricao">confirme os dados da venda</p>
                </div>
            </div>
        </div>


        <div class="formulario">
            <form action="{{ $action == 'edit' ? route('vendas.update', $venda->id) : route('vendas.store')}}"
                method="POST">
                @csrf
                @if($action == 'edit')
                    @method('PUT')
                @endif
                <div class="etapa-formulario" id="etapa-1">
                    <div class="container-lista">
                        <div class="lista">
                            <div class="pesquisa-container">
                                <div class="filtros-ativos">
                                    <div class="filtrar-todos">
                                        <button class="todos">Todos</button>
                                        <div class="blur-btn"></div>
                                    </div>
                                    <div class="filtro">
                                        <p>“Farinha”</p>
                                        <svg width="10" height="10" viewBox="0 0 9 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 8.25L8.25 0.75M0.75 0.75L8.25 8.25" stroke="white" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="pesquisa">
                                    <div class="form-pesquisa">
                                        <input type="text" placeholder="Pesquisar" class="pesquisar">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.1684 14.656L12.5501 11.1539C13.4212 10.0314 13.8915 8.66516 13.8899 7.26131C13.8899 3.67544 10.8757 0.758057 7.17091 0.758057C3.46607 0.758057 0.451904 3.67544 0.451904 7.26131C0.451904 10.8472 3.46607 13.7646 7.17091 13.7646C8.62134 13.7661 10.0329 13.3109 11.1926 12.4678L14.8109 15.9699C14.9941 16.1284 15.233 16.213 15.4786 16.2063C15.7241 16.1997 15.9578 16.1023 16.1315 15.9341C16.3052 15.766 16.4058 15.5399 16.4127 15.3022C16.4196 15.0645 16.3322 14.8333 16.1684 14.656V14.656ZM2.37162 7.26131C2.37162 6.34258 2.65309 5.44448 3.18045 4.68058C3.7078 3.91669 4.45735 3.3213 5.3343 2.96972C6.21126 2.61814 7.17623 2.52615 8.10721 2.70538C9.03818 2.88462 9.89333 3.32703 10.5645 3.97667C11.2357 4.62631 11.6928 5.454 11.878 6.35508C12.0632 7.25615 11.9681 8.19014 11.6049 9.03894C11.2416 9.88774 10.6265 10.6132 9.83725 11.1236C9.04801 11.6341 8.12012 11.9065 7.17091 11.9065C5.89853 11.905 4.6787 11.4151 3.77899 10.5443C2.87928 9.67349 2.37315 8.49283 2.37162 7.26131V7.26131Z"
                                                fill="white" />
                                        </svg>
                                    </div>

                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_55_1027)">
                                            <path d="M2.625 3.5L8.75 3.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12.25 3.5L18.375 3.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M2.625 10.5L10.5 10.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M14 10.5L18.375 10.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M2.625 17.5L7 17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M10.5 17.5L18.375 17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M8.75 0.875L8.75 6.125" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M14 7.875L14 13.125" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M7 14.875L7 20.125" stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_55_1027">
                                                <rect width="21" height="21" fill="white" transform="translate(21) rotate(90)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>

                            <!-- Cabeçalho -->
                            <div class="header-lista item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Nome</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Descrição</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Preço Unitário</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Quantidade</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Preço Total</p>
                                </div>
                            </div>

                            <div class="items-lista {{ $i=1 }}">
                                @foreach ($produtos as $item)
                                    <div class="item-lista pg-{{ ceil(($i++) / $qtdPorPg) }}" id="{{ $item->id }}" @if($item->id >= $produtos[$qtdPorPg]->id) style="display: none" @endif>
                                        <div class="campo" style="width: 25%; text-align: start;">
                                            <p>{{ $item->nome }}</p>
                                        </div>
                                        <div class="campo" style="width: 25%; text-align: start;">
                                            <p>{{ $item->descricao }}</p>
                                        </div>
                                        <div class="campo" style="width: 25%; text-align: start;">
                                            <p>R$ {{ $item->preco }}</p>
                                        </div>
                                        <div class="campo" style="width: 25%; text-align: start;">
                                            <input type="number" name="itens_venda[{{ $item->id }}][quantidade]" placeholder="0" value="{{ $item->qtdComprada }}" class="quantidade-input">
                                        </div>
                                        <div class="campo" style="width: 25%;text-align: start;">
                                            <p>R$ 0,00</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Paginação Simples -->
                            <div class="container-paginas">
                                <svg id="anterior" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 4.16659L7.16667 9.99992L13 15.8333" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <div class="paginas">
                                    @if(ceil($produtos->count()/$qtdPorPg) > 5)
                                        <div class="pg" id="goStart" style="display: none;">1 ...</div>  
                                    @endif
                                    @for ($i = 0; $i < ceil($produtos->count()/$qtdPorPg); $i++)
                                        <div class="pg @if($i == 0)pg-ativa @endif" @if($i > 4) style="display: none" @endif>{{ $i+1 }}</div>   
                                    @endfor
                                    @if(ceil($produtos->count()/$qtdPorPg) > 5)
                                        <div class="pg" id="goEnd">... {{ ceil($produtos->count()/$qtdPorPg) }}</div>  
                                    @endif
                                </div>

                                <svg id="proximo" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 4.16659L13.8333 9.99992L8 15.8333" stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                    </div>

                    <div class="botoes botoes-rodape">
                        <button type="button" class="cancelar" onclick="window.location='{{ route('vendas.index') }}'">
                            <span class="highlight">Cancelar</span>
                        </button>
                        <button type="button" class="continuar" onclick="mudarEtapa(2)">Continuar
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.28119 2.78407C7.54282 2.50948 7.96702 2.50948 8.22865 2.78407L12.2484 7.00282C12.51 7.2774 12.51 7.7226 12.2484 7.99718L8.22865 12.2159C7.96702 12.4905 7.54282 12.4905 7.28119 12.2159C7.01955 11.9413 7.01955 11.4962 7.28119 11.2216L10.8272 7.5L7.28119 3.77843C7.01955 3.50385 7.01955 3.05865 7.28119 2.78407Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.39526 7.5C2.39526 7.11167 2.69521 6.79688 3.06522 6.79688H11.2164C11.5864 6.79688 11.8863 7.11167 11.8863 7.5C11.8863 7.88833 11.5864 8.20312 11.2164 8.20312H3.06522C2.69521 8.20312 2.39526 7.88833 2.39526 7.5Z"
                                    fill="white" />
                            </svg></button>
                    </div>
                </div>

                <div class="etapa-formulario" id="etapa-2" style="display: none">
                    <div class="venda-container">
                        <div class="venda">
                            <h2 class="titulo-venda">Visão geral da venda</h2>

                            <h3 class="subtitulo">Informações sobre a venda</h3>
                            <div class="info-section">

                                <div class="info-bloco">
                                    <p class="vendedor">{{ session('user')->nome }}</p>
                                    <p class="subinfo">Funcionário responsável</p>
                                </div>
                                <div class="info-bloco direita">
                                    <p class="data">{{ date('d-m-Y') }}</p>
                                    <p class="subinfo">Dia da venda</p>
                                </div>

                            </div>

                            <div class="produtos-section">
                                <h3 class="subtitulo" style="margin:40px 0 0 0">Listagem de produtos</h3>
                                <div class="tabela">
                                    <div class="linha cabecalho">
                                        <span>Produto</span>
                                        <span>Qtd.</span>
                                    </div>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($produtos as $item)
                                        @if($item->qtdComprada > 0)
                                        @php
                                            $total+= ($item->qtdComprada * $item->preco);
                                        @endphp
                                        <div class="linha" id="item-{{ $item->id }}">
                                            <span>{{ $item->nome }}</span>
                                            <span>x{{ $item->qtdComprada }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="total">
                                <strong>TOTAL R$</strong>
                                <span>R$ {{ number_format($total, 2, ',', ''); }}</span>
                            </div>

                            <div class="botoes">
                                <button type="button" class="voltar" onclick="mudarEtapa(1)">Voltar</button>
                                <button class="continuar" type="submit">
                                    Confirmar
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6663 5L7.49967 14.1667L3.33301 10" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <script>
        let switchs = document.querySelectorAll(".switch");
        switchs.forEach(element => {
            let bola = element.querySelector(".bola")
            element.addEventListener("click", () => {
                if (bola.classList.length == 1) {
                    bola.classList = "bola input-ativo"
                    element.querySelector("input").value = "true"
                } else {
                    bola.classList = "bola"
                    element.querySelector("input").value = "false"
                }
            })
        });


        function mudarEtapa(numero) {
            document.querySelectorAll('.etapa-formulario').forEach(e => e.style.display = 'none');
            document.getElementById('etapa-' + numero).style.display = 'block';

            document.querySelectorAll('.etapas .etapa').forEach((etapa, index) => {
                etapa.classList.toggle('ativa', index + 1 <= numero);
            });

            document.querySelectorAll('.etapas .etapa-caminho').forEach((etapa, index) => {
                etapa.classList.toggle('ativa', index + 1 <= numero - 1);
            });
        }
    </script>

    
    <script>
        const container = document.querySelector(".items-lista");
        const barraPesquisa = document.querySelector(".pesquisar");
        const btnPesquisa = document.querySelector(".form-pesquisa").querySelector("svg");
        const tagFiltroTexto = document.querySelector(".filtro");
        const itensInicias = Array.from(document.querySelector(".items-lista").querySelectorAll(".item-lista"))
        const filtros = document.getElementsByClassName("filtro")

        btnPesquisa.addEventListener("click",()=>{
            pesquisar(barraPesquisa.value)
        })
        document.addEventListener("keydown",(e)=>{
            if(e.key != 'Enter' || document.activeElement != barraPesquisa) return;
            pesquisar(barraPesquisa.value)
        })

        document.querySelector('.todos').addEventListener("click",limparPesquisa)
        Array.from(filtros).forEach((filtro)=>{
            filtro.querySelector('svg').addEventListener("click",limparPesquisa)
        })

        function limparPesquisa() {
            container.innerHTML = '';

            let lastInserted = null;

            itensInicias.forEach((item, index) => {
            if (index === 0) {
                container.appendChild(item);
                lastInserted = item;
            } else {
                lastInserted.parentNode.insertBefore(item, lastInserted.nextSibling);
                lastInserted = item;
            }
            });

            Array.from(filtros).forEach((filtro)=>{
                filtro.style.display = 'none'
            })
        }

        function pesquisar(pesquisa) {
            // 0. Colocar tag de pesquisa de texto
            tagFiltroTexto.querySelector("p").textContent = '"'+pesquisa+'"'
            tagFiltroTexto.style.display = "flex";

            // 1. Encontrar os itens que tem o texto
            let itens = Array.from(container.querySelectorAll(".item-lista"));
            let resultado = itens.filter(item => item.querySelectorAll('p')[1].textContent.includes(pesquisa));
            
            // 2. Mover para o topo da div
            resultado.forEach(resultado => {         
                container.insertBefore(resultado, container.firstChild);
            });

            // 3. Atualizar as classes
            itens.forEach(item => {
                item.classList = "item-lista"
                item.style.display = "none"
            });

            itens = Array.from(container.querySelectorAll(".item-lista"));

            itens.forEach((item, index) => {
                item.classList = "item-lista pg-"+Math.ceil((index+1)/{{ $qtdPorPg }});
            });
            
            //Manda os botões de página pra volta pro começo
            botoesPg.forEach((botao,index) =>{
                botao.style.display = "none";
                if(index < 5) botao.style.display = "flex";
            });
            if(document.getElementById("goEnd")) {
                document.getElementById("goEnd").style.display = "flex"
                document.getElementById("goStart").style.display = "none"
            }

            pgAtual = 1;
            ativarPg(botoesPg[0]);
        }

        let items = document.getElementsByClassName("item-lista");
        let botoesPg = Array.from(document.getElementsByClassName("pg"));
        let maxPg = Math.ceil((items.length - 1) / {{ $qtdPorPg }});
        let pgAtual = 1;

        //Retira os botões de teleporte pro fim e começo da lista.
        if(document.getElementById("goEnd")){
            botoesPg.shift()
            botoesPg.pop()
        }

        //Atribui o poder de ativar a página selecionada
        Array.from(botoesPg).forEach(botao => {
            botao.addEventListener("click", () => {
                ativarPg(botao)
            })
        });

        function ativarPg(botao) {
            //Desativa os items já ativados
            let itemsAtual = document.getElementsByClassName("pg-" + pgAtual);
            Array.from(itemsAtual).forEach(itemAtual => {
                itemAtual.style.display = "none";
            })
            document.querySelector(".pg-ativa").classList = "pg";

            //Altera pg pgAtual
            pgAtual = botao.textContent;

            //Ativa a nova página
            let itemsNovos = document.getElementsByClassName("pg-" + pgAtual);
            Array.from(itemsNovos).forEach(itemNovo => {
                itemNovo.style.display = "flex";
            })
            botao.classList = "pg pg-ativa";
        }

        //Carregar próximas 5 páginas
        document.getElementById("proximo").addEventListener("click", proximo);
        document.getElementById("anterior").addEventListener("click", anterior);

        function proximo() {
            if (botoesPg[(Math.ceil(pgAtual / 5)) * 5]) {
                document.getElementById("goStart").style.display = "flex"

                let secao = Math.ceil(pgAtual / 5) - 1;

                for (let i = 0; i < 5; i++) {
                    botoesPg[secao * 5 + i].style.display = "none"
                    try {
                        botoesPg[(secao + 1) * 5 + i - 1].style.display = "flex"
                    } catch (e) {
                        document.getElementById("goEnd").style.display = "none"
                    }
                }

                ativarPg(botoesPg[(secao + 1) * 5])
            }
        }

        function anterior() {
            if (botoesPg[(Math.ceil(pgAtual / 5) - 1) * 5 - 1]) {
                document.getElementById("goEnd").style.display = "flex"

                let secao = Math.ceil(pgAtual / 5) - 1;

                for (let i = 0; i < 5; i++) {
                    botoesPg[(secao - 1) * 5 + i].style.display = "flex"
                    try {
                        botoesPg[secao * 5 + i].style.display = "none"
                    } catch (e) { }
                }

                if (secao - 1 == 0) document.getElementById("goStart").style.display = "none"

                ativarPg(botoesPg[(secao) * 5 - 1])
            }
        }

        //Pular pra primeira/última página
        document.getElementById("goEnd").addEventListener("click", () => {
            do {
                proximo()
            } while (document.getElementById("goEnd").style.display != "none");
            ativarPg(botoesPg[botoesPg.length - 1])
        })

        document.getElementById("goStart").addEventListener("click", () => {
            do {
                anterior()
            } while (document.getElementById("goStart").style.display != "none");
            ativarPg(botoesPg[0])
        })

        let temp = Array.from(items);
        temp.shift();

        let nota = document.querySelector(".tabela")
        temp.forEach(item => {
            item.querySelector(".quantidade-input").addEventListener("change",()=>{
                if(nota.querySelector("#item-"+item.id)){
                    nota.querySelector("#item-"+item.id).remove()
                }
                let html = `
                    <div class="linha" id="item-${item.id}">
                        <span>${item.querySelector("p").textContent}</span>
                        <span>x${item.querySelector(".quantidade-input").value}</span>
                    </div>
                `;
                if(item.querySelector(".quantidade-input").value > 0){
                    nota.innerHTML+= html;
                    let total = 0;
                    let linhas = Array.from(nota.querySelectorAll(".linha"))
                    linhas.shift();
                    linhas.forEach(linha => {
                        let precoUnitario = parseFloat(item.querySelectorAll("p")[2].textContent.replace("R$", "").trim());
                        total+= (parseInt(item.querySelector(".quantidade-input").value)*precoUnitario)
                    });
                    
                    document.querySelector(".total").children[1].textContent = "R$ "+total.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            })
        })
    </script>
@endsection