<?php

require_once('Repository.php');

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Paciente
 */
class PacienteRepository extends Repository
{

    public function __construct(Database $db){
        parent::__construct($db); 
    }

    /**
     * Cadastra o Paciente no banco de dados.
     * @param Paciente $paciente Modelo que contém os dados do paciente.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function registrarPaciente(Paciente $paciente)
    {
        $sql = "INSERT INTO PACIENTE VALUES (
            null,
            '{$paciente->getNome()}',
            '{$paciente->getCPF()}',
            '{$paciente->getRG()}',
            '{$paciente->getDataNascimento()->format('Y/m/d')}',
            '{$paciente->getLogin()->getUsuario()}');";

        try{
            $this->db->executeCommand($sql);
            $idInserido = $this->getLastInsertId();
            $paciente->setId($idInserido);
            
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar paciente.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Consulta através do CPF se o Paciente já contém cadastro.
     * @param string $cpf CPF do paciente que será consultado.
     * @return true Se já existir CPF vinculado a um cadastro
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Paciente where CPF = '{$cpf}'";

        return $this->queryFirstValue($sql);
    }

    /**
     * Consultar paciente no banco de dados
     * @param int $id Id do pacinete.
     * @return Paciente dados do paciente
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultaPaciente(int $id)
    {
        $sql = "SELECT 
        id, 
        nome,
        nascimento,
        cpf,
        rg,
        usuario,
        senha
        FROM PACIENTE
        RIGHT JOIN LOGIN ON PACIENTE.LOGIN = LOGIN.USUARIO
        WHERE ID = {$id};";

        return $this->db->executeQuery($sql)->fetch();
    }

    /**
     * Exclui paciente no banco de dados
     * @param int $id Id do pacinete.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function excluirPaciente(int $id)
    {
        $sql = "DELETE FROM PACIENTE WHERE ID = {$id}";

        try{
            $this->db->executeCommand($sql);
            
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao excluir paciente.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Altera o Paciente no banco de dados.
     * @param Paciente $paciente Modelo que contém os dados do paciente.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function alterarPaciente(Paciente $paciente)
    {
        $sql = "UPDATE PACIENTE SET
            NOME = '{$paciente->getNome()}',
            CPF = '{$paciente->getCPF()}',
            RG = '{$paciente->getRG()}',
            NASCIMENTO = '{$paciente->getDataNascimento()->format('Y/m/d')}'
            WHERE ID = {$paciente->getId()}";

        try{

            $this->db->executeCommand($sql);
            
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar paciente.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

        /**
     * Consulta Id do Paciente através do CPF;
     * @param string $cpf CPF do paciente que será consultado.
     * @return int id do paciente.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultaIdPorCPF(string $cpf) : int
    {
        $sql = "SELECT id from PACIENTE where CPF = '{$cpf}'";

        return $this->queryFirstValue($sql);
    }

    public function consultarUsuarioDoPaciente(int $id)
    {
        $sql = "SELECT Login FROM PACIENTE WHERE ID = {$id}";

        return $this->queryFirstValue($sql);
    }

    public function removerAssociacaoLogin(int $id)
    {
        $sql = "UPDATE PACIENTE SET LOGIN = NULL WHERE ID = {$id}";

        $this->db->executeCommand($sql);
    }
}

?>