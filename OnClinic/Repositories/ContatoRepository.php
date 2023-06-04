<?php

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Contato
 */
class ContatoRepository extends Repository
{
    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    /**
     * Cadastra o Contato no banco de dados.
     * @param Contato $contato Modelo que contém os dados do contato.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function cadastrarContato(Contato $contato)
    {
        $sql = "INSERT INTO CONTATO VALUES (
            NULL, 
            '{$contato->getTipo()}',
            '{$contato->getDescricao()}',
            " . ($contato->getMedicoId() ? $contato->getMedicoId() : "NULL") . ",
            " . ($contato->getPacienteId() ? $contato->getPacienteId() : "NULL") . ");";

        try{
            $this->db->executeCommand($sql);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar contato.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Atualiza o Contato no banco de dados.
     * @param Contato $contato Modelo que contém os dados do contato.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function atualizarContato(Contato $contato)
    {
        $sql = "UPDATE CONTATO SET 
        TIPO = {$contato->getTipo()}, 
        DESCRICAO = {$contato->getDescricao()};";

        $this->db->executeCommand($sql);
    }

    /**
     * Exclui o Contato no banco de dados.
     * @param int $id código chave de contato.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function excluirContato(int $id)
    {
        $sql = "DELETE FROM CONTATO WHERE ID = {$id};";

        $this->db->executeCommand($sql);
    }
}

?>