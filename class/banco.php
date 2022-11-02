<?php

class Banco
{

    //----- Conexão banco de dados -----

    private $pdo;   
    public $msg_erro;

    public function __construct()
    {
        //$nome = 'epiz_32002380_preventiva';
        //$user = 'epiz_32002380';
        //$senha = 'oQBmp84Ze1Im0W';
        //$host = 'sql110.epizy.com';
        
        $nome = 'preventiva';
        $user = 'root';
        $senha = '';
        $host = '127.0.0.1';

        try
        {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$user,$senha);
        }
        catch (Exception $e)
        {
            $this->msg_erro = $e->getMessage();
        }
    }

    //----- SELECT banco de dados -----

    //=====Regiao=====

    public function getRegioesTerminado()
    {
        $sql = $this->pdo->prepare("SELECT * FROM regioes ORDER BY Terminado");
        $sql->execute();

        $regioes = $sql->fetchAll();

        return $regioes;
    }

    public function getIdNomeRegiao()
    {
        $sql = $this->pdo->prepare("SELECT IdRegiao,Nome FROM regioes");
        $sql->execute();

        $regiao = $sql->fetchAll();

        return $regiao;
    }

    public function getTerminadoRegiao($idRegiao)
    {
        $sql = $this->pdo->prepare("SELECT Terminado FROM regioes WHERE IdRegiao = $idRegiao");
        $sql->execute();
        
        $terminado = $sql->fetchAll();
        
        return $terminado;
    }

    public function getNomeRegiao($idRegiao)
    {
        $sql = $this->pdo->prepare("SELECT Nome FROM regioes WHERE IdRegiao = $idRegiao");
        $sql->execute();

        $regiao = $sql->fetchAll();

        return $regiao;
    }

    public function getTotalTerminado()
    {
        $sql = $this->pdo->prepare("SELECT * FROM regioes WHERE ");
    }

    //====Cliente=====

    public function getCliente($idCliente)
    {
        $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE IdCliente = $idCliente");
        $sql->execute();

        $cliente = $sql->fetchAll();

        return $cliente;
    }

    public function getClientes($idRegiao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE IdRegiao = $idRegiao ORDER BY Data DESC");
        $sql->execute();

        $clientes = $sql->fetchAll();

        return $clientes;
    }

    public function getQuantClient($idRegiao)
    {
        $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE IdRegiao = $idRegiao");
        $sql->execute();

        $quantidade = $sql->rowCount();

        return $quantidade;
    }

    public function getFinalizado($id)
    {
        if($id == 'all')
        {
            $sql = $this->pdo->prepare("SELECT Pendencia FROM clientes WHERE Pendencia IS NOT NULL");
        }
        else
        {
           $sql = $this->pdo->prepare("SELECT Pendencia FROM clientes WHERE Pendencia IS NOT NULL AND IdRegiao = $id");
        }
        $sql->execute();

        $finalizado = $sql->rowCount();

        return $finalizado;
    }

    public function getInicializado($id)
    {
        $sql = $this->pdo->prepare("SELECT `Data` FROM `clientes` WHERE `Data` IS NOT NULL AND `IdRegiao` = $id");
        $sql->execute();

        $inicializado = $sql->rowCount();

        return $inicializado;
    }

    public function ultimos10()
    {
        $sql = $this->pdo->prepare("SELECT * FROM `clientes` WHERE `Data` IS NOT NULL ORDER BY Data DESC LIMIT 10  ");
        $sql->execute();

        $clientes = $sql->fetchAll();

        return $clientes;
    }

    public function getTotalCliente()
    {
        $sql = $this->pdo->prepare("SELECT * FROM clientes");
        $sql->execute();

        $quantidade = $sql->rowCount();

        return $quantidade;
    }

    public function getPendencias($var)
    {
        if($var == 'ok')
        {
            $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE Pendencia = 'ok'");
        }
        else
        {
            $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE Pendencia IS NOT NULL AND Pendencia <> 'OK' ");
        }
        $sql->execute();

        $quantidade = $sql->rowCount();
        
        return $quantidade;
    }

    //----- INSERT banco de dados -----

    public function setCliente($regiao,$nome)
    {
        $sql = $this->pdo->prepare("SELECT IdRegiao FROM regioes WHERE Nome = '$regiao'");
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $fetch = $sql->fetchAll();
            $idRegiao = $fetch[0]['IdRegiao'];

            $sql = $this->pdo->prepare("SELECT * FROM clientes WHERE Nome = '$nome'");
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                echo
                "<script>
                    alert('O cliente $nome ja foi adicionado na região $regiao');
                    document.location='../adicionar.php';
                </script>";
            }
            else
            {
                $sql = $this->pdo->prepare("INSERT INTO clientes (Nome,IdRegiao) VALUES ('$nome','$idRegiao')");

                if($sql->execute() == true)
                {
                    $terminado = $this->getTerminadoRegiao($idRegiao);

                    if($terminado[0]['Terminado'] == 2)
                    {
                        $this->updateRegiaoIncompleto($idRegiao);
                    }

                    echo
                    "<script>
                        alert('O novo cliente $nome foi adicionado a regiao $regiao');
                        document.location='../index.php';
                    </script>";
                    
                }
                else
                {
                    echo
                    "<script>
                        alert('Falha na tentativa de adicionar o novo cliente $nome na regiao $regiao');
                        document.location='../adicionar.php';
                    </script>";
                }
            }
        }
        else
        {
            echo
            "<script>
                alert('Região não encontrada no banco de dados');
                document.location='../adicionar.php';
            </script>";
        }
    }

    //----- UPDATE banco de dados -----

    //====Região=====

    public function updateRegiaoIncompleto($idRegiao)
    {
        $sql = $this->pdo->prepare("UPDATE `regioes` SET `Terminado` = '0' WHERE `IdRegiao` = $idRegiao");
        $sql->execute();
    }

    public function updateRegiaoAguardo($idRegiao)
    {
        $sql = $this->pdo->prepare("UPDATE `regioes` SET `Terminado` = '1' WHERE `IdRegiao` = $idRegiao");
        $sql->execute();
    }

    public function updateRegiaoTerminado($idRegiao)
    {
        $sql = $this->pdo->prepare("UPDATE `regioes` SET `Terminado` = '2' WHERE `IdRegiao` = $idRegiao");
        $sql->execute();
    }

    //====Cliente=====

    public function updatePendencia($idCliente)
    {
        $sql = $this->pdo->prepare("UPDATE `clientes` SET `Pendencia` = 'OK' WHERE `IdCliente` = $idCliente");
        $sql->execute();
        echo
            "<script>
                document.location='../index.php';
            </script>";
    }

    public function updateData($data,$idCliente)
    {
        $sql = $this->pdo->prepare("UPDATE `clientes` SET `Data` = '$data' WHERE `clientes`.`IdCliente` = $idCliente");
        if($sql->execute() == true)
        {
            echo
            "<script>
                alert('Data foi atualizada');
                document.location='../index.php';
            </script>";
        }
        else
        {
            echo
            "<script>
                alert('Não foi possivel atualizar a Data');
                document.location='../index.php';
            </script>";
        }
    }

    public function updateCliente($coluna,$post,$idCliente)
    {
        $sql = $this->pdo->prepare("UPDATE `clientes` SET `$coluna` = '$post' WHERE `clientes`.`IdCliente` = $idCliente");
        $sql->execute();
    }

    public function updateNull($coluna,$idCliente)
    {
        $cliente = $this->getCliente($_GET['id']);
        $this->updateRegiaoIncompleto($cliente[0]['IdRegiao']);
        $sql = $this->pdo->prepare("UPDATE `clientes` SET `$coluna` = NULL WHERE `clientes`.`IdCliente` = $idCliente");
        $sql->execute();
    }
}

?>