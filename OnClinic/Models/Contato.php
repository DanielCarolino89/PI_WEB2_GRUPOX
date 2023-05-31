<?php

class Contato
{
    private int $id;
    private string $tipo;
    private string $descricao;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTipo(){
        return $this->$tipo;
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