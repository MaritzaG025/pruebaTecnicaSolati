
<?php

include_once(dirname(__FILE__) .'/../Services/getUser.php');
include_once(dirname(__FILE__) .'/../Services/createUser.php');
include_once(dirname(__FILE__) .'/../Services/deleteUser.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {  

    $conection = new getUser();
    echo $conection->getUser();

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] && $_POST['type'] == 'CreateUser') {
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $conection = new createUsers();
        echo $conection->createUser($name, $lastname, $email, $password);

    } elseif (isset($_POST['userId']) && $_POST['type'] && $_POST['type'] == 'DeleteUser') {
        $userId = $_POST['userId'];

        $conection = new deleteUsers();
        echo $conection->deleteUser($userId);
    } else {
        echo "Se esperaba una solicitud POST.";
    }
    
} else {
    echo "Método no soportado";
}

?>