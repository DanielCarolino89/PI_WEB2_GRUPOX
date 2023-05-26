<?php

class PacienteRepository extends Repository
{

    public function __construct(dbUtils $db){
        parent::__construct($db); 
    }

    public function RegistrarPaciente(Paciente $paciente)
    {
        $sql = "INSERT INTO PACIENTE VALUES (
            null,
            '" . $paciente->get_Nome() . "',
            '" . $paciente->get_CPF() . "',
            '" . $paciente->get_RG() . "',
            '" . $paciente->get_DataNascimento() . "',
            " . $paciente->get_Contato()->get_Codigo() . ",
            " . $paciente->get_Endereco()->get_Codigo() . ",
            " . $paciente->get_Login()->get_Usuario() . ");";

        $db->DbCommandExec($sql);
    }

    public function ConsultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Paciente where CPF = '" . $cpf . "'";

        return $db->DbQueryFirstValue($sql);
    }
}

?>