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
            '{$medico->getDataNascimento()->format('Y/m/d')}',
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
     * Altera o Médico no banco de dados.
     * @param Medico $medico Modelo que contém os dados do médico.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function alterarDadosMedico(Medico $medico)
    {
        $sql = "UPDATE MEDICO SET
            NOME = '{$medico->getNome()}',
            CRM = '{$medico->getCRM()}',
            CPF = '{$medico->getCPF()}',
            RG = '{$medico->getRG()}',
            NASCIMENTO = '{$medico->getDataNascimento()->format('Y/m/d')}',
            REMOTO = '{$medico->getAtendimentoRemoto()}',
            SOBRE = '{$medico->getSobre()}'
            WHERE ID = {$medico->getId()}";

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao alterar médico.';
            echo "<br><br> SQL Executada: {$sql}<br>";
            throw $ex;
        }
    }

    /**
     * Exclui o Médico no banco de dados.
     * @param int $id id do médico
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function excluirMedico(int $id)
    {
        $sql = "DELETE FROM MEDICO WHERE ID = {$id}";

        try{

            $this->db->executeCommand($sql);

        } catch(PDOException $ex){
            echo 'Ocorreu um erro ao excluir médico.';
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
     * Consulta Id do Médico através do CPF
     * @param string $cpf CPF do médico que será consultado.
     * @return int id do médico.
     * @throws PDOException caso ocorrer erro de sql.
     */
    public function consultaIdPorCPF(string $cpf) : int
    {
        $sql = "SELECT id from Medico where CPF = '{$cpf}'";

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
        $sql = "SELECT 
        id, 
        nome,
        crm,
        remoto,
        sobre,
        nascimento,
        cpf,
        rg,
        usuario,
        senha
        FROM MEDICO
        RIGHT JOIN LOGIN ON MEDICO.LOGIN = LOGIN.USUARIO
        WHERE ID = {$id};";

        return $this->db->executeQuery($sql)->fetch();
    }

    public function consultarUsuarioDoMedico(int $id)
    {
        $sql = "SELECT Login FROM MEDICO WHERE ID = {$id}";

        return $this->queryFirstValue($sql);
    }

    public function removerAssociacaoLogin(int $id)
    {
        $sql = "UPDATE MEDICO SET LOGIN = NULL WHERE ID = {$id}";

        $this->db->executeCommand($sql);
    }
}
?>