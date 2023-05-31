<?php

class Medico extends Pessoa
{
    private string $crm;
    private bool $atendimentoRemoto;
    private string $sobre;
    private $especialidades = [];

    public function __construct($dados)
    {
        $this->atribuirDados($dados);
    }

    protected function atribuirDados($dados)
    {
        $this->crm = $dados['crm'];
        $this->atendimentoRemoto = $dados['remoto'];
        $this->sobre = $dados['sobre'];

        parent::atribuirDados($dados);
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

    public function addEspecialidade(Especialidade $especialidade)
    {
        $especialidades[] = $especialidade;
    }

    public function getEspecialidadesFormatada(){
        //implementar
    }
}


?>