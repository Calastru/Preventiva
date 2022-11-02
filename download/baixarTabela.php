<?php

require_once("class/banco.php");

class Atualizar
{
    public function __construct()
    {
        $this->banco = new Banco();
        $this->atualizarTXT();
    }

    public function atualizarTXT()
    {
        $nomeRegiao = $this->banco->getIdNomeRegiao();

        unlink("3 AGENDA PREVENTIVA C.A..txt");
        $arquivo = fopen("3 AGENDA PREVENTIVA C.A..txt", "a+");
        fwrite($arquivo,"PREVENTIVAS DE CONTROLE DE ACESSO");
        fwrite($arquivo, "\n");
        fwrite($arquivo,"--------------------------------------------------------");
        fwrite($arquivo, "\n");
        foreach($nomeRegiao as $regiao)
        {
            fwrite($arquivo,strtoupper(">>> ".$regiao['Nome']));
            fwrite($arquivo, "\n");

            $nomeCliente = $this->banco->getClientes($regiao['IdRegiao']);
            
            foreach($nomeCliente as $cliente)
            {
                fwrite($arquivo, "\n");
                fwrite($arquivo,strtoupper($cliente['Nome']." - ".str_replace("-", "/",$cliente['Data'])));
                if($cliente['Pendencia'] != null)
                {
                    fwrite($arquivo," - ".$cliente['Pendencia']);
                }
                fwrite($arquivo, "\n");
            }
            fwrite($arquivo, "\n");
            fwrite($arquivo,"--------------------------------------------------------");
            fwrite($arquivo, "\n");
        }
        
        fclose($arquivo);
    }
}
?>