<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS da aplicação -->
    <link type="text/css" rel="stylesheet" href="/css/principal.css" />

    <title>@yield('title')</title>
</head>

<body>

<div id="conteudoGeral">

    <div id="topoGeral">
        <div id="logoTopo" onclick="location.href='/'" style="cursor:pointer;"></div>
        <div id="dirTopo"></div>
    </div>

    <div id="baixoGeral">

        <div id="menuEsq">
            <div id="titMenu">Menu de Opções</div>
            <a href="/">Início</a>
            <a href="/lista">Listar Cadastros</a>
            <a href="/form">Incluir Novo</a>
        </div>

        <div id="conteudoDir">

            @yield('content')

        </div> <!-- FIM CONTEUDO DIR -->

    </div>

</div>
<footer>
</footer>
</body>
</html>

