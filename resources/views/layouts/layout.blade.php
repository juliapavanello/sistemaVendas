<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Projeto Faculdade')</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
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
                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('produtosMenu')">
                        Produtos
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="produtosMenu" class="sub-menu oculto">
                        <li><a href="{{ route('produtos.index') }}"><i data-lucide="layout-dashboard"></i> Dashboard</a></li>
                        <li><a href="{{ route('produtos.create') }}"><i data-lucide="plus"></i> Criar produto</a></li>
                        <li><a href="#"><i data-lucide="alert-triangle"></i> Avisos</a></li>
                    </ul>
                </div>

                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('caixaMenu')">
                        Caixa
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="caixaMenu" class="sub-menu oculto">
                        <li><a href="caixa.dashboard"><i data-lucide="layout-dashboard"></i> Dashboard</a></li>
                        <li><a href=""><i data-lucide="dollar-sign"></i> Retirada de caixa</a></li>
                        <li><a href="#"><i data-lucide="file-text"></i> Relatório de caixa</a></li>
                    </ul>
                </div>

                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('pedidosMenu')">
                        Pedidos
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="pedidosMenu" class="sub-menu oculto">
                        <li><a href="#">Criar pedido</a></li>
                        <li><a href="#">Avisos</a></li>
                    </ul>
                </div>

                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('usuariosMenu')">
                        Usuários
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="usuariosMenu" class="sub-menu oculto">
                        <li><a href="{{ route('user.index') }}"><i data-lucide="user"></i>Controle de usuários</a></li>
                        <li><a href="{{ route('user.create') }}"><i data-lucide="plus"></i>Criar usuário</a></li>
                    </ul>
                </div>

                <div class="grupo">
                    <div class="grupo-titulo toggle-menu" onclick="toggleMenu('vendasMenu')">
                        Vendas
                        <i class="icone-seta" data-lucide="chevron-down"></i>
                    </div>
                    <ul id="vendasMenu" class="sub-menu oculto">
                        <li><a href="#">Histórico</a></li>
                        <li><a href="#">Nova venda</a></li>
                    </ul>
                </div>
            </nav>


            <div class="grupo grupo-inferior">
                <ul>
                    <li><a href="#"><i data-lucide="settings"></i> Configurações</a></li>
                    <li><a href="#"><i data-lucide="help-circle"></i> Ajuda & Suporte</a></li>
                    <li><a href="#"><i data-lucide="user"></i> Usuário X</a></li>
                </ul>
            </div>
        </aside>

        <main class="conteudo">
            @yield('content')
        </main>
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
</body>
</html>
