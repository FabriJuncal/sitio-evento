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
            <h1>Crear Evento</h1>
            <span>Llena el formulario para crear un evento</span>
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
                      <h3 class="card-title">Crear Evento</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal needs-validation" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php" >
                      <div class="card-body">
                           <div class="form-group row">
                              <label for="titulo_evento" class="col-sm-2 col-form-label">Titulo:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo Evento" required>
                              </div>
                            </div>
                        <!-- Date Picker - Plugin.js-->
                            <div class="form-group row">
                                <label for="fecha_evento" class="col-sm-2 col-form-label">Fecha:</label>
                                <div class=" row col-sm-10">
                                    <div class="input-group-prepend col-sm-1">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control float-right datepicker datemask" id="fecha_evento" name="fecha_evento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                    </div>
                                </div>
                            </div>
                            <!-- Select2 - Plugin.js -->
                            <div class="form-group row">
                              <label for="categoria_evento" class="col-sm-2 col-form-label">Categoría:</label>
                              <div class="col-sm-10">
                                <select class="select2" style="width: 100%;">
                                  <option value="0">-- Seleccione --</option>
<?php                               
                                    try {
                                      $sql = "SELECT * FROM categoria_evento";
                                      $resultado = $conn->query($sql);
                                      while($cat_evento = $resultado->fetch_assoc()){
?>
                                        <option value="<?=$cat_evento['id_categoria']?>">
                                          <?=$cat_evento['cat_evento']?>
                                        </option>
<?php                                 }
                                    } catch (Exception $e) {
                                      echo "Error: " . $e->getMessage();
                                    }
?>
                                </select>
                              </div>
                            </div>
                            <!-- Time Picker - Plugin.js -->
                            <div class="form-group row">
                              <label for="hora_evento" class="col-sm-2 col-form-label">Hora:</label>
                              <div class=" row col-sm-10">
                                  <div class="input-group-prepend col-sm-1">
                                      <span class="input-group-text">
                                        <i class="far fa-clock"></i>
                                      </span>
                                  </div>
                                  <div class="date timepicker col-sm-5" id="timepicker" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" id="hora_evento" name="fecha_evento" data-toggle="datetimepicker" data-target="#timepicker"/>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="registro" value="crear">
                        <button type="submit" id="btn-enviar" class="btn btn-info">Enviar</button>
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
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'templates/footer.php';
?>


