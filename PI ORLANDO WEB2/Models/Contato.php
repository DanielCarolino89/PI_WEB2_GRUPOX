<?php

class Contato
{
    private int $id;
    private string $tipo;
    private string $descricao;

    public function get_Id(){
        return $this->id;
    }

    public function set_Id($id){
        $this->id = $id;
    }

    public function get_Tipo(){
        return $this->$tipo;
    }

    public function set_Tipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function get_Descricao(){
        return $this->descricao;
    }

    public function set_Descricao(string $descricao){
        $this->descricao = $descricao;
    }
}

?>