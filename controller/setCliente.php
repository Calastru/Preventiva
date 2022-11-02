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
require_once('../class/banco.php');

$nome = $_POST['nome'];
$regiao = $_POST['regiao'];

$banco = new Banco;

$banco->setCliente($regiao,$nome);

?>