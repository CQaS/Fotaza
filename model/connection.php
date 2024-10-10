<?php

class Conectar
{
    private $driver, $host, $user, $pass, $database, $charset;

    public function __construct() 
    {
        
        $dbConfig = require_once 'configDB.php';
        
        $this->driver = $dbConfig["driver"];
        $this->host= $dbConfig["host"];
        $this->user= $dbConfig["user"];
        $this->pass= $dbConfig["pass"];
        $this->database= $dbConfig["database"];
        $this->charset= $dbConfig["charset"];
    }
    
    public function getConnection()
    {         

        if($this->driver=="mysql" || $this->driver==null)
        {
            $mysqli= new mysqli($this->host, $this->user, $this->pass, $this->database);
            $mysqli->query("SET NAMES '".$this->charset."'");
        }
        
        if(mysqli_connect_errno())
        {
            echo "Fallo la coneccion: ".mysqli_connect_errno();
        }
        
        return $mysqli;
    }
}

?>