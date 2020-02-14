<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos
// if($conn->ping()){
//     die("Conectado");
// }{
//     die("Desconectado");
// }
if(isset($_POST['agregar-admin'])){
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    
    $opciones = array(
        'cost' => 12
    );

    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    die($password_hashed);
}