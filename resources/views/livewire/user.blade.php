<div class="user-card" draggable="true" id="{{ $user->id }}">
    <div class="user-top">
        <div class="user-img">
            <img draggable="false" src="{{  $user->foto ? Storage::url('fotoUsuarios/' . $user->foto) : Storage::url('fotoUsuarios/user2.png') }}" alt="foto usuário">
        </div>
        <div class="user-info">
            <p style="font-size: 16px; font-weight: 500; color: var(--branco)">{{ $user->nome }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->cpf }}</p>
        </div>

        <svg wire:click="destroy" class="user-delete" style="cursor: pointer;" width="28" height="28" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M5.42004 4.68902C5.85068 4.66211 6.22159 4.98938 6.24851 5.42002L7.22507 21.045C7.22525 21.0479 7.22541 21.0508 7.22556 21.0537C7.25257 21.5794 7.60165 21.875 8.00784 21.875H16.9922C17.3944 21.875 17.7419 21.586 17.7749 21.0461L18.7515 5.42002C18.7785 4.98938 19.1494 4.66211 19.58 4.68902C20.0106 4.71594 20.3379 5.08685 20.311 5.51748L19.3345 21.1414C19.3345 21.1415 19.3345 21.1415 19.3345 21.1415C19.2571 22.4072 18.3156 23.4375 16.9922 23.4375H8.00784C6.69688 23.4375 5.73323 22.4162 5.66536 21.1385L4.68905 5.51748C4.66213 5.08685 4.98941 4.71594 5.42004 4.68902Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M3.125 5.46875C3.125 5.03728 3.47478 4.6875 3.90625 4.6875H21.0938C21.5252 4.6875 21.875 5.03728 21.875 5.46875C21.875 5.90022 21.5252 6.25 21.0938 6.25H3.90625C3.47478 6.25 3.125 5.90022 3.125 5.46875Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M10.5446 3.125C10.4936 3.12485 10.443 3.13479 10.3958 3.15425C10.3486 3.17372 10.3058 3.20232 10.2697 3.23841C10.2336 3.2745 10.205 3.31737 10.1855 3.36455C10.166 3.41173 10.1561 3.4623 10.1563 3.51334L10.1563 3.51563V5.46875C10.1563 5.90022 9.80648 6.25 9.37501 6.25C8.94353 6.25 8.59376 5.90022 8.59376 5.46875V3.51662C8.59317 3.26006 8.64323 3.0059 8.74107 2.76872C8.83907 2.53114 8.98308 2.31528 9.16481 2.13355C9.34653 1.95183 9.56239 1.80782 9.79998 1.70982C10.0372 1.61198 10.2913 1.56192 10.5479 1.5625H14.4521C14.7087 1.56192 14.9629 1.61198 15.2 1.70982C15.4376 1.80782 15.6535 1.95182 15.8352 2.13355C16.0169 2.31528 16.1609 2.53114 16.2589 2.76872C16.3568 3.00595 16.4069 3.26017 16.4063 3.51679V5.46875C16.4063 5.90022 16.0565 6.25 15.625 6.25C15.1935 6.25 14.8438 5.90022 14.8438 5.46875V3.51563L14.8438 3.51334C14.8439 3.4623 14.834 3.41173 14.8145 3.36455C14.795 3.31736 14.7664 3.27449 14.7304 3.23841C14.6943 3.20232 14.6514 3.17372 14.6042 3.15425C14.557 3.13479 14.5065 3.12485 14.4554 3.125L14.4531 3.125H10.5469L10.5446 3.125Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M12.5 7.8125C12.9315 7.8125 13.2812 8.16228 13.2812 8.59375V19.5312C13.2812 19.9627 12.9315 20.3125 12.5 20.3125C12.0685 20.3125 11.7188 19.9627 11.7188 19.5312V8.59375C11.7188 8.16228 12.0685 7.8125 12.5 7.8125Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8.9565 7.813C9.3877 7.7976 9.74974 8.13467 9.76514 8.56586L10.1558 19.5034C10.1712 19.9346 9.83409 20.2966 9.40289 20.312C8.9717 20.3274 8.60966 19.9903 8.59426 19.5591L8.20363 8.62163C8.18823 8.19043 8.5253 7.8284 8.9565 7.813Z"
                fill="white" />
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M16.0435 7.813C16.4747 7.8284 16.8118 8.19043 16.7964 8.62163L16.4058 19.5591C16.3904 19.9903 16.0283 20.3274 15.5971 20.312C15.1659 20.2966 14.8289 19.9346 14.8443 19.5034L15.2349 8.56586C15.2503 8.13467 15.6123 7.7976 16.0435 7.813Z"
                fill="white" />
        </svg>
    </div>
    <div class="user-bottom">
        <div class="block-div">
            <p>Conta bloqueada:</p>
            <div class="switch">
                <div class="bola @if($user->bloqueio)input-ativo @endif"></div>
            </div>
            
            <select name="subtipo" class="subtipo" @if($carregarTipo) style="display: block" @endif>
                <option value="Geral" @if($user->tipo == "") selected @endif>Geral</option>
                <option value="kreep" @if($user->tipo == "kreep") selected @endif>Kreep</option>
                <option value="fondue" @if($user->tipo == "fondue") selected @endif>Fondue</option>
            </select>
        </div>
    </div>
</div>