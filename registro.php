<?php include_once 'includes/templates/header.php'; ?>
<section class="seccion contenedor">
  <h2>Registro de Usuarios</h2>
  <form id="registro" class="registro" action="pagar.php" method="POST">
    <div id="datos_usuario" class="registro caja clearfix">

      <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
        <div id="error_nombre"><span class="campo-obligatorio">*</span><span></span></div>
      </div>

      <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
        <div id="error_apellido"><span class="campo-obligatorio">*</span><span></span></div>
      </div>

      <div class="campo">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Tu Email">
        <div id="error_email"><span class="campo-obligatorio">*</span><span></span></div>
      </div>

    </div> <!-- #datos_usuario -->

    <div id="paquetes" class="paquetes">
      <h3>Elige el número de boletos</h3>

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
            <div class="orden">
              <label for="pase_dia">Boletos deseados:</label>
              <!-- Agregamos el "boletos[]" con corchetes al final en el atributo "name" y asi estos 3 Inputs se almacenarán dentro de un array numerico -->
              <input type="number" min="0" id="pase_dia" class="registro-number" size="3" name="boletos[pase_dia][cantidad]" placeholder="0">
              <input type="hidden" value="30" name="boletos[pase_dia][precio]">
            </div>
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
            <div class="orden">
              <label for="pase_completo">Boletos deseados:</label>
              <!-- Agregamos el "boletos[]" con corchetes al final en el atributo "name" y asi estos 3 Inputs se almacenarán dentro de un array numerico -->
              <input type="number" min="0" id="pase_completo" class="registro-number" size="3" name="boletos[pase_completo][cantidad]" placeholder="0">
              <input type="hidden" value="50" name="boletos[pase_completo][precio]">
            </div>
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
            <div class="orden">
              <label for="pase_dosdias">Boletos deseados:</label>
              <!-- Agregamos el "boletos[]" con corchetes al final en el atributo "name" y asi estos 3 Inputs se almacenarán dentro de un array numerico -->
              <input type="number" min="0" id="pase_dosdias" class="registro-number" size="3" name="boletos[pase_dosdias][cantidad]" placeholder="0">
              <input type="hidden" value="45" name="boletos[pase_dosdias][precio]">
            </div>
          </div>
        </li>

      </ul>
    </div> <!-- #paquetes -->
    <div id="evento" class="clearfix">
      <h3>Elige tus talleres</h3>

      <div class="caja">
        <?php
        try {
          require_once('includes/funciones/bd_conexion.php');

          $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado
                  FROM eventos
                  JOIN categoria_evento
                    ON  eventos.id_cat_evento = categoria_evento.id_categoria
                  JOIN  invitados
                    ON eventos.id_inv = invitados.invitado_id
                  ORDER BY eventos.fecha_evento, eventos.hora_evento, eventos.id_cat_evento";

          $resultado = $conn->query($sql);
        } catch (Exception $e) {
          echo $e->getMessage();
        }

        $eventos_dia = array();
        while ($eventos = $resultado->fetch_assoc()) {
          $fecha = $eventos['fecha_evento'];

          // setlocale(1er_parametro, 2do_parametro): Setea / Establece la configuracion local

          // 1er_parametro: es una constante con nombre que especifica la categoría de las funciones afectadas por el localismo
          //    * LC_ALL: para establecer todas las siguientes

          // 2do_parametro: 
          //    * es_ES: Seteamos / Establecemos el idioma del servidor a Español
          setlocale(LC_ALL, 'Spanish_Argentina');


          // strftime("%A", 2do_parametro): formatea una fecha/hora local según una configuración local
          //    * "%A" : una representación textual completa del día, ejemplo:	21/09/2020 lo transforma a Lunes
          //    * 2do_parametro: es una marca temporal de Unix de tipo integer que por defecto es la hora local si no se proporciona ningún valor a timestamp. En otras palabras, es de forma predeterminada el valor de la función time().

          // strtotime(1er_parametro, 2do_parametro): Convierte una descripción de fecha/hora textual en Inglés a una fecha Unix
          //    * 1er_parametro: una cadena de fecha/hora. Los formatos válidos se explican en Formatos de fecha y hora.
          //    * 2do_parametro: la marca de tiempo que se usa como base para el cálculo de las fechas relativas.
          $dia_semana = strftime("%A", strtotime($fecha));

          //utf8_encode(): Formatea a UTF8 un texto
          $dia_semana = utf8_encode($dia_semana);

          $categoria = $eventos['cat_evento'];
          $dia = array(
            'nombre_evento' => utf8_encode($eventos['nombre_evento']),
            'hora' => $eventos['hora_evento'],
            'id' => $eventos['evento_id'],
            'nombre_invitados' => $eventos['nombre_invitado'],
            'apellido_invitado' => $eventos['apellido_invitado']
          );

          $eventos_dia[$dia_semana]['eventos'][$categoria][] = $dia;
        }

        foreach ($eventos_dia as $dia => $eventos) {
        ?>
          <div id="<?= str_replace('á', 'a', $dia) ?>" class="contenido-dia clearfix">
            <h4 class="dia-evento"><?= $dia ?></h4>

<?php       foreach($eventos['eventos'] as $tipo => $eventos_dia): ?>

              <div>

                <p><?=$tipo?></p>

<?php           foreach($eventos_dia as $evento): ?>
                  
                  <label>
                    <input type="checkbox" name="registro[]" id="<?=$evento['id']?>" value="<?=$evento['id']?>">
                    <time><?=$evento['hora']?></time> <?=$evento['nombre_evento']?>
                    <br>
                    <span class="autor"><?=$evento['nombre_invitados'] ." ". $evento['apellido_invitado']?>  </span>
                  </label><!-- Evento -->

<?php           endforeach ?>

              </div><!-- Tipo Evento -->

<?php       endforeach ?>
          </div><!-- .contenido-dia -->
<?php
        }
