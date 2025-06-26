@extends("layouts/layout")

@section('title', 'Nova Venda')

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
            font-size: 15px; !important
            font-weight: 600;
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
.info-section{
    display:flex;
    justify-content:space-between;   
    gap:40px;                        
}

.info-bloco{
    display:flex;
    flex-direction:column;          
}

.info-bloco.direita{
    text-align:right; 
      
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
                                    <p>“Coca-Cola”</p>
                                    <svg width="10" height="10" viewBox="0 0 9 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 8.25L8.25 0.75M0.75 0.75L8.25 8.25" stroke="white"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="pesquisa">
                                <form class="form-pesquisa">
                                    <input type="text" placeholder="Pesquisar" class="pesquisar">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.1684 14.656L12.5501 11.1539C13.4212 10.0314 13.8915 8.66516 13.8899 7.26131C13.8899 3.67544 10.8757 0.758057 7.17091 0.758057C3.46607 0.758057 0.451904 3.67544 0.451904 7.26131C0.451904 10.8472 3.46607 13.7646 7.17091 13.7646C8.62134 13.7661 10.0329 13.3109 11.1926 12.4678L14.8109 15.9699"
                                            stroke="white" stroke-width="2" />
                                    </svg>
                                </form>
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

                        <div class="items-lista">
                            <div class="item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Coca-Cola 2L</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Refrigerante tradicional</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>R$ 10,00</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;"><input type="number"
                                        placeholder="0" class="quantidade-input"></input></div>
                                <div class="campo" style="width: 25%;text-align: start;">
                                    <p>R$ 20,00</p>
                                </div>
                            </div>

                            <div class="item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Coca-Cola 2L</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Refrigerante tradicional</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>R$ 10,00</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;"><input type="number"
                                        placeholder="0" class="quantidade-input"></input></div>
                                <div class="campo" style="width: 25%;text-align: start;">
                                    <p>R$ 20,00</p>
                                </div>
                            </div>

                            <div class="item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Coca-Cola 2L</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Refrigerante tradicional</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>R$ 10,00</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;"><input type="number"
                                        placeholder="0" class="quantidade-input"></input></div>
                                <div class="campo" style="width: 25%;text-align: start;">
                                    <p>R$ 20,00</p>
                                </div>
                            </div>

                            <div class="item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Coca-Cola 2L</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Refrigerante tradicional</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>R$ 10,00</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;"><input type="number"
                                        placeholder="0" class="quantidade-input"></input></div>
                                <div class="campo" style="width: 25%;text-align: start;">
                                    <p>R$ 20,00</p>
                                </div>
                            </div>



                            <div class="item-lista">
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Coca-Cola 2L</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>Refrigerante tradicional</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;">
                                    <p>R$ 10,00</p>
                                </div>
                                <div class="campo" style="width: 25%; text-align: start;"><input type="number"
                                        placeholder="0" class="quantidade-input"></input></div>
                                <div class="campo" style="width: 25%;text-align: start;">
                                    <p>R$ 20,00</p>
                                </div>
                            </div>


                        </div>

                        <!-- Paginação Simples -->
                        <div class="container-paginas">
                            <svg id="anterior" width="21" height="20" viewBox="0 0 21 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 4.16659L7.16667 9.99992L13 15.8333" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="paginas">
                                <div class="pg pg-ativa">1</div>
                                <div class="pg">2</div>
                                <div class="pg">3</div>
                                <div class="pg">...</div>
                                <div class="pg">5</div>
                            </div>
                            <svg id="proximo" width="21" height="20" viewBox="0 0 21 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 4.16659L13.8333 9.99992L8 15.8333" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
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
                        <p class="vendedor">Júlia linda maravilhosaaa</p>
                        <p class="subinfo">Funcionário responsável</p>
                        </div>
                         <div class="info-bloco direita"><p class="data">25/04/2025</p>
                        <p class="subinfo">Dia da venda</p></div>
                        
                    </div>

                    <div class="produtos-section">
                        <h3 class="subtitulo" style="margin:40px 0 0 0">Listagem de produtos</h3>
                        <div class="tabela">
                            <div class="linha cabecalho">
                                <span>Produto</span>
                                <span>Qtd.</span>
                            </div>
                            <div class="linha">
                                <span>Maçã do amor</span>
                                <span>x84</span>
                            </div>
                            <div class="linha">
                                <span>Cocada marrom</span>
                                <span>x5</span>
                            </div>
                            <div class="linha">
                                <span>Coca Zero</span>
                                <span>x25</span>
                            </div>
                        </div>
                    </div>

                    <div class="total">
                        <strong>TOTAL R$</strong>
                        <span>200,00</span>
                    </div>

               

                <div class="botoes">
                    <button type="button" class="voltar" onclick="mudarEtapa(1)">Voltar</button>
                    <button class="continuar" type="submit">
                        Confirmar
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6663 5L7.49967 14.1667L3.33301 10" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div> </div>
                </div>
            </div>
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
@endsection