<?php

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Especialidade
 */
class EspecialidadeRepository extends Repository
{
    public function __construct(Database $db){
        parent::__construct($db);
    }

    /**
     * Cadastra a Especialidade do Médico no banco de dados.
     * @param Especialidade $especialidade Modelo que contém os dados da especialidade do médico.
     * @throws PDOException caso ocorrer erro de sql.
     */
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