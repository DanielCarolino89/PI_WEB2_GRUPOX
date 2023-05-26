<?php

class MedicoRepository extends Repository
{
    public function __construct(dbUtils $dbUtils){
        parent::__construct($db); 
    }

    public function CadastrarMedico(Medico $medico)
    {       
        $sql = "INSERT INTO MEDICO VALUES(
            null,
            '{$medico->getNome()}',
            '{$medico->getCRM()}',
            '{$medico->getCPF()}',
            '{$medico->getRG()}',
            '{$medico->getNascimento()}',
            '{$medico->getAtendimentoRemoto()}',
            '{$medico->getSobre()}',
            '{$medico->getEspecialidade()}',
             {$medico->getContato()->getId()},
             {$medico->getEndereco()->getId()},
            '{$medico->getLogin()->getUsuario()}');";

        $db->DbCommandExec($sql);
    }

    public function ConsultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Medico where CPF = '{$cpf}'";

        return $db->DbQueryFirstValue($sql);
    }
}

?>