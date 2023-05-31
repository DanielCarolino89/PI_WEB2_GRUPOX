<?php
class Paciente extends Pessoa
{
    public function __construct($dados)
    {
        AtribuirDados($dados);
    }
}

?>