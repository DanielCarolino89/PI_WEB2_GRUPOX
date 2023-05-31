<?php

class ContatoRepository extends Repository
{
    public function __construct(Database $db)
    {
        parent::__construct($db); 
    }

    public function cadastrarContato(Contato $contato)
    {
        $sql = "INSERT INTO CONTATO VALUES (
            NULL, 
            '{$contato->getTipo()}',
            '{$contato->getDescricao()}',
            {$contato->getIdMedico()},
            {$contato->getIdPaciente()});";

        $this->db->executeCommand($sql);
    }

    public function atualizarContato(Contato $contato)
    {
        $sql = "UPDATE CONTATO SET 
        TIPO = {$contato->getTipo()}, 
        DESCRICAO = {$contato->getDescricao()};";

        $this->db->executeCommand($sql);
    }

    public function excluirContato(int $id)
    {
        $sql = "DELETE FROM CONTATO WHERE ID = {$id};";

        $this->db->executeCommand($sql);
    }
}

?>