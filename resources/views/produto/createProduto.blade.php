@extends("layouts/layout")

@section('title', 'Produtos')
@section('local', $action=='edit' ? 'Alterar produto':'Novo produto')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/criar.css?v=' . localtime()[0]) }}">
@endsection

@section('content')
    <div class="cadastro-container">
        <div class="etapas">
            <div class="etapa ativa" data-step="1">
                <div class="numero">1</div>
                <div class="info">
                    <p class="dados">Dados do produto</p>
                    <p class="descricao">adicione os dados do seu produto</p>
                </div>
            </div>
            <div class="etapa-caminho"></div>
            <div class="etapa" data-step="2">
                <div class="numero">2</div>
                <div class="info">
                    <p class="dados">Preços e vendas</p>
                    <p class="descricao">defina os preços e opções de venda</p>
                </div>
            </div>
            <div class="etapa-caminho"></div>
            <div class="etapa" data-step="3">
                <div class="numero">3</div>
                <div class="info">
                    <p class="dados">Alertas e avisos</p>
                    <p class="descricao">configure os alertas automáticos</p>
                </div>
            </div>
        </div>

        <div class="formulario">
            <form action="{{ $action == 'edit' ? route('produtos.update', $produto->id) : route('produtos.store')}}"
                method="POST">
                @csrf
                @if($action == 'edit')
                    @method('PUT')
                @endif
                <!-- Etapa 1 -->
                <div class="etapa-formulario" id="etapa-1">
                    <h3>Informações do produto</h3>

                    <label for="nome">Nome do produto<span class="obrigatorio">*</span></label>
                    <input type="text" id="nome" name="nome" placeholder="Insira o nome do produto" @if($action == 'edit') value="{{ $produto->nome }}" @endif>

                    <label for="descricao">Descrição do produto</label>
                    <textarea id="descricao" placeholder="Insira a descrição do produto" name="descricao">@if($action == 'edit'){{ $produto->descricao }}@endif</textarea>

                    <div class="linha-campos">
                        <div class="quantidade">
                            <label for="quantidade">@if ($action == 'edit') Add. Estoque @else Quantidade @endif</label>
                            <input type="number" id="quantidade" name="quantidade" placeholder="0">
                        </div>
                        <div class="unidade">
                            <label for="unidade">Unidade de medida<span class="obrigatorio">*</span></label>
                            <input type="text" id="unidade" name="unidade" @if($action == 'edit') value="{{ $produto->unidade }}" @endif>
                        </div>
                        @if($action == 'edit')
                        <div>
                            <label for="">Estoque atual</label>
                            <p style="font-size: 20px; margin-top: 5px;">{{ $produto->quantidade.' '.$produto->unidade }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="botoes">
                        <button type="button" class="cancelar" onclick="window.location='{{ route('produtos.index') }}'"><span
                                class="highlight">Cancelar</span></button>
                        <button type="button"  class="continuar" onclick="mudarEtapa(2)">Continuar <svg width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <h3>Definição de preços</h3>
                    <div class="linha-campos">
                        <div>
                            <label>Preço de venda</label>
                            <input type="text" placeholder="R$ 0,00" name="preco" @if($action == 'edit') value="{{ $produto->preco }}" @endif>
                            <small>Presumido como não à venda</small> <!--eu não entendi essa coisa do presumido-->
                        </div>
                        <div>
                            <label>Custo de compra</label>
                            <input type="text" placeholder="R$ 0,00" name="custo" @if($action == 'edit') value="{{ $produto->custo }}" @endif>
                        </div>
                    </div>

                    <h3 class="config">Configurações de venda e compra</h3>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <div class="switch">
                                <div class="bola @if($action == 'edit' && $produto->descontarCaixa == "true") input-ativo @endif"></div>
                                <input type="hidden" @if($action == 'edit') value="{{ $produto->descontarCaixa ? $produto->descontarCaixa : "false" }}" @else value="false" @endif name="descontarCaixa">
                            </div>
                            <p> Descontar do caixa ao adicionar estoque</p>
                        </div>
                        <div class="checkbox-item">
                            <div class="switch">
                                <div class="bola @if($action == 'edit' && $produto->paraVenda == "true") input-ativo @endif"></div>
                                <input type="hidden" @if($action == 'edit') value="{{ $produto->paraVenda ? $produto->paraVenda : "false"}}" @else value="false" @endif name="paraVenda">
                            </div>
                            <p> Aberto há venda</p>
                        </div>
                        <div class="checkbox-item">
                            <div class="switch">
                                <div class="bola @if($action == 'edit' && $produto->descontarEstoque == "true") input-ativo @endif"></div>
                                <input type="hidden" @if($action == 'edit') value="{{ $produto->descontarEstoque ? $produto->descontarEstoque : "false"}}" @else value="false" @endif name="descontarEstoque">
                            </div>
                            <p>Descontar do estoque na venda</p>
                        </div>
                    </div>

                    <div class="botoes">
                        <button type="button"  class="voltar" onclick="mudarEtapa(1)">Voltar</button>
                        <button type="button"  class="continuar" onclick="mudarEtapa(3)">Continuar <svg width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.28119 2.78407C7.54282 2.50948 7.96702 2.50948 8.22865 2.78407L12.2484 7.00282C12.51 7.2774 12.51 7.7226 12.2484 7.99718L8.22865 12.2159C7.96702 12.4905 7.54282 12.4905 7.28119 12.2159C7.01955 11.9413 7.01955 11.4962 7.28119 11.2216L10.8272 7.5L7.28119 3.77843C7.01955 3.50385 7.01955 3.05865 7.28119 2.78407Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M2.39526 7.5C2.39526 7.11167 2.69521 6.79688 3.06522 6.79688H11.2164C11.5864 6.79688 11.8863 7.11167 11.8863 7.5C11.8863 7.88833 11.5864 8.20312 11.2164 8.20312H3.06522C2.69521 8.20312 2.39526 7.88833 2.39526 7.5Z"
                                    fill="white" />
                            </svg></button>
                    </div>
                </div>

                <!-- Etapa 3 -->
                <div class="etapa-formulario" id="etapa-3" style="display: none">
                    <h3>Configurações de avisos</h3>

                    <label class="switch-label">
                        <div class="checkbox-item">
                            <div class="switch">
                                <div class="bola @if($action == 'edit' && ($produto->avisoLeve != 0 || $produto->avisoGrave != 0)) input-ativo @endif"></div>
                                <input type="hidden" @if($action == 'edit') value="{{ ($produto->avisoLeve == 0 && $produto->avisoGrave == 0) ? "false":"true"}}" @else value="false" @endif name="ativarAvisos">
                            </div>
                            <p>Habilitar avisos nesse produto</p>
                        </div>
                    </label>

                    <div class="alerta-item">
                        <label class="checkbox-container">
                            <input type="checkbox" name="ativarAvisoLeve" @if($action == 'edit' && $produto->avisoLeve != 0) checked @endif>
                            <span class="checkmark"></span>
                            O alerta de "<strong class="verde">perto do baixo estoque</strong>" é disparado a partir de:
                        </label>
                        <input type="text" class="input-alerta" name="avisoLeve" @if($action == 'edit' && $produto->avisoLeve != 0) value="{{ $produto->avisoLeve }}" @endif>
                    </div>

                    <div class="alerta-item">
                        <label class="checkbox-container">
                            <input type="checkbox" name="ativarAvisoGrave" @if($action == 'edit' && $produto->avisoGrave != 0) checked @endif>
                            <span class="checkmark"></span>
                            O alerta de "<strong class="amarelo">baixo estoque</strong>" é disparado a partir de:
                        </label>
                        <input type="text" class="input-alerta" name="avisoGrave" @if($action == 'edit' && $produto->avisoGrave != 0) value="{{ $produto->avisoGrave }}" @endif>
                    </div>

                    <div class="botoes">
                        <button class="voltar" type="button" onclick="mudarEtapa(2)">Voltar</button>
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
                    element.querySelector("input").value="true"
                } else {
                    bola.classList = "bola"
                    element.querySelector("input").value="false"
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