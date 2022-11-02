<?php
require_once('banco.php');

class Edicao
{
    private $banco;
    private $nome;
    private $data;
    private $pendencia;

    public function __construct($id)
    {
        $this->banco = new Banco();
        $this->getInfo($id); 
    }

    private function getInfo($id)
    {
        $cliente = $this->banco->getCliente($id);
        $this->nome = $cliente[0]['Nome'];
        $this->data = $cliente[0]['Data'];
        $this->pendencia = $cliente[0]['Pendencia'];
    }

    public function getNome()
    {
        return $this->nome;
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function getPendencia()
    {
        return $this->pendencia;
    }
}
?>