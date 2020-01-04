<?php include_once 'includes/templates/header.php';?>

<!-- 1ra SECCION (La mejor conferencia de diseño web en español) -->
  <section class="seccion contenedor">

    <h2>La mejor conferencia de diseño web en español</h2>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quo a fugiat corporis? Tempora, aut eveniet repudiandae quaerat veniam voluptate laboriosam nostrum itaque eaque quia molestiae quae mollitia praesentium, dolorem sequi ducimus quasi. Reprehenderit dolorum illum numquam libero magnam modi, error repudiandae ex, consequatur alias.
    </p>

  </section> <!-- seccion -->

<!-- 2da SECCION (Programa del Evento) -->
  <section class="programa">
    <div class="contenedor-video">
     <video autoplay loop poster="img/bg-talleres.jpg" class="contenedor-video">
        <source src="video/video.mp4" type="video/mp4">
        <source src="video/video.webm" type="video/webm">
        <source src="video/video.ogv" type="video/ogg">  
      </video>
    </div>
    <div class="contenedor-img">

      <img class="contenedor-img" src="img/bg-talleres.jpg" alt="talleres">

    </div> <!-- contenedor-img -->

    <div class="contenido-programa">

      <div class="contenedor">

        <div class="programa-evento">

        <?php
          try{
              // Creamos la conexion
              // require_once(): es idéntica a require() excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye (require) de nuevo.
              require_once('includes/funciones/bd_conexion.php');
              // Escribimos la consulta
              $sql = "SELECT * FROM categoria_evento";  
              // Consultamos en la base de datos con Orientacion a Objeto
              //query(): esta funcion ejecuta la consulta en la base de datos y nos retorna la Vista
              $resultado = $conn->query($sql);
          }catch(\Exception $e){
              // getMessage(): Devuelve el mensaje de excepción como una cadena.
              echo $e->getMessage();
          }
        ?>

          <h2>Programa del Evento</h2>
          <nav class="menu-programa">
          <!-- fetch_array(): Extrae la fila de resultado como una asociativa, una matriz numérica, o ambos. -->
          <!-- MYSQLI_ASSOC: Al usar la constante MYSQLI_ASSOC, esta función se comportará de manera idéntica a mysqli_fetch_assoc (). -->
          <!-- mysqli_fetch_assoc(): Recupera una fila de resultado como una matriz asociativa  -->
            <?php while($cat = $resultado -> fetch_array(MYSQLI_ASSOC)){ ?>

              <?php $categoria = $cat['cat_evento']; ?> 
              <!-- strtolower(): Convierte en minusculas todas las letras de un string -->
              <a href="#<?php echo strtolower($categoria) ?>"><i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i><?php echo $categoria ?></a>
            
            <?php } ?>

          </nav> <!-- menu-programa -->

          <?php
            try{
                // Creamos la conexion
                // require_once(): es idéntica a require() excepto que PHP verificará si el archivo ya ha sido incluido y si es así, no se incluye (require) de nuevo.
                require_once('includes/funciones/bd_conexion.php');
                
                // Concatenamos 3 consultas

                // Evento 1 - Seminarios
                $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado
                FROM eventos
                INNER JOIN categoria_evento
                ON eventos.id_cat_evento = categoria_evento.id_categoria
                INNER JOIN invitados
                ON eventos.id_inv = invitados.invitado_id
                AND eventos.id_cat_evento = 1
                ORDER BY evento_id  LIMIT 2;"; 
                
                // Evento 2 - Conferencias
                $sql.= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado
                FROM eventos
                INNER JOIN categoria_evento
                ON eventos.id_cat_evento = categoria_evento.id_categoria
                INNER JOIN invitados
                ON eventos.id_inv = invitados.invitado_id
                AND eventos.id_cat_evento = 2
                ORDER BY evento_id  LIMIT 2;"; 

                // Evento 3 - Talleres
                $sql.= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado
                FROM eventos
                INNER JOIN categoria_evento
                ON eventos.id_cat_evento = categoria_evento.id_categoria
                INNER JOIN invitados
                ON eventos.id_inv = invitados.invitado_id
                AND eventos.id_cat_evento = 3
                ORDER BY evento_id  LIMIT 2;"; 
                
               
            }catch(\Exception $e){
                // getMessage(): Devuelve el mensaje de excepción como una cadena.
                echo $e->getMessage();
            }
          ?>
          <!-- Consultamos en la base de datos con Orientacion a Objeto. -->
          <!-- multi_query(): Ejecuta una o varias consultas que están concatenadas por un punto y coma. -->
          <?php $conn->multi_query($sql); ?>

          <?php 
            do {
              // store_result(): Transfiere un conjunto de resultados de la última consulta.
              // fetch_all(): Obtiene todas las filas de resultados como una matriz asociativa, una matriz numérica o ambas.
              //  MYSQLI_ASSOC: Al usar la constante MYSQLI_ASSOC, esta función se comportará de manera idéntica a mysqli_fetch_assoc (). 
              $resultado = $conn->store_result();
              $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>

              <!-- Declaramos un contador -->
              <?php $i = 0; ?>

              <?php foreach($row as $evento): ?>

                <!-- Creamos una condicion que cuando el nro del contador sea PAR, se agrege el siguiente DIV -->
                <?php if($i % 2 == 0){ ?>
                  <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">

                <?php } ?>
              
              <!-- Imprimimos los datos obtenidos de la base de datos -->
                <div class="detalle-evento">
                <!-- utf8_encode(): formatea las cadenas de textos para que se muestren algunos caracteres no permitidos -->
                  <h3><?php echo utf8_encode($evento['nombre_evento'])?></h3>
                  <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $evento['hora_evento']; ?></p>
                  <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento']; ?></p>
                  <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado']. " " .  $evento['apellido_invitado']; ?></p>
                </div> <!-- detalle-evento --> 
              
                <!-- Creamos una condicion que cuando el nro del contador sea IMPAR, se agrege el siguiente ENLACE y DIV -->
                <?php if($i % 2 == 1): ?>
                  <a href="calendario.php" class="button float-rigth">Ver todos</a>
                  </div> <!-- #talleres -->
                <?php endif ?>
                  
                <?php $i++ ?>

              <?php endforeach ?>
              <!-- free(): Cerramos la conexion del multi_query -->
              <?php $resultado->free(); ?>

          <!-- more_results(): Compruebe si hay más resultados de consultas de una consulta múltiple -->
          <!-- next_result(): Prepara el siguiente resultado de multi_query -->
          <?php } while ($conn->more_results() && $conn->next_result()); ?>
            

        </div> <!-- programa-evento -->

      </div> <!-- contenedor -->

    </div> <!-- contenido-programa -->

  </section> <!-- programa -->

