<?php

/**
 * Classe responsável pelos comandos SQL da tabela Login
 */
class LoginRepository extends Repository
{
    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    /**
     * Cadastra o Login no banco de dados.
     * @throws PDOException caso ocorrer erro de sql.
     */
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

    /**
     * Consulta se já existe Login cadastrado no banco de dados para validação.
     * @return true caso existente
     */
    public function consultaSeUsuarioJaExiste(string $usuario) : bool
    {
        $sql = "SELECT 1 FROM LOGIN WHERE USUARIO = '{$usuario}'";

        return $this->queryFirstValue($sql);
    }

    /**
     * Realiza consulta no banco de dados pelo usuário e senha informado.
     * @return Id do Medico ou Paciente encontrado. Apenas um dos campos possuirá valor.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function Logar(string $usuario, string $senha)
    {
        $sql = "SELECT M.Id AS Medico, P.Id AS Paciente FROM LOGIN L
        LEFT JOIN Medico M on M.Login = L.Usuario
		LEFT JOIN paciente P ON P.Login = L.Usuario
        WHERE USUARIO = {$usuario} and SENHA = {$senha}";

        try{

        $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar login';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }
}
