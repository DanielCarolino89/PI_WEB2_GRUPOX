<?php

abstract class Repository
{
    protected dbUtils $db;
    public function __construct(dbUtils $db)
    {
        $this->db = $db;
    }

    protected function GetLastInsertId(){
        $sqlId = "Select LAST_INSERT_ID();";
        $queryResult = $this->database->Query($sqlId);
        return $queryResult->fetch()[0];
    }
}

?>