<!-- 3ra SECCION (Nuestros Invitados) -->
<?php include_once 'includes/templates/invitados.php';?>

<!-- 4ta SECCION (Contador de Invitados, Talleres, Dias y Conferenias) -->
  <div class="contador parallax">
    <div class="contenedor">

      <ul class="resumen-evento clearfix">
        <li><p class="numero"></p>Invitados</li>
        
        <li><p class="numero"></p>Talleres</li>
        
        <li><p class="numero"></p>Dias</li>
        
        <li><p class="numero"></p>Conferencias</li>
      </ul>
      
    </div>
  </div><!-- contador -->

<!-- 5ta SECCION (Precios) -->
  <section class="precios seccion">

    <h2>Precios</h2>

    <div class="contenedor">
      <ul class="lista-precios clearfix">

        <li>
          <div class="tabla-precios">
            <h3>Pase por dia</h3>
            <p class="numero">$30</p>
            <ul>
              <li>Bocadillos Gratis</li>
              <li>Todas las Conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">Comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precios">
            <h3>Todos los dias</h3>
            <p class="numero">$50</p>
            <ul>
              <li>Bocadillos Gratis</li>
              <li>Todas las Conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button ">Comprar</a>
          </div>
        </li>

         <li>
          <div class="tabla-precios">
            <h3>Pase por 2 dias</h3>
            <p class="numero">$45</p>
            <ul>
              <li>Bocadillos Gratis</li>
              <li>Todas las Conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">Comprar</a>
          </div>
        </li>
        
      </ul>
    </div>

  </section>

  <!-- 6ta SECCION (Mapa) -->
  <div id="mapa" class="mapa">
    
  </div>

  <!-- 7ma SECCION (Testimoniales) -->
  <section class="seccion">
    <h2>Testimoniales</h2>
    <div class="testimoniales contenedor clearfix">

      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, placeat, minima. Harum voluptatibus quae tempora est, cupiditate culpa molestiae illo beatae reiciendis nisi sit dolores optio totam magni quidem minus.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div><!-- .testimonial -->

      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, placeat, minima. Harum voluptatibus quae tempora est, cupiditate culpa molestiae illo beatae reiciendis nisi sit dolores optio totam magni quidem minus.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div><!-- .testimonial -->

      <div class="testimonial">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, placeat, minima. Harum voluptatibus quae tempora est, cupiditate culpa molestiae illo beatae reiciendis nisi sit dolores optio totam magni quidem minus.</p>
          <footer class="info-testimonial clearfix">
            <img src="img/testimonial.jpg" alt="">
            <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
          </footer>
        </blockquote>
      </div><!-- .testimonial -->

    </div> <!-- .testimoniales -->
  </section>



<!-- 8mva SECCION (Newsletter) -->
  <div class="newsletter parallax">
    <div class="contenido contenedor">
      <p> registrate al newsletter:</p>
      <h3>gdlwebcamp</h3>
      <a href="#mc_embed_signup" class="boton_newslleter button transparente">Registro</a>
    </div> <!-- contenido -->
  </div> <!-- newsletter -->

<!-- 9va SECCION (Faltan) -->
  <section class="seccion contenedor">
    <h2>Faltan</h2>
    <div class="cuenta-regresiva contenedor">
      <ul class="clearfix">
        <li><p id='dias' class="numero"></p>días</li>
        <li><p id='horas' class="numero"></p>horas</li>
        <li><p id='minutos' class="numero"></p>minutos</li>
        <li><p id='segundos' class="numero"></p>segundos</li>
      </ul>
    </div>
  
  </section> <!-- seccion -->
  
  <!-- 10ma SECCION (Footer) -->
  <?php include_once 'includes/templates/footer.php';?>