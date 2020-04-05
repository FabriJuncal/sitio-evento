<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';

$id = $_GET['id'];
//Validamos si el valor del ID del GET es un String se muestra un error
if(!filter_var($id, FILTER_VALIDATE_INT)){
    die("¡ERRROR!");
}else{

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
            <h1>Editar Evento</h1>
            <span>Llena el formulario para editar el evento</span>
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
                      <h3 class="card-title">Editar Evento</h3>
                    </div>
                    <!-- /.card-header -->
<?php
                    $sql = "SELECT * FROM eventos WHERE evento_id = $id";
                    $resultado = $conn->query($sql);
                    $evento = $resultado->fetch_assoc();
?>

                    <!-- form start -->
                    <form class="form-horizontal needs-validation" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php" >
                      <div class="card-body">
                            <!-- TITULO -->
                           <div class="form-group row">
                              <label for="titulo_evento" class="col-sm-2 col-form-label">Titulo:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo Evento" required value="<?=$evento['nombre_evento']?>">
                              </div>
                            </div><!-- Fin - Titulo  -->
                            <!-- FECHA -->
                            <!-- Date Picker - Plugin.js-->
                            <div class="form-group row">
                                <label for="fecha_evento" class="col-sm-2 col-form-label">Fecha:</label>
<?php
                                    $fecha = $evento['fecha_evento'];
                                    $fecha_formato = date('d-m-Y', strtotime($fecha)); // Formateamos la fecha para que se muestre "Dia-Mes-Año"
?>
                                <div class=" row col-sm-10">
                                    <div class="input-group-prepend col-sm-1">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control float-right datepicker datemask" id="fecha_evento" name="fecha_evento" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?=$fecha_formato?>">
                                    </div>
                                </div>
                            </div><!-- Fin - Fecha  -->
                            <!-- HORA -->
                            <!-- Time Picker - Plugin.js -->
                            <div class="form-group row">
<?php
                                    $hora = $evento['hora_evento'];
                                    $hora_formato = date('h:i a', strtotime($hora)); // Formateamos la hora para que se muestre "Hora : Minutos AM/PM"
?>
                              <label for="hora_evento" class="col-sm-2 col-form-label">Hora:</label>
                              <div class=" row col-sm-10">
                                  <div class="input-group-prepend col-sm-1">
                                      <span class="input-group-text">
                                        <i class="far fa-clock"></i>
                                      </span>
                                  </div>
                                  <div class="date timepicker col-sm-5" id="timepicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="hora_evento" name="hora_evento" data-toggle="datetimepicker" data-target="#timepicker" value="<?=$hora_formato?>"/>
                                  </div>
                              </div>
                            </div><!-- Fin - Hora  -->
                            <!-- CATEGORIA -->
                            <!-- Select2 - Plugin.js -->
                            <div class="form-group row">
                              <label for="categoria_evento" class="col-sm-2 col-form-label">Categoría:</label>
                              <div class="col-sm-10">
                                <select class="select2" style="width: 100%;" name="categoria_evento">
                                  <option value="0">-- Seleccione --</option>
<?php                               
                                    try {
                                      $sql = "SELECT * FROM categoria_evento";
                                      $resultado = $conn->query($sql);
                                      while($cat_evento = $resultado->fetch_assoc()){
                                            // Recorremos el array y comparamos si es igual a la categoria, en el caso que sea igual, se agrega el "selected" en las opciones del Combo box/Select
                                            if($cat_evento['id_categoria'] == $evento['id_cat_evento']){                                                                           
?>                                        
                                                <option value="<?=$cat_evento['id_categoria']?>" selected>
                                                    <?=$cat_evento['cat_evento']?>
                                                </option>

<?php                                       }else{
?>
                                                <option value="<?=$cat_evento['id_categoria']?>">
                                                    <?=$cat_evento['cat_evento']?>
                                                </option>
<?php                                       } // Fin - if
                                        } // Fin - while
                                    } catch (Exception $e) {
                                      echo "Error: " . $e->getMessage();
                                    } // Fin - try
?>
                                </select>
                              </div>
                            </div><!-- Fin - Categoria  -->
                            <!-- INVITADO -->
                            <!-- Select2 - Plugin.js -->
                            <div class="form-group row">
                              <label for="invitado_evento" class="col-sm-2 col-form-label">Invitado:</label>
                              <div class="col-sm-10">
                                <select class="select2" style="width: 100%;" name="invitado_evento">
                                  <option value="0">-- Seleccione --</option>
<?php                               
                                    try {
                                      $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
                                      $resultado = $conn->query($sql);
                                        while($invitado = $resultado->fetch_assoc()){
                                            if($invitado['invitado_id'] == $evento['id_inv']){                                         
?>
                                                <option value="<?=$invitado['invitado_id'] ?>" selected>
                                                    <?=$invitado['nombre_invitado']. " " . $invitado['apellido_invitado']?>
                                                </option>
<?php                                       }else{
?>
                                                <option value="<?=$invitado['invitado_id'] ?>">
                                                    <?=$invitado['nombre_invitado']. " " . $invitado['apellido_invitado']?>
                                                </option>
<?php                                       } // Fin - if
                                        } // Fin - while                                     
                                    } catch (Exception $e) {
                                      echo "Error: " . $e->getMessage();
                                    } // Fin - try
?>
                                 </select>
                              </div>
                            </div><!-- Fin - Invitado  -->
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="registro" value="editar">
                        <input type="hidden" name="id_registro" value="<?=$id?>">
                        <button type="submit" id="btn-enviar-evento" class="btn btn-info">Enviar</button>
                      </div><!-- /.card-footer -->
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
}
include_once 'templates/footer.php';
?>