<?php

require_once('Repository.php');

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Login
 */
class LoginRepository extends Repository
{
    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    /**
     * Cadastra o Login no banco de dados.
     * @param Login $login Modelo que contém informações de usuário e senha.
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
     * Carrega usuário pelo banco de dados.
     * @param string $usuario usuario Carregado.
     * @return Login dados do usuário.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultarUsuario(string $usuario)
    {
        $sql = "SELECT usuario, senha FROM USUARIO WHERE USUARIO = {$usuario}";

        return $this->db->executeQuery($sql)->fetch();
    }

    /**
     * Alterar senha do usuário no banco de dados.
     * @param Login $login Modelo que contém informações de usuário e senha.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function alterarSenha(Login $login)
    {
        $sql = "UPDATE LOGIN SET SENHA = '{$login->getSenha()}' WHERE USUARIO = '{$login->getUsuario()}' ";

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar senha do usuário';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Deleta usuário no banco de dados.
     * @param string $usuario usuário que será deletado
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function deletarUsuario(string $usuario)
    {
        $sql = "DELETE LOGIN WHERE USUARIO = '{$usuario}'";

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao deletar usuario';
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
    public function Autenticar(string $usuario, string $senha)
    {
        $sql = "SELECT M.Id AS Medico, P.Id AS Paciente FROM LOGIN L
        LEFT JOIN Medico M on M.Login = L.Usuario
		LEFT JOIN paciente P ON P.Login = L.Usuario
        WHERE USUARIO = '{$usuario}' and SENHA = '{$senha}'";

        try{

            return $this->db->executeQuery($sql)->fetch();

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao autenticar login';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    
}
