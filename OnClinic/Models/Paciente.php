<?php

class Paciente extends Pessoa
{
    public function __construct($dados)
    {
        $this->AtribuirDados($dados);
    }
}

?>