?>
      </div> <!-- .caja -->
    </div> <!-- #eventos -->

    <div id="resumen" class="resumen">
      <h3>Pago y Extra</h3>
      <div class="caja clearfix">
        <div class="extras">

          <div class="orden">
            <label for="camisa_evento">Camisa del evento $10 <small>(Promocion 7% dto.)</small></label>
            <input type="number" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" class="registro-number" size="3" placeholder="0">
            <input type="hidden" value="10" name=pedido_extra[camisas][precio]>
          </div>
          <!--.orden-->

          <div class="orden">
            <label for="etiquetas">Paquete de 10 etiquetas $2<small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
            <input type="number" name="pedido_extra[etiquetas][cantidad]" min="0" id="etiquetas" class="registro-number" size="3" placeholder="0">
            <input type="hidden" value="2" name=pedido_extra[etiquetas][precio]>
          </div>
          <!--.orden-->

          <div class="orden">
            <label for="regalo">Seleccione un regalo</label> <br>
            <select id="regalo" name="regalo" required>
              <option value="">--Seleccione un regalo--</option>
              <option value="2">Etiquetas</option>
              <option value="1">Pulseras</option>
              <option value="3">Plumas</option>
            </select>
          </div>
          <!--.orden-->

          <input type="button" id="calcular" class="button" value="Calcular">
        </div>
        <!--extras-->
        <div class="total">
          <label>Resumen:</label>
          <div id="lista-productos">

          </div>
          <br>
          <label>Total:</label>
          <div id="suma-total">

          </div>

          <!-- type="hidden": Agregamos un Campo Oculto para enviar el Total a Pagar -->
          <input type="hidden" name="total_pedido" id="total_pedido">

          <input type="submit" name="submit" id="btnRegistro" class="button" value="Pagar">
        </div>
      </div>
      <!--.caja-->
    </div>
    <!--#resumen-->
  </form>
</section>


<!-- 10ma SECCION (Footer) -->
<?php include_once 'includes/templates/footer.php'; ?>