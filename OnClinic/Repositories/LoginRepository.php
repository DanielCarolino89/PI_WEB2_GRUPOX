<?php

class LoginRepository extends Repository
{
    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    public function cadastrarLogin(Login $login)
    {
        $sql = "INSERT INTO LOGIN VALUES (
            '{$login->getUsuario()}',
            '{$login->getSenha()}');";

        $this->db->executeCommand($sql);
    }

    public function consultaSeUsuarioJaExiste(string $usuario) : bool
    {
        $sql = "SELECT 1 FROM LOGIN WHERE USUARIO = '{$usuario}'";

        return $this->queryFirstValue($sql);
    }
}

?>