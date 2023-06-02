<?php

require_once('Repository.php');

class MedicoRepository extends Repository
{
    public function __construct(Database $db){
        parent::__construct($db); 
    }

    public function cadastrarMedico(Medico $medico)
    {   
        $sql = "INSERT INTO MEDICO VALUES(
            null,
            '{$medico->getNome()}',
            '{$medico->getCRM()}',
            '{$medico->getCPF()}',
            '{$medico->getRG()}',
            '{$medico->getDataNascimento()->format("yyyy/MM/dd")}',
            '{$medico->getAtendimentoRemoto()}',
            '{$medico->getSobre()}',
            '{$medico->getLogin()->getUsuario()}');";

        try{
            $this->db->executeCommand($sql);
            $idInserido = $this->getLastInsertId();
            $medico->setId($idInserido);
        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao cadastrar médico.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    public function consultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Medico where CPF = '{$cpf}'";

        return $this->queryFirstValue($sql);
    }

    public function buscarMedico(string $nome)
    {
        $sql = "SELECT M.NOME, E.DESCRICAO, M.CIDADE FROM MEDICO M
        LEFT JOIN ESPECIALIDADE E ON E.MEDICOID = M.ID
         WHERE NOME LIKE '{$nome}'";

        return $this->db->executeQuery($sql);
    }

    public function consultarDetalhesDoMedico(int $id)
    {
        $sql = "SELECT M.NOME, M.CRM, M.REMOTO, M.SOBRE, M.NASCIMENTO,
        E.DESCRICAO,
        C.TIPO, C.DESCRICAO, 
        E.LOGRADOURO, E.NUMERO, E.BAIRRO, E.CIDADE, E.UF, E.COMPLEMENTO
        FROM MEDICO
        LEFT JOIN ESPECIALIDADE E ON E.MEDICOID = M.ID 
        LEFT JOIN CONTATO C ON C.MEDICOID = M.ID 
        LEFT JOIN ENDERECO E ON E.MEDICOID = M.ID 
        WHERE ID = {$id};";

        return $this->db->executeQuery($sql);
    }
}

?>