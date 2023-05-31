<?php

class Login
{
    private string $usuario;
    private string $senha;

    public function getUsuario() : string {
        return $this->usuario;
    }

    public function setUsuario(string $usuario){
        $this->usuario = $usuario;
    }

    public function getSenha() : string{
        return $this->senha;
    }

    public function setSenha(string $senha){
        $this->senha = $senha;
    }
}

?>