<?php

/**
 * Classe abstrata com comandos SQL reutilizáveis.
 */
abstract class Repository
{
    protected Database $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Consulta o último ID inserido no banco de dados.
     * @return int último Id inserido.
     * @throws PDOException caso ocorrer erro de sql.
     * @description Função auxiliar utilizada para consultar o último código inserido no banco de dados
     * das tableas que possuem Id que são AUTO_INCREMENT
     */
    protected function getLastInsertId(){
        $sqlId = "Select LAST_INSERT_ID();";
        $queryResult = $this->db->executeQuery($sqlId);
        return $queryResult->fetchColumn() ?? throw new PDOException("Nenhum último ID encontrado");
    }

    /**
     * Consulta apenas o primeiro valor do resultado da query.
     * @param string $sql SQL que será consultada
     * @throws PDOException caso ocorrer erro de sql.
     */
    protected function queryFirstValue(string $sql)
    {
        return $this->db->executeQuery($sql)->fetchColumn() ?? null;
    }
}

?>