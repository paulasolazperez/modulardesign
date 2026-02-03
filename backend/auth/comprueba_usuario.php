<?php
session_start();
include "../conexion.php";
 
$user = $_POST['user'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM usuarios WHERE user='$user'";
$resultado = $conn->query($sql);
 
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
 
    if (password_verify($password, $fila['password'])) {
 
        $_SESSION['id_user'] = $fila['id_user'];
        $_SESSION['user'] = $fila['user'];
 
        header("Location: ../catalogo/gestor.php");
        exit;
    }
}
 
echo "Usuario o contraseña incorrectos. <a href='https://modulardesign.vercel.app'>Intentar de nuevo</a>";
?>