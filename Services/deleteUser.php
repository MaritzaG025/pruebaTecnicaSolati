<?php
include_once("conection.php");
class deleteUsers extends CConection {
    public function deleteUser($userId)
    {
        $connection = $this->connection;
        $userId = pg_escape_string($connection, $userId);

        $query = "DELETE FROM usuarios WHERE usuarios.id_usuario = $userId";

        try {
            if ($connection === false) {
                throw new Exception("Error de conexion.");
            }
            $result = pg_query($connection, $query);

            if ($result) {
                return "Usuario eliminado exitosamente.";
            } else {
                throw new Exception("Error al eliminar el usuario.");
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }
}
?>