<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/navbar.php';
include_once 'templates/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Crear Categoría de Evento</h1>
          <span>Llena el formulario para crear una categoria</span>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <!-- Default box -->
        <div class="card">
          <!-- <div class="card-header">
                <h3 class="card-title"></h3>
              </div> -->
          <div class="card-body">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Crear Categoria</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal needs-validation" name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre" name="nombre_registrado" placeholder="Nombre Registrado" required>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="apellido" name="apellido_registrado" placeholder="Apellido Registrado" required>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" name="email_registrado" placeholder="Email" required>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div id="paquetes" class="paquetes">
                      <h3>Elige el número de boletos</h3>
                      <br>
                      <ul class="lista-precios clearfix row">

                        <li class="col-md-4">
                          <div class="tabla-precios text-center">
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

                        <li class="col-md-4">
                          <div class="tabla-precios text-center">
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

                        <li class="col-md-4">
                          <div class="tabla-precios text-center">
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
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <div id="evento" class="clearfix">
                      <h3>Elige tus talleres</h3>

                      <div class="caja">
                        <?php
                        try {

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
                            <h4 class="dia"><?= $dia ?></h4>

                            <?php foreach ($eventos['eventos'] as $tipo => $eventos_dia) : ?>



                              <div class="tipo-evento">
                                <p><?= $tipo ?></p>
                                <div class="eventos">
                                  <?php foreach ($eventos_dia as $evento) : ?>

                                    <label class="descripcion-evento">
                                      <input type="checkbox" name="registro[]" id="<?= $evento['id'] ?>" class="flat-red" value="<?= $evento['id'] ?>">
                                      <time><?= $evento['hora'] ?></time><br>
                                      <?= $evento['nombre_evento'] ?>
                                      <br>
                                      <span class="autor"><?= $evento['nombre_invitados'] . " " . $evento['apellido_invitado'] ?> </span>
                                    </label><!-- Evento -->

                                  <?php endforeach ?>
                                </div>
                              </div><!-- Tipo Evento -->

                            <?php endforeach ?>
                          </div><!-- .contenido-dia -->
                        <?php
                        }
                        ?>
                      </div> <!-- .caja -->
                    </div> <!-- #eventos -->
                    <br>
                    <div id="resumen" class="resumen">
                      <h3>Pagos y Extra</h3>
                      <br>
                      <div class="caja clearfix row">
                        <div class="extras col-md-6">

                          <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(Promocion 7% dto.)</small></label>
                            <input type="number" class="form-control" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" class="registro-number" size="3" placeholder="0">
                            <input type="hidden" value="10" name=pedido_extra[camisas][precio]>
                          </div>
                          <!--.orden-->

                          <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2<small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                            <input type="number" class="form-control" name="pedido_extra[etiquetas][cantidad]" min="0" id="etiquetas" class="registro-number" size="3" placeholder="0">
                            <input type="hidden" value="2" name=pedido_extra[etiquetas][precio]>
                          </div>
                          <!--.orden-->

                          <div class="orden">
                            <label for="regalo">Seleccione un regalo</label> <br>
                            <select id="regalo" class="form-control seleccionar" name="regalo" required>
                              <option value="">--Seleccione un regalo--</option>
                              <option value="2">Etiquetas</option>
                              <option value="1">Pulseras</option>
                              <option value="3">Plumas</option>
                            </select>
                          </div>
                          <!--.orden-->

                          <br>

                          <input type="button" id="calcular" class="button" value="Calcular">
                        </div>
                        <!--extras-->
                        <div class="total col-md-6">
                          <label>Resumen:</label>
                          <div id="lista-productos">

                          </div>
                          <br>
                          <label>Total:</label>
                          <div id="suma-total">

                          </div>

                          <!-- type="hidden": Agregamos un Campo Oculto para enviar el Total a Pagar -->
                          <input type="hidden" name="total_pedido" id="total_pedido">

                        </div>
                      </div>
                      <!--.caja-->
                    </div>
                    <!--#resumen-->
                  </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <input type="hidden" name="registro" value="crear">
              <button type="submit" id="btnRegistro" class="btn btn-info">Añadir</button>
            </div>
            <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'templates/footer.php';
?>