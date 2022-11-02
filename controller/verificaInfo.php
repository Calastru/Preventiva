<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../setting/css/padrao.css">
</head>
<body>
    
</body>
</html>

<?php
date_default_timezone_set('America/Sao_Paulo');

require_once("../class/banco.php");

$banco = new Banco();
$info = $banco->getCliente($_GET['id']);

if($info[0]['Data'] == null)
{
    $banco->updateData(date('Y/m/d', time()),$info[0]['IdCliente']);
    $banco->updateRegiaoIncompleto($info[0]['IdRegiao']);
}
else
{
    $banco->updatePendencia($info[0]['IdCliente']);
}
?>