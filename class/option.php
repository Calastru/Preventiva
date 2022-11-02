<?php
require_once("banco.php");

class Option
{
    public function __construct()
    {
        $this->banco = new Banco();
        $this->listarOption();
    }

    private function listarOption()
    {
        $regiao = $this->banco->getIdNomeRegiao();
        
        foreach($regiao as $info)
        {
            echo '<option value="'.utf8_encode($info['Nome']).'">';
        }
    }
}
?>