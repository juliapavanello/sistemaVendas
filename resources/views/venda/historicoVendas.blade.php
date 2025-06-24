@extends("layouts/layout")


@section('title', 'Vendas')
@section('local', 'Histórico')
@section('head')

    <link rel="stylesheet" href="{{ asset('css/lista.css?v=' . localtime()[0]) }}">

    <style>
        :root {
            /* Cores principais */
            --rosa: #EF018D;
            --vinho: #0C0007;
            --vinho-transparente: rgba(25, 0, 14, 0.5);
            --rosa-escuro-detalhes: #500030;

            /* Tons de cinza */
            --cinza-claro-transparente: rgba(34, 34, 34, 0.5);
            --cinza-escuro: #121212;
            --cinza-escuro-transparente: rgba(18, 18, 18, 0.5);
            --cinza-escuro-detalhes: #222222;
            --cinza-item-desativado: #4D4D4D;

            /* Cores auxiliares */
            --verde: #338543;
            --vermelho: #832F30;

            /* Cores de texto e fundo */
            --branco: #FFFFFF;
            --branco-texto-pequeno-2: #D9D9D9;
            --branco-texto-pequeno: #4D4D4D;
            --preto: #000000;
        }

        /* Estados */
        .venda-estado {
            transition: all 0.3s ease-in-out;
        }

        .oculto {
            display: none;
        }

        .nenhuma {
            font-size: 15px;
            color: #ddd;
        }

        .venda-container {
            background-color: var(--cinza-claro-transparente);
            padding: 15px 25px;
            border-radius: 16px;
            width: 300px;
            height: calc(100vh - 113px);
        }

        .titulo-venda {
            font-size: 20px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .subtitulo {
            font-size: 15px;
            font-weight: 600;

            color: var(--branco);
        }



        /* Informações */
        .vendedor {
            font-size: 16px;
            font-weight: 400;
            margin: 8px 0 0;
        }

        .subinfo {
            font-size: 10px;
            color: #aaa;
            margin: 0 0 8px;
        }

        .data,
        .origem {
            font-size: 14px;
            font-weight: 400;
            margin: 0;
        }

        /* Produtos */
        .produtos-section {
            margin-top: 20px;
        }

        .tabela {

            margin-top: 10px;
            padding-top: 10px;
        }

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


        svg {
            margin-right: 10px;
        }

        .item-lista:hover {
            background-color: var(--cinza-escuro-detalhes);
        }
    </style>
@endsection

@section('content')
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
                    <form class="form-pesquisa">
                        <input type="text" placeholder="Pesquisar" class="pesquisar">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.1684 14.656L12.5501 11.1539C13.4212 10.0314 13.8915 8.66516 13.8899 7.26131C13.8899 3.67544 10.8757 0.758057 7.17091 0.758057C3.46607 0.758057 0.451904 3.67544 0.451904 7.26131C0.451904 10.8472 3.46607 13.7646 7.17091 13.7646C8.62134 13.7661 10.0329 13.3109 11.1926 12.4678L14.8109 15.9699C14.9941 16.1284 15.233 16.213 15.4786 16.2063C15.7241 16.1997 15.9578 16.1023 16.1315 15.9341C16.3052 15.766 16.4058 15.5399 16.4127 15.3022C16.4196 15.0645 16.3322 14.8333 16.1684 14.656V14.656ZM2.37162 7.26131C2.37162 6.34258 2.65309 5.44448 3.18045 4.68058C3.7078 3.91669 4.45735 3.3213 5.3343 2.96972C6.21126 2.61814 7.17623 2.52615 8.10721 2.70538C9.03818 2.88462 9.89333 3.32703 10.5645 3.97667C11.2357 4.62631 11.6928 5.454 11.878 6.35508C12.0632 7.25615 11.9681 8.19014 11.6049 9.03894C11.2416 9.88774 10.6265 10.6132 9.83725 11.1236C9.04801 11.6341 8.12012 11.9065 7.17091 11.9065C5.89853 11.905 4.6787 11.4151 3.77899 10.5443C2.87928 9.67349 2.37315 8.49283 2.37162 7.26131V7.26131Z"
                                fill="white" />
                        </svg>
                    </form>

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

            <div class="header-lista item-lista" onclick="mostrarVenda(this)">
                <div class="campo" style="width: 21%; text-align: start;">
                    <p>Funcionário</p>
                </div>
                <div class="campo" style="width: 33%; text-align: start;">
                    <p>Valor</p>
                </div>
                <div class="campo" style="width: 12%;">
                    <p>Data</p>
                </div>
                <div class="campo" style="width: 13%;">
                    <p>Origem</p>
                </div>
                <div class="campo" style="width: 12%;">
                    <p>Qtd. Produtos</p>
                </div>
                <div class="campo" style="width: 9%; display: flex">
                    <!--icones deletar e excluir-->
                </div>
            </div>
            <div class="items-lista">
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarVenda(1)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarDetalhesVenda(this)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarVenda(this)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarVenda(this)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarVenda(this)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>Júlia linda maravilhosa</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>
                <div class="item-lista" style="padding: 15px 20px" onclick="mostrarVenda(this)">
                    <div class="campo" style="width: 21%; text-align: start;">
                        <p>teste</p>
                    </div>
                    <div class="campo" style="width: 33%; text-align: start;">
                        <p>R$ 24,00a</p>
                    </div>
                    <div class="campo" style="width: 12%">
                        <p>23/06/2025</p>
                    </div>
                    <div class="campo" style="width: 13%">
                        <p>Venda</p>
                    </div>
                    <div class="campo" style="width: 12.5%">
                        <p>2</p>
                    </div>
                    <div class="campo"
                        style="width: 8.5%; display: flex; justify-content: space-between; padding-left: 1vh;">
                        <!--icones deletar e excluir-->
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 16.6667H17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M13.75 2.91669C14.0815 2.58517 14.5312 2.39893 15 2.39893C15.2321 2.39893 15.462 2.44465 15.6765 2.53349C15.891 2.62233 16.0858 2.75254 16.25 2.91669C16.4142 3.08085 16.5444 3.27572 16.6332 3.4902C16.722 3.70467 16.7678 3.93455 16.7678 4.16669C16.7678 4.39884 16.722 4.62871 16.6332 4.84319C16.5444 5.05766 16.4142 5.25254 16.25 5.41669L5.83333 15.8334L2.5 16.6667L3.33333 13.3334L13.75 2.91669Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.33603 3.75124C4.68054 3.72971 4.97727 3.99153 4.9988 4.33603L5.78005 16.836C5.7802 16.8383 5.78033 16.8406 5.78045 16.843C5.80206 17.2636 6.08132 17.5 6.40627 17.5H13.5938C13.9155 17.5 14.1935 17.2689 14.2199 16.8369L15.0012 4.33603C15.0228 3.99153 15.3195 3.72971 15.664 3.75124C16.0085 3.77277 16.2703 4.0695 16.2488 4.41401L15.4676 16.9131C15.4676 16.9132 15.4676 16.9132 15.4676 16.9133C15.4057 17.9258 14.6525 18.75 13.5938 18.75H6.40627C5.3575 18.75 4.58659 17.933 4.53229 16.9108L3.75124 4.41401C3.72971 4.0695 3.99153 3.77277 4.33603 3.75124Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.5 4.375C2.5 4.02982 2.77982 3.75 3.125 3.75H16.875C17.2202 3.75 17.5 4.02982 17.5 4.375C17.5 4.72018 17.2202 5 16.875 5H3.125C2.77982 5 2.5 4.72018 2.5 4.375Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.43567 2.5C8.39484 2.49988 8.35439 2.50784 8.31664 2.52341C8.2789 2.53898 8.2446 2.56186 8.21573 2.59073C8.18686 2.6196 8.16398 2.6539 8.14841 2.69164C8.13284 2.72939 8.12488 2.76984 8.125 2.81067L8.125 2.8125V4.375C8.125 4.72018 7.84518 5 7.5 5C7.15483 5 6.875 4.72018 6.875 4.375V2.8133C6.87454 2.60805 6.91459 2.40473 6.99286 2.21498C7.07126 2.02492 7.18646 1.85223 7.33184 1.70684C7.47723 1.56146 7.64992 1.44626 7.83998 1.36786C8.02973 1.28959 8.23305 1.24954 8.4383 1.25H11.5617C11.767 1.24954 11.9703 1.28959 12.16 1.36786C12.3501 1.44626 12.5228 1.56146 12.6682 1.70684C12.8135 1.85223 12.9288 2.02492 13.0072 2.21498C13.0854 2.40477 13.1255 2.60814 13.125 2.81343V4.375C13.125 4.72018 12.8452 5 12.5 5C12.1548 5 11.875 4.72018 11.875 4.375V2.8125L11.875 2.81067C11.8751 2.76984 11.8672 2.72939 11.8516 2.69164C11.836 2.65389 11.8132 2.6196 11.7843 2.59073C11.7554 2.56186 11.7211 2.53898 11.6834 2.52341C11.6456 2.50784 11.6052 2.49988 11.5643 2.5L11.5625 2.5H8.4375L8.43567 2.5Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875V15.625C10.625 15.9702 10.3452 16.25 10 16.25C9.65482 16.25 9.375 15.9702 9.375 15.625V6.875C9.375 6.52982 9.65482 6.25 10 6.25Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.1652 6.25041C7.51016 6.23809 7.79979 6.50774 7.81211 6.8527L8.12461 15.6027C8.13693 15.9477 7.86727 16.2373 7.52232 16.2496C7.17736 16.2619 6.88773 15.9923 6.87541 15.6473L6.56291 6.89731C6.55059 6.55236 6.82024 6.26273 7.1652 6.25041Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.8348 6.25041C13.1798 6.26273 13.4494 6.55236 13.4371 6.89731L13.1246 15.6473C13.1123 15.9923 12.8227 16.2619 12.4777 16.2496C12.1327 16.2373 11.8631 15.9477 11.8754 15.6027L12.1879 6.8527C12.2002 6.50774 12.4899 6.23809 12.8348 6.25041Z"
                                fill="white" />
                        </svg>
                    </div>
                </div>

            </div>

            <div class="container-paginas">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 4.16659L7.16667 9.99992L13 15.8333" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <div class="paginas">
                    <div class="pg">1</div>
                    <div class="pg pg-ativa">2</div>
                    <div class="pg">3</div>
                    <div class="pg">4</div>
                    <div class="pg">5</div>
                    <div class="pg">... 10</div>
                </div>

                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 4.16659L13.8333 9.99992L8 15.8333" stroke="white" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <div class="side-container">
            <div class="venda-container">
                <h2 class="titulo-venda">Visualização de venda</h2>

                <!-- Mensagem inicial -->
                <div id="venda-vazia" class="venda-estado">
                    <p class="nenhuma">Nenhuma venda selecionada</p>
                </div>

                <!-- Venda preenchida -->
                <div id="venda-preenchida" class="venda-estado oculto">
                    <div class="info-section">
                        <h3 class="subtitulo">Informações sobre a venda</h3>
                        <p class="vendedor">Júlia linda maravilhosaaa</p>
                        <p class="subinfo">Funcionário responsável</p>
                        <p class="data">25/04/2025</p>
                        <p class="subinfo">Dia da venda</p>
                        <p class="origem">Pedido</p>
                        <p class="subinfo">Origem da venda</p>
                    </div>

                    <div class="produtos-section">
                        <h3 class="subtitulo">Listagem de produtos</h3>
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
                </div>
            </div>

        </div>


    </div>
    </div>
    <script>
        function mostrarVenda() {
            document.getElementById("venda-vazia").classList.add("oculto");
            document.getElementById("venda-preenchida").classList.remove("oculto");
        }
    </script>

@endsection