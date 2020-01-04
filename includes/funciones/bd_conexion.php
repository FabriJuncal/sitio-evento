<?php
    // Conexion a la base de datos MySql Orientada a Objeto
    $conn = new mysqli('localhost', 'root', '', 'gdlwebcamp');
    

    if($conn->connect_error){
        echo $error -> $conn->connect_error;
        
    }

    
?>