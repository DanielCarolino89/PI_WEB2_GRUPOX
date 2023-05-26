<?php

class Login
{
    private string $usuario;
    private string $senha;

    public function get_Usuario() : string {
        return $this->usuario;
    }

    public function set_Usuario(string $usuario){
        $this->usuario = $usuario;
    }

    public function get_Senha() : string{
        return $this->senha;
    }

    public function set_Senha(string $senha){
        $this->senha = $senha;
    }
}

?>