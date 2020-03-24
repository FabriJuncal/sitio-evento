<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos:
                                                        // if($conn->ping()){
                                                        //     die("Conectado");
                                                        // }{
                                                        //     die("Desconectado");
                                                        // }

// Datos Obtenidos del POST
$id_registro = (isset($_POST['id_registro']) ? $_POST['id_registro'] : null);
$nombre = (isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : null);
$icono = (isset($_POST['icono_categoria']) ? $_POST['icono_categoria'] : null);


// ABM Usuarios
if(isset($_POST['registro'])){
    
    // Crea un Usuario
    if($_POST['registro'] == 'crear'){

        try{
            $stmt = $conn->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?,?)");
            $stmt->bind_param("ss", $nombre, $icono);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_accion' => $stmt->insert_id,
                    'accion' => $_POST['registro']
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        die(json_encode($respuesta));
    }
    // Modifica el Usuario
    if($_POST['registro'] == 'editar'){

        try{
            $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ?");
            $stmt->bind_param("ssi", $nombre, $icono, $id_registro);
            $stmt->execute();
            if($stmt->affected_rows > 0){              
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro'],
                    'ID_actualizado' => $id_registro
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    // ELiminar el Usuario
    if($_POST['registro'] == 'eliminar'){

        try{
            $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ?");
            $stmt->bind_param("i", $id_registro);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro'],
                    'ID_eliminado' => $id_registro

                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
}
