@extends("layouts/layout")

@section('title', 'Caixa')
@section('local', 'Retirada de caixa')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/criar.css?v=' . localtime()[0]) }}">

    <style>
        .aviso {
            text-align: justify;
            font-weight: 450;
        }

        .rosa {
            color: #EF018D;
        }
    </style>
@endsection

@section('content')
    <div class="cadastro-container">
        <div class="etapas">
            <div class="etapa ativa" data-step="1">
                <div class="numero">1</div>
                <div class="info">
                    <p class="dados">Retirada de caixa</p>
                    <p class="descricao">insira os dados para a retirada</p>
                </div>
            </div>
            <div class="etapa-caminho"></div>
            <div class="etapa" data-step="2">
                <div class="numero">2</div>
                <div class="info">
                    <p class="dados">Confirmação</p>
                    <p class="descricao">esteja ciente da sua ação</p>
                </div>
            </div>
        </div>

        <div class="formulario">
            <form action="{{ $action == 'edit' ? route('caixas.update', $caixa->id) : route('caixas.store')}}"
                method="{{ $action == 'edit' ? "PUT" : "POST"}}">
                @csrf
                <!-- Etapa 1 -->
                <div class="etapa-formulario" id="etapa-1">
                    <h3>Informações da retirada</h3>

                    <label for="dinheiro">Insira a quantidade dinheiro retirado<span class="obrigatorio">*</span></label>
                    <input type="text" id="dinheiro" name="dinheiro" placeholder="R$ 0,00" style="width: 40%;"
                        @if($action == 'edit') value="{{ $caixa->dinheiro }}" @endif>

                    <label for="descricao">Motivo de retirada</label>
                    <textarea id="descricao" name="motivo"
                        placeholder="Insira o motivo da retirada de caixa">@if($action == 'edit') {{ $caixa->dinheiro }} @endif</textarea>

                    <div class="botoes">
                        <button class="cancelar" type="button" onclick="window.location='{{ route('caixas.index') }}'">
                            <span class="highlight">Cancelar</span></button>
                        <button class="continuar" type="button" onclick="mudarEtapa(2)">Continuar <svg width="15"
                                height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.28119 2.78407C7.54282 2.50948 7.96702 2.50948 8.22865 2.78407L12.2484 7.00282C12.51 7.2774 12.51 7.7226 12.2484 7.99718L8.22865 12.2159C7.96702 12.4905 7.54282 12.4905 7.28119 12.2159C7.01955 11.9413 7.01955 11.4962 7.28119 11.2216L10.8272 7.5L7.28119 3.77843C7.01955 3.50385 7.01955 3.05865 7.28119 2.78407Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.39526 7.5C2.39526 7.11167 2.69521 6.79688 3.06522 6.79688H11.2164C11.5864 6.79688 11.8863 7.11167 11.8863 7.5C11.8863 7.88833 11.5864 8.20312 11.2164 8.20312H3.06522C2.69521 8.20312 2.39526 7.88833 2.39526 7.5Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Etapa 2 -->
                <div class="etapa-formulario" id="etapa-2" style="display: none">
                    <h3>Confirme a retirada</h3>

                    <p class="aviso">Ao confirmar a retirada de caixa, o sistema registra essa retirada com o <span
                            class="rosa">seu usuário</span> e <span class="rosa">data atual</span>. Use
                        essa função com cuidado e tenha certeza que a quantidade informada esta correta. <br><br>

                        Nota-se que um motivo não é obrigatório, mas é altamente recomendado para organização e prevenção de
                        problemas.</p>

                    <div class="botoes">
                        <button class="voltar" type="button" onclick="mudarEtapa(1)">Voltar</button>
                        <button class="continuar" type="submit">
                            Salvar
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6663 5L7.49967 14.1667L3.33301 10" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
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
    </script>
@endsection