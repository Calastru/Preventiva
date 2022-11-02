<?php
ini_set('default_charset','utf-8');

require_once("banco.php");

class Listar
{
    public function __construct()
    {
        $this->banco = new Banco();
        $this->listarRegioes();
    }

    private function listarRegioes()
    {
        $regioes = $this->banco->getRegioesTerminado();

        foreach($regioes as $info)
        {
            $finalizado = $this->banco->getFinalizado($info['IdRegiao']);
            $quantCliente = $this->banco->getQuantClient($info['IdRegiao']);

            if($info['Terminado'] != 2)
            {
                if($this->banco->getInicializado($info['IdRegiao']) == 0)
                {
                    $this->banco->updateRegiaoAguardo($info['IdRegiao']);
                }

                if($finalizado == $quantCliente)
                {
                    echo "<tr>";
                    echo "<th>Região: <s>".utf8_encode($info['Nome'])."</s></th>";
                    echo "<th>Finalizado: <nobr>".$finalizado." / ".$quantCliente."</nobr></th>";
                    $this->banco->updateRegiaoTerminado($info['IdRegiao']);
                }
                else
                {
                    echo "<tr>";
                    echo "<th>Região: ".utf8_encode($info['Nome'])."</th>";
                    echo "<th>Finalizado: <nobr>".$finalizado." / ".$quantCliente."</nobr></th>";
                }
            }
            else
            {
                echo "<tr>";
                echo "<th>Região: <s>".utf8_encode($info['Nome'])."</s></th>";
                echo "<th>Finalizado: <nobr>".$finalizado." / ".$quantCliente."</nobr></th>";
            }
            echo "</tr>";

            $this->listarClientes($info['IdRegiao']);
        }
    }

    private function listarClientes($IdRegiao)
    {
        $clientes = $this->banco->getClientes($IdRegiao);

        foreach($clientes as $info)
        {
            echo '<tr>';
            if($info['Map'] == null)
            {
                echo '<td>'.utf8_encode($info['Nome']).'</td>'; 
            }
            else
            {
                echo '<td>'.utf8_encode($info['Nome']).'<a href="'.$info['Map'].'" target="_blank" class="mapa"><i class="fa fa-map-marker"></i></a></td>';
            }

            echo '<td><input type="date" name="Data" id="" value="'.$info['Data'].'" disabled></td>';
            echo '<td><textarea name="Pendencia_'.$info['IdCliente'].'_'.$IdRegiao.'" id="Pendencia_'.$info['IdCliente'].'_'.$IdRegiao.'" rows="3" maxlength="510" placeholder="Descrição" disabled>'.utf8_encode($info['Pendencia']).'</textarea></td>';

            //-----Opções-----

            if($info['Data'] == null)
            {
                echo '<td><a href="controller/verificaInfo.php?id='.$info['IdCliente'].'">Salvar</a></td>';
                
            }
            else
            {
                if($info['Pendencia'] != null)
                {
                    echo '<td><a id="editar" href="editar.php?id='.$info['IdCliente'].'">Editar</a></td>';
                }
                else
                {
                    echo
                        '<td><a href="controller/verificaInfo.php?id='.$info['IdCliente'].'">Salvar</a>
                        <a id="editar" href="editar.php?id='.$info['IdCliente'].'">Editar</a></td>';
                }
            }
            echo "</tr>";
        }
    }
}

?>