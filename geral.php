<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="setting/css/geral.css">
    <link rel="shortcut icon" type="image/x-icon" href="setting/image/favicon.png" />
    <title>Manutenção Preventiva</title>
    <?php
    require_once("class/atendimentos.php");
    $Atendimento = new Atendimento;

    ?>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">&#8678</a>
        </nav>
        <nobr>
            <h1>Informações</h1>
        </nobr>
    </header>
    <main>
        <div>
            <h3>Atendimentos</h3>
            <div>
                <label for="file">Regiões: 14</label>
                <br>
                <span id="concluido">9</span><progress id="file" value="9" max="14"> 14% </progress><span id="fazer">5</span>
            </div>
            <br>
            <?php
                $Atendimento->totalAtendimentos();
            ?>
            <br>
            
        </div>
        <div>
            <h3>Clientes que tiveram ocorrencias na preventiva</h3>
            <!--<label for="ocorrencia">Pendencias: 7</label>--> 
            
            <?php
                $Atendimento->totalPendencia();
            ?>
        </div>
        <div>
            <h2>Ultimos clientes atendidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Atendimento</th>
                        <th>Pendencia</th>
                        <th>Região</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $Atendimento->ultimosAtendimentos();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>