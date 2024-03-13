<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["validar"])) {
    include_once("../model/conecttion.php");

    $email = mysqli_escape_string($conn, $_POST["email"]);
    $password = mysqli_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM falta WHERE falta='$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $datos = $result->fetch_object();
        if ($password === $datos->contrasena) {
            $_SESSION["id"] = $datos->id;
            $_SESSION["email"] = $datos->email;
            header('location: ../index.php');
            exit();
        } else {
            $_SESSION["error_message"] = 'Contraseña o email inválido';
            header('location: ../login.php');
            exit();
        }
    } else {
        $_SESSION["error_message"] = 'Contraseña o email inválido';
        header('location: ../login.php');
        exit();
    }
}
?>
