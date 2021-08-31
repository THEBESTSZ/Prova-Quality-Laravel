@extends('layouts.main')

@section('title', 'Dependente')

@section('content')

<div id="listaPessoas">
    <h1>Dependentes</h1>

    <div id="infoDep">

        <div id="fotoCadastro">
            <img src={{ isset($funcionario->foto) ? "/img/funcionarioFotos/".$funcionario->foto : "/images/fotoCadastro.png" }} width="77" height="77" />
        </div>

        <table id="tListaCad" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="tituloTab">Nome</td>
                <td>{{$funcionario->nome}}</td>
            </tr>
            <tr bgcolor="#cddeeb">
                <td class="tituloTab">Data de Nascimento</td>
                <td>{{$funcionario->nascimento}}</td>
            </tr>
            <tr>
                <td class="tituloTab">Email</td>
                <td>{{$funcionario->email}}</td>
            </tr>
        </table>

        <form id="frmAdicionaDep" action="/dependentes/enviar" method="post" enctype="multipart/form-data">
            @csrf

            <div class="agrupa mB mR">
                <label for="cNomeDep">Nome</label><br />
                <input type="text" name="nome" id="cNomeDep" />
            </div>
            <div class="agrupa">
                <label for="cDataNasc">Data de Nascimento</label><br />
                <input type="text" name="nascimento" id="cDataNasc" />
            </div>
            <div class="idFuncionario">
                <input type="hidden" name="funcionarioId" value="{{$funcionario->id}}" id="funcionarioId" />
            </div>

            <a href="javascript:;" onClick="document.getElementById('frmAdicionaDep').submit();" class="btPadrao">Adicionar</a>

        </form>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $mensagem)
                        <li>{{$mensagem}}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <table id="tLista" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <th width="60%" class="tL">Nome do Dependente</th>
                <th width="33%">Data de Nascimento</th>
                <th></th>
            </tr>

            <script type="text/javascript">
                function clicked(idD) {
                    if (confirm('Deseja realmente excluir este dependente?')) {
                        document.getElementById('removerDependente'+idD).submit();
                    } else {
                        return false;
                    }
                }
            </script>

            <?php $altRow = false ?>
            @foreach($dependentes as $dependente)
                <tr bgcolor={{($altRow ? "#cddeeb" : "transparent")}}>
                    <td>{{$dependente->nome}}</td>
                    <td align="center">{{$dependente->nascimento}}</td>
                    <form method="POST" id="removerDependente{{$dependente->id}}" enctype="multipart/form-data" action="/dependentes/remover">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="cId" value="{{$dependente->id}}">
                        <td align="center"><a href="javascript:;" onClick="return clicked({{$dependente->id}});" class="btRemover"></a></td>
                    </form>
                </tr>
                <?php $altRow = !$altRow ?>
            @endforeach
        </table>
    </div>

</div>

@endsection
