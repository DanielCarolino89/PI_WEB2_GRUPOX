<?php

class Especialidade
{
    private int $id;
    private string $descricao;
    private string $faixaEtaria;
    private int $medicoId;

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    } 

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }

    public function getMedicoId() : int {
        return $this->medicoId;
    }

    public function setMedicoId(int $medicoId){
        $this->medicoId = $medicoId;
    }

    public function getFaixaEtaria() : int {
        return $this->faixaEtaria;
    }

    public function setFaixaEtaria(string $faixaEtaria){
        $this->faixaEtaria = $faixaEtaria;
    }
}

?>