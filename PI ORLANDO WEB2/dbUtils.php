<?php

class dbUtils
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
            echo $sql . "<br>" . $e->getMessage();
        }
    }  

    public function __destruct() { 
        $this->conn = null;   
	} 

    public function DbCommandExec($sql)
    {
        try
        {
            return $this->conn->exec($sql);           
        }
        catch(PDO_Exception $e)
        {
            return $e->getMessage();
        }
        finally
        {
            $conn = null;
        }
    }

    public function DbCommandQuery($sql)
    {
        try
        {
            return $this->conn->query($sql);           
        }
        catch(PDO_Exception $e)
        {
            return $e->getMessage();
        }
        finally
        {
            $conn = null;
        }
    }
}


