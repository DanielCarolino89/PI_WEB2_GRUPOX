<?php

class Database
{

    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname="vestibular";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);          
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e . "<br>" . $e->getMessage();
        }
    }  

    public function __destruct() { 
        $this->conn = null;   
	} 

    public function beginTransaction(){
        $this->conn->beginTransaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function Rollback()
    {
        $this->conn->rollback();
    }

    public function executeCommand($sql)
    {
        try
        {
            return $this->conn->exec($sql);           
        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }

    public function executeQuery($sql)
    {
        try
        {
            return $this->conn->query($sql);           
        }
        catch(PDOException $e)
        {
            return $e->getMessage();
        }
    }


}


