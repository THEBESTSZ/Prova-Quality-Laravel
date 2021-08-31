@extends('layouts.main')

@section('title', 'Listagem')

@section('content')

<script type="text/javascript">
    function status(id){
        document.getElementById("paginaAtual"+id).value = $(".pagination").find('.active').text();
        document.getElementById('funcionarioStatus'+id).submit();
    }

    function clicked() {
        var numberOfChecked = $('input[class=checkBoxValue]:checked').length;
        if(numberOfChecked > 0){
            if (confirm('Deseja realmente excluir os funcionários selecionados?')) {
                deleteSelected();
            } else {
                return false;
            }
        }
    }
</script>

<div id="listaPessoas">
    <h1>Cadastros</h1>

    <a href="javascript:;" onClick="return clicked();" class="btPadraoExcluir">Excluir</a>

    <table id="tLista" cellpadding="0" cellspacing="0" border="0">

        <tr>
            <th width="5%"><input type="checkbox" id="selectAll"  /></th>
            <th width="5%">ID</th>
            <th width="5%">Foto</th>
            <th class="tL">Nome</th>
            <th width="15%">Dt Nasc</th>
            <th width="25%">Email</th>
            <th width="7%">Dep</th>
            <th width="7%">St</th>
        </tr>

        <!-- This is a comment

        <tr bgcolor="#cddeeb">
            <td align="center" style="border-left:0;"><input name="chkStatus" type="checkbox" class="checkbox" value="" id="chk_0" /></td>
            <td align="center">1</td>
            <td align="center"><img src="images/fotoCadastro.png" width="20" height="20" /></td>
            <td><a href="form.html" class="linkUser" title="Clique aqui para editar este cadastro." id="nm_">Fulado de Tal</a></td>
            <td align="center">31/12/1970</td>
            <td align="center">email@provedor.com</td>
            <td align="center">
                <a href="/dependentes" class="btAdicionar" title="Adicionar dependentes para este cadastro."></a>
            </td>
            <td align="center">
                <a href="javascript:;" class="btVerde" title="Ativar/Desativar este cadastro." id="bol_0"></a>
            </td>
        </tr>

        -->
        <?php $altRow = false ?>
        @foreach($funcionarios as $funcionario)
            <tr bgcolor={{ ($altRow ? "#f0f0f0" : "#cddeeb") }}>
                <td align="center" style="border-left:0;"><input name="{{$funcionario->id}}" type="checkbox" class="checkBoxValue" value="" id="{{$funcionario->id}}" /></td>
                <td align="center">{{$funcionario->id}}</td>
                <td align="center"><img src={{ isset($funcionario->foto) ? "/img/funcionarioFotos/".$funcionario->foto : "/images/fotoCadastro.png" }} width="20" height="20" /></td>
                <td><a href="form.html" class="linkUser" title="Clique aqui para editar este cadastro." id="nm_">{{ $funcionario->nome }}</a></td>
                <td align="center">{{ $funcionario->nascimento }}</td>
                <td align="center">{{ $funcionario->email }}</td>
                <td align="center">
                    <a href="/dependentes/{{ $funcionario->id }}" class="btAdicionar" title="Adicionar dependentes para este cadastro."></a>
                </td>

                <form method="POST" id="funcionarioStatus{{$funcionario->id}}" enctype="multipart/form-data" action="/funcionario/status">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="cId" value="{{$funcionario->id}}">
                    <input type="hidden" name="status" value="{{!($funcionario->status)}}">
                    <input type="hidden" name="paginaAtual" id="paginaAtual{{$funcionario->id}}" value="">
                </form>

                <td align="center">
                    <a href="javascript:;" onClick="status({{$funcionario->id}});" title="Ativar/Desativar este cadastro." id="bol_0" class={{ ($funcionario->status) ? "btVerde" : "btCinza" }} ></a>
                </td>
            </tr>
            <?php $altRow = !$altRow ?>
        @endforeach


        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous">
        </script>
        <script type="text/javascript">
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });

            $("input[type=checkbox]").click(function() {
                if (!$(this).prop("checked")) {
                    $("#selectAll").prop("checked", false);
                }
            });

        </script>

        <script type="text/javascript">

            function promessa(arrayIds){
                $.ajax({
                    url: "{{ url('/funcionario/remover')}}",
                    type: 'delete',
                    dataType: "JSON",
                    data: {
                        "ids": arrayIds
                    },
                    success: function (response)
                    {
                        //console.log(response); // resposta
                        //$("body").html(response);

                    },
                    error: function(xhr) {
                        //console.log(xhr.responseText); // debug
                    }
                });
            }

            function deleteSelected() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                arrayIds = [];
                enter = false;
                $('input[class=checkBoxValue]').each(function () { // guardar tudo em os ids em uma lista para deletar em uma unica requisicao...
                    if(this.checked){
                        enter = true;
                        arrayIds.push(this.id);
                    }
                });

                //console.log(arrayIds);
                if(enter){
                    promessa(arrayIds);
                    window.location.href = "{{ url('/lista')}}";
                }

            }
        </script>


    </table>

</div>

<div class="pagination-centered"> {{ $funcionarios->links('pagination::semantic-ui') }} </div>


<!--
<div id="paginacao">
    <a href="" class="btSeta1"></a> <div id="pags">1 de 10</div> <a href="" class="btSeta2"></a>
    <select id="paginas">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
</div>
-->

@endsection
