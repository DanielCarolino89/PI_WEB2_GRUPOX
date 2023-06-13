<?php

require('Pessoa.php');
require('Especialidade.php');

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
        $this->crm = $dados['crm'] ?? "";
        $this->atendimentoRemoto = $dados['remoto'] ?? false;
        $this->sobre = $dados['sobre'] ?? "";
        
        $this->atribuirEspecialidades($dados);

        parent::atribuirDados($dados);
    }

    private function atribuirEspecialidades($dados)
    {
        if (!isset($dados['especialidades'])){
            return;
        }

        $linha = explode("\n", $dados['especialidades']);
        foreach($linha as $conteudo)
        {
            if (empty($conteudo)){
                continue;
            }            

            $especialidadeDados = explode("\t\t", $conteudo);
            
            $especialidade = new Especialidade();
            $especialidade->setDescricao($especialidadeDados[0]);
            $especialidade->setFaixaEtaria($especialidadeDados[1]);

            $this->addEspecialidade($especialidade);
        }
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
        $this->especialidades[] = $especialidade;
    }

    public function getEspecialidades(){
        return $this->especialidades; 
    }
}
?>