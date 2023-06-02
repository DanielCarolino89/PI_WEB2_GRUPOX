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

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar especialidade.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function excluirEspecialidade(int $id)
    {
        $sql = "DELETE FROM ESPECIALIDADE WHERE ID = {$id};";

        $this->db->executeCommand($sql);
    }
}

?>