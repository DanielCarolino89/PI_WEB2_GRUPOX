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
            '" . $medico->get_Nome() . "',
            '" . $medico->get_CRM() . "',
            '" . $medico->get_CPF() . "',
            '" . $medico->get_RG() . "',
            '" . $medico->get_Nascimento() . "',
            " . $medico->get_AtendimentoRemoto() . ",
            '" . $medico->get_Sobre() . "',
            '" . $medico->get_Especialidade() . "',
            " . $medico->get_Contato()->get_Id() . ",
            " . $medico->get_Endereco()->get_Id() . ",
            '" . $medico->get_Login()->get_Usuario() . "');";

        $db->DbCommandExec($sql);
    }
}

?>