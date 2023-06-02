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

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar login';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function consultaSeUsuarioJaExiste(string $usuario) : bool
    {
        $sql = "SELECT 1 FROM LOGIN WHERE USUARIO = '{$usuario}'";

        return $this->queryFirstValue($sql);
    }
}

?>