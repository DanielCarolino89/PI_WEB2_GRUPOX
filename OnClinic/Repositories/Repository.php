<?php

abstract class Repository
{
    protected Database $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    protected function getLastInsertId(){
        $sqlId = "Select LAST_INSERT_ID();";
        $queryResult = $this->db->executeQuery($sqlId);
        return $queryResult->fetch()[0];
    }

    protected function queryFirstValue($sql)
    {
        return $this->db->executeQuery($sql)->fetchColumn() ?? null;
    }
}

?>