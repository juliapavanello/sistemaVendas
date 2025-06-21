@extends("layouts/layout")

@section('title', 'Usuário')
@section('local', 'Novo usuário')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/criar.css?v=' . localtime()[0]) }}">

    <style>
        :root {
            --rosa: #EF018D;
            --vinho: #0C0007;
            --vinho-transparente: rgba(25, 0, 14, 0.5);
            --rosa-escuro-detalhes: #500030;

            --cinza-claro-transparente: rgba(34, 34, 34, 0.5);
            --cinza-escuro: #121212;
            --cinza-escuro-transparente: rgba(18, 18, 18, 0.5);
            --cinza-escuro-detalhes: #222222;
            --cinza-item-desativado: #4D4D4D;

            --verde: #338543;
            --vermelho: #832F30;
            --amarelo: #C9A31F;

            --branco: #FFFFFF;
            --branco-texto-pequeno-2: #D9D9D9;
            --branco-texto-pequeno: #4D4D4D;
            --preto: #000000;
        }

        .col-img {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 100%;
            overflow: hidden;
            width: 200px;
            aspect-ratio: 1/1;
            cursor: pointer;
            background-color: var(--vinho);
        }

        .col-img img {
            width: 102%;
        }

        .etapa-formulario {
            display: flex;
            max-width: 100%;
            gap: 21px;
        }

        .linha-campos {
            justify-content: space-between;
        }

        .label {
            transform: translateY(10px);
        }

        .radio {
            display: none;
            gap: 40px;
            transform: translateY(-10px);
        }

        .radio label {
            position: relative;
            cursor: pointer;
            padding-left: 20px;
            margin-bottom: 12px;
        }

        .radio label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            position: absolute;
            top: 5px;
            left: 0;
            height: 15px;
            width: 15px;
            background-color: #eee;
            border-radius: 50%;
            background-color: var(--vinho);
        }

        /* On mouse-over, add a grey background color */
        .radio label:hover .checkmark {
            background-color: var(--rosa-escuro-detalhes);
        }

        /* When the radio button is checked, add a blue background */
        .radio label input:checked~.checkmark {
            background-color: var(--rosa);
            border: 2px solid var(--rosa-escuro-detalhes);
        }
    </style>
@endsection

@section('content')
    <div class="cadastro-container">
        <div class="etapas">
            <div class="etapa ativa" data-step="1">
                <div class="numero">1</div>
                <div class="info">
                    <p class="dados">Dados do usuário</p>
                    <p class="descricao">adicione os dados do usuário</p>
                </div>
            </div>
        </div>

        <div class="formulario">
            <form action="{{ route("user.store") }}" method="post" enctype="multipart/form-data">
                @csrf
                <h3>Informações do usuário</h3>
                <div class="etapa-formulario" id="etapa-1">
                    <div class="label">
                        <label class="col-img" for="img">
                            <div class="col-img">
                                <img src="{{ Storage::url('fotoUsuarios/user2.png') }}" alt="">
                            </div>
                        </label>
                        <input type="file" id="img" name="foto" style="display: none;" accept="image/png, image/jpeg">
                        <p style="text-align: center;">Foto de usuário</p>
                    </div>

                    <div class="col-dados" style="width: 50%;">
                        <label for="nome">Nome do produto<span class="obrigatorio">*</span></label>
                        <input type="text" id="nome" name="nome" placeholder="Insira o nome do usuário">

                        <label for="email">E-mail<span class="obrigatorio">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Insira o email do usuário"
                            style="width: 100%;">

                        <div class="linha-campos">
                            <div class="cpf">
                                <label for="cpf">CPF<span class="obrigatorio">*</span></label>
                                <input type="text" id="cpf" name="cpf" placeholder="Insira o CPF">
                            </div>
                            <div class="tipoUser">
                                <label for="tipo">Tipo de usuário<span class="obrigatorio">*</span></label>
                                <select name="tipo" id="tipo" name="tipo">
                                    <option value="Admin">Admin</option>
                                    <option value="Barraca">Barraca</option>
                                    <option value="Produção">Produção</option>
                                </select>
                            </div>
                        </div>

                        <label id="radio-label" style="display: none">Sub-tipo</label>
                        <div class="radio">
                            <label for="geral">
                                <input type="radio" name="subtipo" id="geral" value="Geral">
                                <span class="checkmark"></span>
                                Geral
                            </label>

                            <label for="kreep">
                                <input type="radio" name="subtipo" id="kreep" value="kreep">
                                <span class="checkmark"></span>
                                Kreep
                            </label>

                            <label for="fondue">
                                <input type="radio" name="subtipo" id="fondue" value="fondue">
                                <span class="checkmark"></span>
                                Fondue
                            </label>
                        </div>

                        <div class="botoes">
                            <button class="cancelar" onclick="window.location='{{ route('user.index') }}'"><span
                                    class="highlight">Cancelar</span></button>
                            <button class="continuar" type="submit">
                                Salvar
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6663 5L7.49967 14.1667L3.33301 10" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let tipoSelect = document.getElementById("tipo")
        tipoSelect.addEventListener("change", () => {
            if (tipoSelect.value == "Produção") {
                document.querySelector(".radio").style.display = "flex"
                document.querySelector("#radio-label").style.display = "block"
            } else {
                document.querySelector(".radio").style.display = "none"
                document.querySelector("#radio-label").style.display = "none"
            }
        })

        let switchs = document.querySelectorAll(".switch");
        switchs.forEach(element => {
            let bola = element.querySelector(".bola")
            element.addEventListener("click", () => {
                if (bola.classList.length == 1) {
                    bola.classList = "bola input-ativo"
                } else {
                    bola.classList = "bola"
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

        //Preview foto
        document.getElementById('img').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const imgElement = document.querySelector('label[for="img"] img');
                imgElement.src = URL.createObjectURL(file);
            }
        });

    </script>
@endsection