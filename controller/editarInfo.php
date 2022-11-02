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
    $banco = new Banco();

        if($_POST['Data'] != null)
        {
            $banco->updateCliente('Data',$_POST['Data'],$_GET['id']);
        }
        else
        {
            $banco->updateNull('Data',$_GET['id']);
        }

        if($_POST['Pendencia'] != null)
        {
            $banco->updateCliente('Pendencia',$_POST['Pendencia'],$_GET['id']);
        }
        else
        {
            $banco->updateNull('Pendencia',$_GET['id']);
        }

        echo
            "<script>
                document.location='../index.php';
            </script>";

    
?>