<?php

class Medico extends Pessoa
{
    private string $crm;
    private bool $atendimentoRemoto;
    private string $sobre;
    private string $especialidade;

    public function __construct($dados)
    {
        AtribuirDados($dados);
    }

    protected function AtribuirDados($dados)
    {
        $this->crm = $dados['crm'];
        $this->atendimentoRemoto = $dados['remoto'];
        $this->sobre = $dados['sobre'];
        $this->especialidade = $dados['especialidade'];

        parent::AtribuirDados($dados);
    }


    public function getCRM(): string {
        return $this->crm;
    }

    public function getAtendimentoRemoto(): bool {
        return $this->atendimentoRemoto;
    }

    public function getSobre(): string {
        return $this->sobre;
    }

    public function getEspecialidade(): string {
        return $this->especialidade;
    }
}


?>