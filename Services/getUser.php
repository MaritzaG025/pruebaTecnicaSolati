<?php
include_once("conection.php");

class getUser extends CConection {
    public function getUser(){
        $connection = $this->connection;
        $query = "SELECT * FROM usuarios";
        try {
            if ($connection === false) {
                throw new Exception("Error de conexion.");
            }
            $results = pg_query($connection, $query);
            $response = [];
            while ($result = pg_fetch_row($results)) {
                $model = array(
                    "id" => $result[0],
                    "name" => $result[1],
                    "lastName" => $result[2],
                    "email" => $result[3],
                    "password" => $result[4],
                    "dateCreate" => $result[5]
                );
                array_push($response, $model);
            }
            $response = json_encode($response);
            return $response;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}

?>