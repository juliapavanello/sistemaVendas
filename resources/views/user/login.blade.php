<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Doces apiúna</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css?v=1' . localtime()[0]) }}">

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

        body {
            overflow-x: hidden;
        }

        #painel {
            padding: 35px;
            width: 410px;
            height: 510px;
            background-color: var(--cinza-claro-transparente);
            border-radius: 15px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        #painel * {
            display: flex;
            flex-direction: column;
        }

        #painel_inputs {
            display: flex;
            gap: 15px;
            margin: 50px 0;
        }

        #painel_title {
            font-size: 30px;
            font-weight: bold;
        }

        #painel_subtitle {
            font-size: 20px;
            font-weight: medium;
            transform: translateY(-8px);
        }

        #painel_submit {
            background-color: var(--rosa);
            color: var(--branco);
            border: none;
            border-radius: 100px;
            padding: 8px;
            margin-top: 15px;
            cursor: pointer;
        }

        #blur_background {
            width: 100vw;
            height: 100vh;
            background-color: var(--cinza-claro-transparente);
            backdrop-filter: blur(100px);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px
        }

        .blob {
            position: absolute;
            border-radius: 100%;
            z-index: -1;
            aspect-ratio: 1/1;
        }

        #mensagem {
            width: 410px;
        }

        #msg-title {
            font-size: 60px;
            font-weight: 500;
        }

        #msg-subtitle {
            font-size: 30px;
            font-weight: 400;
            color: var(--rosa);
            transform: translateY(-20px);
        }

        #msg-text {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="blob" style="background-color: #9747FF; width: 15vw; top:25%; left: -5%"></div>
    <div class="blob"
        style="background-color: var(--rosa-escuro-detalhes); width: 35vw; left: -10%; top: -25%; z-index: -2"></div>
    <div class="blob" style="background-color: var(--rosa); width: 20vw; left: 25%; top: -20%"></div>

    <div class="blob" style="background-color: var(--rosa); width: 25vw; right: 20%; top: -20%"></div>
    <div class="blob" style="background-color: var(--rosa-escuro-detalhes); width: 20vw; right: 2%; top: 0%"></div>
    <div class="blob" style="background-color: #9747FF; width: 10vw; top:30%; right: -5%;"></div>

    <div id="blur_background">
        <div id="mensagem">
            <p id="msg-title">Doces Apiúna</p>
            <p id="msg-subtitle">Sistema de gerenciamento</p>
            <p id="msg-text">Desde <span class="highlight">1990</span> adoçando sua vida</p>
        </div>

        <form id="painel" action="{{ route('auth') }}" method="post">
            @csrf
            <div id="painel_header">
                <p id="painel_title">BEM VINDO DE VOLTA!</p>
                <p id="painel_subtitle">Bom te ver novamente!</p>
                <p class="txt-pequeno" style="transform: translateY(-5px);">Esse sistema de é de uso privado e só pode
                    ser acessado com um usuário cadastrado
                    pelo sistema.</p>
            </div>
            <div id="painel_inputs">
                <input type="text" name="email" class="text-input" placeholder="Insira o email de usuário">
                <input type="password" name="password" class="text-input" placeholder="Insira a senha">
                <input type="submit" id="painel_submit">
            </div>
        </form>
    </div>

</body>

</html>