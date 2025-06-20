@extends("layouts/layout")

@section('title', 'Usuário')
@section('local', 'Controle')

@section('head')
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

        .controle-container {
            display: flex;
            width: 100%;
            height: calc(100vh - 113px);
            gap: 28px;
        }

        .coluna {
            width: 33.333333%;
            max-width: 33.3333333%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .coluna-titulo {
            text-align: center;
            background-color: var(--cinza-claro-transparente);
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            border-radius: 15px;
            margin-bottom: 3px;
        }

        .user-card {
            background-color: var(--cinza-claro-transparente);
            padding: 15px;
            padding-bottom: 10px;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            font-size: 10px;
            color: var(--branco-texto-pequeno-2);
        }

        .user-top {
            display: flex;
        }

        .user-bottom {
            display: flex;
            margin-left: 60px;
        }

        .user-img {
            width: 45px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            align-self: flex-start;
            margin-right: 15px;
            background-color: var(--vinho);
        }

        .user-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .user-delete {
            margin-left: auto;
        }

        .user-delete svg {
            cursor: pointer;
        }

        .user-info {
            transform: translateY(-5px);
        }

        .block-div {
            margin-top: 5px;
            color: var(--branco);
            font-size: 15px;
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .switch {
            width: 35px;
            height: 20px;
            background-color: var(--vinho);
            border-radius: 1000px;
            transform: translateY(2px);
            display: flex;
            align-items: center;
            padding: 0 3px;
            cursor: pointer;
        }

        .bola {
            background-color: var(--cinza-item-desativado);
            width: 16px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            margin-left: 0px;
            transition: background 0.5s ease, margin-left 0.5s ease;
        }

        .users-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 89%;
            border-radius: 15px;
            outline-offset: 10px;
            overflow: auto;
        }

        .subtipo {
            color: var(--branco);
            background-color: var(--cinza-escuro);
            border: 1px solid var(--cinza-escuro);
            border-radius: 5px;
            padding: 0 10px;
            font-size: 15px;
            transform: translateY(-3px);
            margin-left: auto;
            height: fit-content;
            display: none;
        }

        .subtipo:focus {
            outline: none;
        }

        .input-ativo {
            background-color: var(--verde);
            margin-left: 13px;
        }
    </style>
@endsection

@section('content')
    @livewireStyles
    @livewireScripts
    @livewire("userlist")

    <script>
        let switchs = document.querySelectorAll(".switch");
        switchs.forEach(element => {
            let bola = element.querySelector(".bola")
            element.addEventListener("click", () => {
                if (bola.classList.length == 1) {
                    bola.classList = "bola input-ativo"
                } else {
                    bola.classList = "bola"
                }
                let user = element.parentElement.parentElement.parentElement;
                Livewire.dispatch('updateBlock', { data: [user.id, bola.classList.length != 1] })
            })
        });

        let colunas = document.getElementsByClassName('coluna')
        let users = document.getElementsByClassName('user-card')

        Array.from(users).forEach(user => {
            if (user.parentElement.parentElement == colunas[2]) {
                user.querySelector(".subtipo").style.display = "block"
            }

            user.querySelector(".subtipo").addEventListener("change",()=>{
                Livewire.dispatch('updateTipo', { data: [user.id, user.querySelector(".subtipo").value] })
            })

            user.addEventListener("dragstart", function (e) {
                let selected = e.target;
                Array.from(colunas).forEach(col => {
                    col.addEventListener("dragover", (e) => {
                        col.querySelector(".users-container").style.background = "var(--cinza-claro-transparente)";
                        e.preventDefault();
                    })
                    col.addEventListener("dragleave", (e) => {
                        col.querySelector(".users-container").style.background = "none";
                    })
                    col.addEventListener("drop", (e) => {
                        col.querySelector(".users-container").style.background = "none";
                        let container = col.querySelector(".users-container")
                        container.appendChild(selected)

                        
                        switch (col) {
                            case colunas[0]:
                                Livewire.dispatch('updateTipo', { data: [selected.id, "Admin"] })
                                break;
                            case colunas[1]:
                                Livewire.dispatch('updateTipo', { data: [selected.id, "Barraca"] })
                                break;
                            case colunas[2]:
                                console.log(selected.querySelector(".subtipo").value);
                                
                                Livewire.dispatch('updateTipo', { data: [selected.id, selected.querySelector(".subtipo").value] })
                                break;
                        }
                        selected = null
                    })
                });
            })
        });
    </script>
@endsection