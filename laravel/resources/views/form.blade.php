@extends('layouts.main')

@section('title', 'Novo Cadastro')

@section('content')

<div id="listaPessoas">

    <h1>Incluindo um Novo Cadastro</h1>

    <form action="/form/enviar" id="formCadastrar" method="post" enctype="multipart/form-data">
        @csrf

        <label for="cNome">Nome</label><br />
        <input id="cNome" name="nome" /><br />

        <label for="cDataNasc">Data de Nascimento</label><br />
        <input id="cDataNasc" name="nascimento" /><br />

        <label for="cEmail">E-Mail</label><br />
        <input id="cEmail" name="email" /><br />

        <label for="cFoto">Foto (somente .jpg - máximo de 200Kb)</label><br />
        <input id="cFoto" name="foto" type="file" accept="image/jpeg" /><br />

    </form>

    <a href="javascript:;" onClick="document.getElementById('formCadastrar').submit();" class="btPadrao">Salvar</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $mensagem)
                    <li>{{$mensagem}}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>

@endsection
