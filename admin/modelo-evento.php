<?php

include_once "funciones/funciones.php";
// Comprobamos si estamos conectados a la base de datos:
                                                        // if($conn->ping()){
                                                        //     die("Conectado");
                                                        // }{
                                                        //     die("Desconectado");
                                                        // }

// Datos Obtenidos del POST
$titulo = (isset($_POST['titulo_evento']) ? $_POST['titulo_evento'] : null);
$fecha = (isset($_POST['fecha_evento']) ? $_POST['fecha_evento'] : null);
$fecha_formateada = date('Y-m-d', strtotime($fecha)); // Formatea la fecha obtenida
$categoria = (isset($_POST['categoria_evento']) ? $_POST['categoria_evento'] : null);
$hora = (isset($_POST['hora_evento']) ? $_POST['hora_evento'] : null);
$hora_formateada = date('H:i', strtotime($hora)); // Formatea la hora obtenida a 24hrs. si agregamos 'H:i a' se formatea a AM/PM
$invitado = (isset($_POST['invitado_evento']) ? $_POST['invitado_evento'] : null);

$id_registro = (isset($_POST['id_registro']) ? $_POST['id_registro'] : null);

// ABM Eventos
if(isset($_POST['registro'])){

    // Crea un Evento
    if($_POST['registro'] == 'crear'){

        try{
            $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora_formateada, $categoria, $invitado);
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
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    // Modifica el Evento
    if($_POST['registro'] == 'editar'){
        
        try{
            $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE evento_id = ?");
            $stmt->bind_param("sssiii", $titulo, $fecha_formateada, $hora_formateada, $categoria, $invitado, $id_registro);
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
    // // ELiminar el Evento
    if($_POST['registro'] == 'eliminar'){
        
        try{
            $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
            $stmt->bind_param("i", $id_registro);
            $stmt->execute();
            if($stmt->affected_rows > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'accion' => $_POST['registro'],
                    'ID_eliminado' => $id_registro,
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
