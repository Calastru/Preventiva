<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção Preventiva</title>
    <script src="js/menu.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="setting/image/favicon.png" />
    <link rel="stylesheet" href="setting/css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <?php
    ini_set('default_charset', 'utf-8');
    require_once("class/tabela.php");
    require_once("download/baixarTabela.php");
    //require_once("controller/session.php");
    $atualizar = new Atualizar;
    ?>
</head>
<body>
    <header id="header">
        <nobr>
            <h1>Lista de clientes</h1>
        </nobr>
        <nav id="nav">
            <button id="btn-mobile">Menu <span id="hamburger"></span></button>
            
            <ul id="menu">
                <li><a href="adicionar.php">Adicionar novo cliente</a></li>
                <li><a href="2 AGENDA PREVENTIVA C.A..txt" download>Baixar lista em .txt</a></li>
                <li><a href="geral.php">Geral</a></li>
            </ul>
            <!--
                <form action="" class="search">
                    <label for="busca">Buscar :</label>
                    <input type="search" id="busca" placeholder="Nome do cliente" class="search_input" maxlength="64" autofocus>
                </form>
            --> 
        </nav>
    </header>
    <main>
        <table>
            <caption><b>Lista dos locais</b></caption>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Atendimento</th>
                    <th>Pendencia</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = new Listar;
                ?>
            </tbody>
        </table>
    </main>
    <footer>
    </footer>
</body>

</html>