<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção Preventiva</title>
    <link rel="shortcut icon" type="image/x-icon" href="setting/image/favicon.png" />
    <link rel="stylesheet" href="setting/css/adicionar.css">
    <?php
    require_once("class/option.php");
    ?>
</head>

<body>
    <header>
        <nav>
            <a href="index.php">&#8678</a>
        </nav>
    </header>
    <main>
        <h2>Novo Cliente</h2>
        <form action="controller/setCliente.php" method="post">
            <fieldset>
                <legend>Informações: </legend>
                <nobr>
                    <label for="nome">Cliente:</label>
                    <input type="text" name="nome" id="nome" autofocus maxlength="255" placeholder="Nome" required>
                </nobr>
                <nobr>
                    <label for="regiao">Região:</label>
                    <input list="regiaoLista" name="regiao" id="regiao" placeholder="Escolha uma região" autocomplete="on" required>
                    <datalist id="regiaoLista">
                        <?php
                        $option = new Option;
                        ?>
                    </datalist>
                </nobr>
                <nobr>
                    <input type="submit" value="Confirmar">
                    <input type="reset" value="Resetar">
                </nobr>
            </fieldset>
        </form>
    </main>
    <footer>

    </footer>
</body>

</html>