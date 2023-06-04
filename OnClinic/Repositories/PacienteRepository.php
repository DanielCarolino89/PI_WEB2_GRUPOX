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
            '{$paciente->getDataNascimento()->format("yyyy/MM/dd")}',
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
}

?>