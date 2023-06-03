<?php
include_once("conection.php");
class createUsers extends CConection {
    public function createUser($name, $lastName, $email, $password)
    {
        $connection = $this->connection;
        $name = pg_escape_string($connection, $name);
        $lastName = pg_escape_string($connection, $lastName);
        $email = pg_escape_string($connection, $email);
        $password = pg_escape_string($connection, $password);
        $fecha = date('d-m-Y H:i:s');

        $query = "INSERT INTO usuarios (nombre, apellido, email, pasword, fecha_creacion) VALUES ('$name', '$lastName', '$email', '$password', '$fecha')";

        try {
            if ($connection === false) {
                throw new Exception("Error de conexion.");
            }
            $result = pg_query($connection, $query);

            if ($result) {
                return "Usuario creado exitosamente.";
            } else {
                throw new Exception("Error al crear el usuario.");
            }
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }
}
?>