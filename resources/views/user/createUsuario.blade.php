@extends("layouts/layout")

@section('title', 'Usuário')
@section('local', 'Novo usuário')

@section('content')
    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="João da Silva" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="joao@email.com" required>

        <select id="tipo" name="tipo" required>
            <option value="Admin" selected>Admin</option>
            <option value="Barraca">Barraca</option>
            <option value="Geral" selected>Produção</option>
            <option value="Kreep">Produção Kreep</option>
            <option value="Fondue">Produção Fondue</option>
        </select>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="12252665998" required>

        <label for="bloqueio">Bloqueado?</label>
        <select id="bloqueio" name="bloqueio" required>
            <option value="false" selected>Não</option>
            <option value="true">Sim</option>
        </select>

        <input type="file" name="foto" accept="image/png, image/jpeg">

        <button type="submit">Cadastrar</button>
    </form>
    <br><br>
    <form method="POST" action="{{ route('user.update', ['user' => 6]) }}" enctype="multipart/form-data">
        @csrf
        @method("put")

       <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="João da Silva" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="joao@email.com" required>

        <select id="tipo" name="tipo" required>
            <option value="Admin" selected>Admin</option>
            <option value="Barraca">Barraca</option>
            <option value="Geral" selected>Produção</option>
            <option value="Kreep">Produção Kreep</option>
            <option value="Fondue">Produção Fondue</option>
        </select>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="12252665998" required>

        <label for="bloqueio">Bloqueado?</label>
        <select id="bloqueio" name="bloqueio" required>
            <option value="false" selected>Não</option>
            <option value="true">Sim</option>
        </select>

        <input type="file" name="foto" accept="image/png, image/jpeg">

        <button type="submit">Editar</button>
    </form>
@endsection