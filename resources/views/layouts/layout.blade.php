<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doces Apiúna</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/layout.css?v=' . localtime()[0]) }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    @yield('head')
</head>

<body>
    <div class="divBlur"></div>

    <div class="layout">
        <aside class="sidebar">
            <div class="caixaTitulo">
                <h1 class="titulo">Doces Apiúna</h1>
                <p class="subtitulo">Sistema de gerenciamento</p>
            </div>

            <nav class="menu">
                @if(session("user")->tipo != "Barraca")
                    <div class="grupo">
                        <div class="grupo-titulo toggle-menu" onclick="toggleMenu('produtosMenu')">
                            <p>Produtos</p>
                            <i class="icone-seta" data-lucide="chevron-down"></i>
                        </div>
                        <ul id="produtosMenu" class="sub-menu oculto">
                            <li><a href="{{ route('produtos.index') }}"><i data-lucide="layout-dashboard"></i> Dashboard</a>
                            </li>
                            <li><a href="{{ route('produtos.create') }}"><i data-lucide="plus"></i> Criar produto</a></li>
                            <li><a href="#"><i data-lucide="alert-triangle"></i> Avisos</a></li>
                        </ul>
                    </div>
                @endif

                @if(session("user")->tipo == "Barraca" || session("user")->tipo == "Admin")
                    <div class="grupo">
                        <div class="grupo-titulo toggle-menu" onclick="toggleMenu('caixaMenu')">
                            <p>Caixa</p>
                            <i class="icone-seta" data-lucide="chevron-down"></i>
                        </div>
                        <ul id="caixaMenu" class="sub-menu oculto">
                            <li><a href="{{ route('caixas.index') }}"><i data-lucide="layout-dashboard"></i> Dashboard</a>
                            </li>
                            <li><a href="{{ route('caixas.create') }}"><i data-lucide="dollar-sign"></i> Retirada de
                                    caixa</a></li>
                            <li><a href="{{ route('caixas.index') }}"><i data-lucide="file-text"></i> Relatório de caixa</a>
                            </li>
                        </ul>
                    </div>
                @endif

                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('pedidosMenu')">
                        <p>Pedidos</p>
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="pedidosMenu" class="sub-menu oculto">
                        <li><a href="#">Criar pedido</a></li>
                        <li><a href="#">Ver pedidos</a></li>
                    </ul>
                </div>

                @if(session("user")->tipo == "Admin")
                    <div class="grupo">
                        <div class="grupo-titulo toggle-menu" onclick="toggleMenu('usuariosMenu')">
                            <p>Usuários</p>
                            <i class="icone-seta" data-lucide="chevron-down"></i>
                        </div>
                        <ul id="usuariosMenu" class="sub-menu oculto">
                            <li><a href="{{ route('user.index') }}"><i data-lucide="user"></i>Controle de usuários</a></li>
                            <li><a href="{{ route('user.create') }}"><i data-lucide="plus"></i>Criar usuário</a></li>
                        </ul>
                    </div>
                @endif

                @if(session("user")->tipo == "Barraca" || session("user")->tipo == "Admin")
                    <div class="grupo">
                        <div class="grupo-titulo toggle-menu" onclick="toggleMenu('vendasMenu')">
                            <p>Vendas</p>
                            <i class="icone-seta" data-lucide="chevron-down"></i>
                        </div>
                        <ul id="vendasMenu" class="sub-menu oculto">
                            <li><a href="{{ route('vendas.index') }}">Histórico</a></li>
                            <li><a href="{{ route('vendas.create') }}">Nova venda</a></li>
                        </ul>
                    </div>
                @endif
            </nav>

            <div class="grupo grupo-inferior">
                <ul>
                    <li><a href="#"><i data-lucide="settings"></i> Configurações</a></li>
                    <li><a href="#"><i data-lucide="help-circle"></i> Ajuda & Suporte</a></li>
                    <li>
                        <a href="#">
                            @if(session("user")->foto && Storage::url('fotoUsuarios/' . session("user")->foto))
                                <div class="perfil-img">
                                    <img draggable="false"
                                        src="{{  Storage::url('fotoUsuarios/' . session("user")->foto) }}"
                                        alt="foto usuário">
                                </div>
                            @else
                                <i data-lucide="user"></i>
                            @endif
                            {{ session("user")->nome ? session("user")->nome : "Erro!"}}
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="content-container">
            <div id="localizador">
                <p class="highlight">@yield('title') <span>> @yield('local')</span></p>
            </div>

            <main class="conteudo">
                @yield('content')
            </main>
        </div>

    </div>
    <script>
        lucide.createIcons();

        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const header = menu.previousElementSibling;
            menu.classList.toggle('oculto');
            header.classList.toggle('ativo');
        }
    </script>
    @yield('script')
</body>

</html>