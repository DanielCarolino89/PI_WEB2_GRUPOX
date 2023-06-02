<?php

class Contato
{
    private int $id;
    private string $tipo;
    private string $descricao;
    private ?int $medicoId = null;
    private ?int $pacienteId = null;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getMedicoId(){
        return $this->medicoId;
    }

    public function setMedicoId(int $id){
        if (isset($this->medicoId)){
            return;
        }

        $this->medicoId = $id;
    }

    public function getPacienteId(){
        return $this->pacienteId;
    }

    public function setPacienteId(int $id){
        if (isset($this->pacienteId)){
            return;
        }
            
        $this->pacienteId = $id;
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