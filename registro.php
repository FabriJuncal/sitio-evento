<?php include_once 'includes/templates/header.php';?>
  <section class="seccion contenedor">
    <h2>Registro de Usuarios</h2>
    <form id="registro" class="registro" action="validar_registro.php" method="POST">
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
                <input type="number" min="0" id="pase_dia" class="registro-number" size="3" name="boletos[]" placeholder="0">
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
                <input type="number" min="0" id="pase_completo" class="registro-number" size="3" name="boletos[]" placeholder="0">
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
                <input type="number" min="0" id="pase_dosdias" class="registro-number" size="3" name="boletos[]" placeholder="0">
              </div>
            </div>
          </li>
          
        </ul>
      </div> <!-- #paquetes -->
      <div id="evento" class="clearfix">
        <h3>Elige tus talleres</h3>
  
        <div class="caja">
          <div id="viernes" class="contenido-dia clearfix">
            <h4>Viernes</h4>
            <div>
              <p>Talleres:</p>
              <label><input type="checkbox" name="registro[]" id="taller_01" value="taller_01"><time>10:00 </time>Responsive Web Desing</label>
              <label><input type="checkbox" name="registro[]" id="taller_02" value="taller_02"><time>12:00 </time>Flexbox</label>
              <label><input type="checkbox" name="registro[]" id="taller_03" value="taller_03"><time>14:00 </time>HTML5 y CSS3</label>
              <label><input type="checkbox" name="registro[]" id="taller_04" value="taller_04"><time>17:00 </time>Drupal</label>
              <label><input type="checkbox" name="registro[]" id="taller_05" value="taller_05"><time>19:00 </time>WordPress</label>
            </div><!-- Talleres -->
            <div>
              <p>Conferencias:</p>
              <label><input type="checkbox" name="registro[]" id="conf_01" value="conf_01"><time>10:00 </time>Como ser Freelancer</label>
              <label><input type="checkbox" name="registro[]" id="conf_02" value="conf_02"><time>17:00 </time>Tecnologías del Futuro</label>
              <label><input type="checkbox" name="registro[]" id="conf_03" value="conf_03"><time>19:00 </time>Seguridad en la Web</label>
            </div><!-- Conferencias -->
            <div>
              <p>Seminarios:</p>
              <label><input type="checkbox" name="registro[]" id="sem_01" value="sem_01"><time>10:00 </time>Diseño UI y UX para Moviles</label>
            </div>
          </div><!-- Viernes -->
          <div id="sabado" class="contenido-dia clearfix">
              <h4>Sabado</h4>
              <div>
                <p>Talleres:</p>
                <label><input type="checkbox" name="registro[]" id="taller_06" value="taller_06"><time>10:00 </time>AngularJS</label>
                <label><input type="checkbox" name="registro[]" id="taller_07" value="taller_07"><time>12:00 </time>PHP y MySql</label>
                <label><input type="checkbox" name="registro[]" id="taller_08" value="taller_08"><time>14:00 </time>JavaScript Avanzado</label>
                <label><input type="checkbox" name="registro[]" id="taller_09" value="taller_09"><time>17:00 </time>SEO en google</label>
                <label><input type="checkbox" name="registro[]" id="taller_10" value="taller_10"><time>19:00 </time>De Photoshop a HTML5 y CSS3</label>
                <label><input type="checkbox" name="registro[]" id="taller_11" value="taller_11"><time>21:00 </time>PHP Medio y Avanzado</label>

              </div><!-- Talleres -->
              <div>
                <p>Conferencias:</p>
                <label><input type="checkbox" name="registro[]" id="conf_04" value="conf_04"><time>10:00 </time>Como crear una tienda online que venda millones en pocos dias</label>
                <label><input type="checkbox" name="registro[]" id="conf_05" value="conf_05"><time>17:00 </time>Los mejores lugares para encontrar trabajo</label>
                <label><input type="checkbox" name="registro[]" id="conf_06" value="conf_06"><time>19:00 </time>Pasos para crear un negocio rentable</label>
              </div><!-- Conferencias -->
              <div>
                <p>Seminarios:</p>
                <label><input type="checkbox" name="registro[]" id="sem_02" value="sem_02" ><time>10:00 </time>Aprende a programar en una mañana</label>
                <label><input type="checkbox" name="registro[]" id="sem_03" value="sem_02"><time>17:00 </time>Diseño UI y UX para Moviles</label>
              </div>
          </div><!-- Sabado -->
          <div id="domingo" class="contenido-dia clearfix">
              <h4>Domingo</h4>
              <div>
                <p>Talleres:</p>
                <label><input type="checkbox" name="registro[]" id="taller_12" value="taller_12"><time>10:00 </time>AngularJS</label>
                <label><input type="checkbox" name="registro[]" id="taller_13" value="taller_13"><time>12:00 </time>PHP y MySql</label>
                <label><input type="checkbox" name="registro[]" id="taller_14" value="taller_14"><time>14:00 </time>JavaScript Avanzado</label>
                <label><input type="checkbox" name="registro[]" id="taller_15" value="taller_15"><time>17:00 </time>SEO en google</label>
                <label><input type="checkbox" name="registro[]" id="taller_16" value="taller_16"><time>19:00 </time>De Photoshop a HTML5 y CSS3</label>
              </div><!-- Talleres -->
              <div>
                <p>Conferencias:</p>
                <label><input type="checkbox" name="registro[]" id="conf_07" value="conf_07"><time>10:00 </time>Como crear una tienda online que venda millones en pocos dias</label>
                <label><input type="checkbox" name="registro[]" id="conf_08" value="conf_08"><time>17:00 </time>Los mejores lugares para encontrar trabajo</label>
                <label><input type="checkbox" name="registro[]" id="conf_09" value="conf_09"><time>19:00 </time>Pasos para crear un negocio rentable</label>
              </div><!-- Conferencias -->
              <div>
                <p>Seminarios:</p>
                <label><input type="checkbox" name="registro[]" id="sem_04" value="sem_04" ><time>14:00 </time>Creando una App para Android en una Tarde</label>
                <label><input type="checkbox" name="registro[]" id="sem_05" value="sem_05"><time>17:00 </time>Creando una App para iOS en una Tarde</label>
              </div>
          </div><!-- Domingo -->
         </div> <!-- .caja -->
       </div> <!-- #eventos -->

       <div id="resumen" class="resumen">
         <h3>Pago y Extra</h3>
         <div class="caja clearfix">
           <div class="extras">

             <div class="orden">
               <label for="camisa_evento">Camisa del evento $10 <small>(Promocion 7% dto.)</small></label>
               <input type="number" name="pedido_camisas" min="0" id="camisa_evento" class="registro-number" size="3" placeholder="0">
             </div><!--.orden-->

             <div class="orden">
              <label for="etiquetas">Paquete de 10 etiquetas $2<small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
              <input type="number" name="pedido_etiquetas" min="0" id="etiquetas" class="registro-number" size="3" placeholder="0">
            </div><!--.orden-->

            <div class="orden">
              <label for="regalo">Seleccione un regalo</label> <br>
              <select id="regalo" name="regalo" required>
                <option value="">--Seleccione un regalo--</option>
                <option value="2">Etiquetas</option>
                <option value="1">Pulseras</option>
                <option value="3">Plumas</option>
              </select>
            </div><!--.orden-->

            <input type="button" id="calcular" class="button" value="Calcular">
           </div><!--extras-->
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
         </div><!--.caja-->
       </div><!--#resumen-->
    </form>
  </section>


  <!-- 10ma SECCION (Footer) -->
  <?php include_once 'includes/templates/footer.php';?>