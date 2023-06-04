<?php

require_once('Repository.php');

/**
 * Classe responsável pela exceução dos comandos SQL da tabela Medico
 */
class MedicoRepository extends Repository
{
    public function __construct(Database $db){
        parent::__construct($db); 
    }

    /**
     * Cadastra o Médico no banco de dados.
     * @param Medico $medico Modelo que contém os dados do médico.
     * @throws PDOException caso ocorrer erro de sql.
     */
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

    /**
     * Consulta através do CPF se o Médico já contém cadastro.
     * @param string $cpf CPF do médico que será consultado.
     * @return true Se já existir CPF vinculado a um cadastro
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultaSeCPFJaExiste(string $cpf) : bool
    {
        $sql = "SELECT 1 from Medico where CPF = '{$cpf}'";

        return $this->queryFirstValue($sql);
    }

    /**
     * Realiza busca de médicos conforme filtros aplicados.
     * @param string $conteudo conteúdo que será aplicado o filtro.
     * @param string $filtro Filtro em que será realizada a busca.
     * @throws PDOException caso ocorrer erro de sql.
     * @description OBSERVAÇÃO: Os filtros disponíveis são:
     * - Nome
     * - Cidade
     * - Especialidade 
     */
    public function buscarMedico(string $conteudo, string $filtro)
    {
        $conteudo = strtoupper($conteudo);
        if ($filtro == 'Nome'){
            $filtro = 'M.NOME';
        }
        else if ($filtro == 'Cidade'){
            $filtro = 'END.CIDADE';
        }
        else if ($filtro == 'Especialidade'){
            $filtro = 'ESP.DESCRICAO';
        }
        else{
            throw new Exception("Filtro {$filtro} não implementado na busca do médico");
        }

        $sql = "SELECT m.id,
         m.nome,
         GROUP_CONCAT(DISTINCT CONCAT(esp.descricao, ' (', esp.complemento, ')') SEPARATOR ', ') as especialidades,
         GROUP_CONCAT(DISTINCT CONCAT(end.cidade, ' (', end.UF, ')') SEPARATOR ' / ') as cidades,
         m.sobre FROM MEDICO m
         JOIN ESPECIALIDADE esp ON esp.medico = m.id
         JOIN ENDERECO end ON end.medico = m.id
         WHERE UPPER({$filtro}) LIKE '{$conteudo}%'
         GROUP BY 1,2,5
         LIMIT 15";

        return $this->db->executeQuery($sql);
    }

    /**
     * Consultar médico detalhadamente incluindo endereço, contato e especialidade.
     * @param int $id Id do médico.
     * @return Medico dados completos do médico
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultarDetalhesDoMedico(int $id)
    {
        $sql = "SELECT M.ID, M.NOME, M.CRM, M.REMOTO, M.SOBRE, M.NASCIMENTO,
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