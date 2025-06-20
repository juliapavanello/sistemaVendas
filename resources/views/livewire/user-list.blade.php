<div>
    @livewireStyles
    @livewireScripts
    <div class="controle-container">
        <div class="coluna">
            <div class="coluna-titulo">
                <p>Administradores</p>
            </div>

            <div class="users-container">
                @foreach($users as $user)
                    @if($user->tipo == "Admin")
                        @livewire('UserCard',[$user->id,false])
                    @endif
                @endforeach
            </div>
        </div>
        <div class="coluna">
            <div class="coluna-titulo">
                <p>Barraca</p>
            </div>

            <div class="users-container">
                @foreach($users as $user)
                    @if($user->tipo == "Barraca")
                        @livewire('UserCard',[$user->id,false])
                    @endif
                @endforeach
            </div>
        </div>
        <div class="coluna">
            <div class="coluna-titulo">
                <p>Produção</p>
            </div>

            <div class="users-container">
                @foreach($users as $user)
                    @if($user->tipo == "" || $user->tipo == "kreep" || $user->tipo == "fondue" || $user->tipo == "Geral")
                        @livewire('UserCard',[$user->id,true])
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
