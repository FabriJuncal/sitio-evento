<?php

// echo "<pre>";

// die(print_r($ruta['servicios']));

if($ruta['basename'] == "servicios"){
    require_once("../../includes/funciones/bd_conexion.php");
    require_once("../../includes/funciones/funciones.php");

}else{
    require_once("../includes/funciones/bd_conexion.php");
    require_once("../includes/funciones/funciones.php");

}

// function verificar_usuario($usuario){
//     require_once("../includes/funciones/bd_conexion.php");
//     $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario = ?");
//         $stmt->bind_param("s", $usuario);
//         $stmt->execute();
//         $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin);
//         if($stmt->affected_rows){
//             $existe = $stmt->fetch();
//             if($existe){
//                 // Se encontro el Usuario
//                 $respuesta = true;
//             }else{
//                 // No se encuentra el Usuario
//                 $respuesta = false;
//             }
//         }
//         $stmt->close();
//         $conn->close();
//         return $respuesta;
// }
