<?php

class PacienteRepository extends Repository
{

    public function __construct(Database $db){
        parent::__construct($db); 
    }

    public function registrarPaciente(Paciente $paciente)
    {
        $sql = "INSERT INTO PACIENTE VALUES (
            null,
            '{$paciente->getNome()}',
            '{$paciente->getCPF()}',
            '{$paciente->getRG()}',
            '{$paciente->getDataNascimento()}',
            '{$paciente->getLogin()->getUsuario()}');";

        try{

            $this->db->executeCommand($sql);
            
        }catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar paciente.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function consultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Paciente where CPF = '{$cpf}'";

        return $this->queryFirstValue($sql);
    }
}

?>