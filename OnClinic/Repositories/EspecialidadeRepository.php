<?php

class EspecialidadeRepository extends Repository
{
    public function __construct(Database $db){
        parent::__construct($db);
    }

    public function registrarEspecialidade(Especialidade $especialidade)
    {
        $sql = "INSERT INTO ESPECIALIDADE VALUES (
            null,
            '{$especialidade->getDescricao()}',
            '{$especialidade->getFaixaEtaria()}',
            {$especialidade->getMedicoId()});";

        $this->db->ExecuteCommand($sql);
    }
}

?>