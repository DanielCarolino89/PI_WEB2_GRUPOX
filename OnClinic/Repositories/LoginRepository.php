<?php

class LoginRepository extends Repository
{
    public function __construct()
    {
        parent::__construct($db); 
    }

    public function CadastrarLogin(Login $login)
    {
        $sql = "INSERT INTO LOGIN VALUES (
            '{$login->get_Usuario()}',
            '{$login->get_Senha()}');";

        $db->DbCommandExec($sql);
    }

    public function ConsultaSeUsuarioJaExiste(string $usuario) : bool
    {
        $sql = "SELECT 1 FROM LOGIN WHERE USUARIO = '{$usuario}'";

        return $db->DbQueryFirstValue($sql);
    }
}

?>