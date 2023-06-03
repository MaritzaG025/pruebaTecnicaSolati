<?php

class CConection {
    public $connection = null;

    public function __construct()
    {
        $host = "localhost";
        $port = 5432;
        $dbName = "postgres";
        $userName = "pruebas";
        $password = "prueba123";
        try {
            $this->connection = pg_connect("host=$host port=$port dbname=$dbName user=$userName password=$password");

            if (!$this->connection) {
                throw new Exception("Error de conexion.");
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    
}

?>