<?php include_once 'includes/templates/header.php';?>


  <section class="seccion">
    <h2>Calendario de Eventos</h2>

    <?php
        try{
            // Creamos la conexion
            // require_once(): es idéntica a require() excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye (require) de nuevo.
            require_once('includes/funciones/bd_conexion.php');
            // Escribimos la consulta
            $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado
            FROM eventos
            INNER JOIN categoria_evento
            ON eventos.id_cat_evento = categoria_evento.id_categoria
            INNER JOIN invitados
            ON eventos.id_inv = invitados.invitado_id
            ORDER BY evento_id ";   
            // Consultamos en la base de datos con Orientacion a Objeto
            //query(): esta funcion ejecuta la consulta en la base de datos y nos retorna la Vista
            $resultado = $conn->query($sql);
        }catch(\Exception $e){
            // getMessage(): Devuelve el mensaje de excepción como una cadena.
            echo $e->getMessage();
        }
    ?>

    <div class="calendario">
        <?php
             
            $calendario = array();
            // fetch_assoc(): Recupera una fila de resultado como una matriz asociativa.
            while( $eventos = $resultado->fetch_assoc() ){ 

                // Obtenemos la fecha del evento
                $fecha = $eventos['fecha_evento'];

                // Creamos un array y lo cargamos con los datos que traemos de la base de datos
                $evento = array(  
                  'titulo' => $eventos['nombre_evento'],
                  'fecha' => $eventos['fecha_evento'],
                  'hora' => $eventos['hora_evento'],
                  'categoria' => $eventos['cat_evento'],
                  'icono' => 'fa'." ".$eventos['icono'],
                  'invitado' => $eventos['nombre_invitado']. " ".$eventos['apellido_invitado']
                );

                // Asociamos los eventos por sus fechas
                $calendario[$fecha][] = $evento;
    

            } // While de fetch_assoc()?>
            
            <!-- Imprimimos las fechas con los iconos de font-awesome -->
            <?php foreach($calendario as $dia => $lista_eventos){ ?>

                <h3>
                    <i class="fa fa-calendar"></i>
                    <?php
                        // Formateo de Idioma para Unix (Linux)
                         setlocale(LC_TIME, 'es_ES.UTF-8');

                        // Formateo de Idioma para Windows
                        setlocale(LC_TIME, 'spanish');

                        //utf8_encode(): Formateamo la cadena a UTF-8, para que nos muestre las letras con tildes.
                        //strftime(): formatea una hora / fecha local de acuerdo con la configuración regional.
                        //strtotime(): nalice cualquier descripción de fecha y hora textual en inglés en una marca de tiempo Unix.
                        echo utf8_encode(strftime("%A, %d de %B del %Y", strtotime($dia))); 
                    ?>

                </h3>
                <div class="evento">
                <!-- Imprimimos los Eventos de cada dia, con su titulo, hora, categorias e invitados -->
                <?php foreach($lista_eventos as $evento){ ?>
                    
                        <div class="dia">

                            <p class="titulo"><?php echo utf8_encode($evento['titulo']); ?></p>

                            <p class="hora">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php echo $evento['fecha']. " " . $evento['hora']; ?>
                            </p>

                            <p>
                                <i class = "<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                                <?php echo utf8_encode($evento['categoria']); ?>
                            </p>

                            <p>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <?php echo utf8_encode($evento['invitado']); ?>
                            </p>

                        </div> <!-- .dia -->
                    
                <?php } // Fin foreach de EVENTO ?>
                </div> <!-- .evento -->
            <?php } // Fin foreach de DIAS ?>

            
            
    </div> <!-- .calendario -->

    <?php
        // Cerramos la conexion
        $conn->close();
    ?>
   

  </section>

  <!-- 10ma SECCION (Footer) -->
  <?php include_once 'includes/templates/footer.php';?>