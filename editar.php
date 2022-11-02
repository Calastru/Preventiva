<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="setting/css/editar.css">
    <link rel="shortcut icon" type="image/x-icon" href="setting/image/favicon.png" />
    <title>Manutenção Preventiva</title>
    <?php
    include_once('class/edicao.php');
    $info = new Edicao($_GET['id']);
    ?>
</head>

<body>
    <header>
        <nav>
            <a href="index.php">&#8678</a>
        </nav>
        <h1>Editar as informações</h1>
    </header>
    <main>
        <form action="controller/editarInfo.php?id=<?php echo $_GET['id']; ?>" method="post">
            <fieldset>
                <legend>Cliente: <?php echo utf8_encode($info->getNome()) ?></legend>
                <div>
                    <nobr>
                        <label for="data">Data:</label>
                        <input type="Date" name="Data" id="data" value="<?php echo $info->getData() ?>">
                    </nobr>
                </div>
                <div>
                    <nobr>
                        <label for="text">Pendencia:</label>
                        <textarea name="Pendencia" id="text" rows="7" placeholder="Descrição" autofocus><?php echo utf8_encode($info->getPendencia()) ?></textarea>
                    </nobr>
                </div>
                <input type="submit" value="Confirmar">
            </fieldset>
        </form>
    </main>
</body>

</html>