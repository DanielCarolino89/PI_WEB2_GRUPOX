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
             {$paciente->getContato()->getId()},
             {$paciente->getEndereco()->getId()},
            '{$paciente->getLogin()->getUsuario()}');";

        $this->db->executeCommand($sql);
    }

    public function consultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Paciente where CPF = '{$cpf}'";

        return $this->QueryFirstValue($sql);
    }
}

?>