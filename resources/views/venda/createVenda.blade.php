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
            width: 50px;
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


            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }



        .botoes-rodape button {
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }

        .cancelar {
            background: transparent;
            color: var(--rosa);
        }

        .continuar {
            background: var(--rosa);
            color: white;
        }

        .items-lista {
            flex-grow: 0;
        }

        .formulario {
            padding: 0px 25px;
            background: none;

        }

        .container-paginas {
            margin-top: 15px;
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
            <div class="etapa-caminho ativa"></div>
            <div class="etapa" data-step="2">
                <div class="numero">2</div>
                <div class="info">
                    <p class="dados">Visão geral</p>
                    <p class="descricao">confirme os dados da venda</p>
                </div>
            </div>
        </div>

        <div class="formulario">
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
                                    <path d="M0.75 8.25L8.25 0.75M0.75 0.75L8.25 8.25" stroke="white" stroke-linecap="round"
                                        stroke-linejoin="round" />
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
                        <div class="campo" style="width: 21%; text-align: start;">
                            <p>Nome</p>
                        </div>
                        <div class="campo" style="width: 33%; text-align: start;">
                            <p>Descrição</p>
                        </div>
                        <div class="campo" style="width: 12%;">
                            <p>Preço Unitário</p>
                        </div>
                        <div class="campo" style="width: 13%;">
                            <p>Quantidade</p>
                        </div>
                        <div class="campo" style="width: 12%;">
                            <p>Preço Total</p>
                        </div>
                        <div class="campo" style="width: 9%;"><!-- Ações --></div>
                    </div>

                    <!-- Itens da venda (Mock) -->
                    <div class="items-lista">
                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Coca-Cola 2L</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Refrigerante tradicional</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 10,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input type="number" value="0"
                                    class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 20,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
                        </div>

                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Produto Genérico</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Descrição exemplo</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 5,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 15,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
                        </div>

                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Água Mineral</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Garrafa 500ml</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 2,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 10,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
                        </div>


                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Água Mineral</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Garrafa 500ml</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 2,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 10,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
                        </div>


                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Água Mineral</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Garrafa 500ml</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 2,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 10,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
                        </div>


                        <div class="item-lista">
                            <div class="campo" style="width: 21%; text-align: start;">
                                <p>Água Mineral</p>
                            </div>
                            <div class="campo" style="width: 33%; text-align: start;">
                                <p>Garrafa 500ml</p>
                            </div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 2,00</p>
                            </div>
                            <div class="campo" style="width: 13%;"><input class="quantidade-input"></input></div>
                            <div class="campo" style="width: 12%;">
                                <p>R$ 10,00</p>
                            </div>
                            <div class="campo" style="width: 9%;"><!-- Botões --></div>
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



        </div>
        <div class="botoes-rodape">
            <button type="button" class="cancelar">Cancelar</button>
            <button type="button" class="continuar">Continuar</button>
        </div>
    </div>
@endsection