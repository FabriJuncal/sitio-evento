<?php
        try{
            // Creamos la conexion
            // require_once(): es idéntica a require() excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye (require) de nuevo.
            require_once('includes/funciones/bd_conexion.php');
            // Escribimos la consulta
            $sql = "SELECT * FROM invitados"; 
            // Consultamos en la base de datos con Orientacion a Objeto
            //query(): esta funcion ejecuta la consulta en la base de datos y nos retorna la Vista
            $resultado = $conn->query($sql);
        }catch(\Exception $e){
            // getMessage(): Devuelve el mensaje de excepción como una cadena.
            echo $e->getMessage();
        }
    ?>

    <section class="invitados contenedor seccion">

        <h2>Nuestros Invitados</h2>

        <ul class="lista-invitados clearfix">
        <?php
             
            $calendario = array();
            // fetch_assoc(): Recupera una fila de resultado como una matriz asociativa.
            while( $invitados = $resultado->fetch_assoc() ){  ?>
                
                <li>
                    <div class="invitado">
                        <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id']; ?>">
                            <img src="img/<?php echo $invitados['url_imagen'] ?>" alt="imagen invitado">
                            <p><?php echo $invitados['nombre_invitado']. " ".$invitados['apellido_invitado']; ?></p>
                        </a>
                    </div>
                </li>   
                <div style="display:none;">
                    <div class="invitado-info" id="invitado<?php echo $invitados['invitado_id']; ?>">
                        <h2><?php echo $invitados['nombre_invitado']. " ".$invitados['apellido_invitado']; ?></h2>
                        <nav class="redes-sociales">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </nav>
                        <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="imagen invitado">
                        <p><?php echo $invitados['descripcion']; ?></p>
                    </div>
                </div>
             
        <?php } ?>

        </ul> <!-- lista-invitados -->
    </section> <!-- invitados -->

    <?php
        // Cerramos la conexion
        $conn->close();
    ?>