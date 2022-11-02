<?php
ini_set('default_charset','utf-8');

require_once("banco.php");

class Atendimento
{
    public function __construct()
    {
        $this->banco = new Banco();
    }

    public function ultimosAtendimentos()
    {
        $clientes = $this->banco->ultimos10();

        foreach($clientes as $info)
        {
            $regiao = $this->banco->getNomeRegiao($info['IdRegiao']);

            echo "<tr>";
            echo "<td>".utf8_encode($info['Nome'])."</td>";
            echo "<td>".$info['Data']."</td>";
            echo '<td><textarea rows="3" placeholder="Descrição" disabled>'.utf8_encode($info['Pendencia']).'</textarea></td>';
            echo '<td>'.utf8_encode($regiao[0]['Nome']).'</td>';
            echo "</tr>";
        }
    }

    public function totalAtendimentos()
    {
        $clientes = $this->banco->getTotalCliente();
        $finalizados = $this->banco->getFinalizado('all');
        $faltante = $clientes - $finalizados;

        echo '<div>';
        echo '<label for="cliente">Clientes: '.$clientes.'</label>';
        echo '<br>';
        echo '<span id="concluido">'.$finalizados.'</span><progress id="cliente" value="'.$finalizados.'" max="'.$clientes.'"> 32% </progress><span id="fazer">'.$faltante .'</span>';
        echo '</div>';
    }

    public function totalPendencia()
    {
        $quantidade[0] = $this->banco->getPendencias('ok');
        $quantidade[1] = $this->banco->getPendencias('ocorrencia');
        $total = $quantidade[0] + $quantidade[1];
        
        echo '<span id="pendencia">'.$quantidade[1].'</span><progress id="ocorrencia" value="'.$quantidade[1].'" max="'.$total.'"> 32% </progress><span id="ok">'.$quantidade[0].'</span>';

    }
}
?>