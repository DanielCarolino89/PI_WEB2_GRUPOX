<?php

class Contato
{
    private int $id;
    private string $tipo;
    private string $descricao;
    private int $idMedico;
    private int $idPaciente;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdMedico(){
        return $this->idMedico;
    }

    public function setIdMedico(int $id){
        if (isset($this->idPaciente)){
            return;
        }

        $this->idMedico = $id;
    }

    public function getIdPaciente(){
        return $this->idPaciente;
    }

    public function setIdPaciente(int $id){
        if (isset($this->idMedico)){
            return;
        }
            
        $this->idPaciente = $id;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao(string $descricao){
        $this->descricao = $descricao;
    }
}

?>