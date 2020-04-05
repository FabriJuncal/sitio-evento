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
            <h1>Crear Invitado</h1>
            <span>Llena el formulario para añadir un invitado</span>
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
                      <h3 class="card-title">Crear Invitado</h3>
                    </div>
                    <!-- /.card-header -->
<?php
                    $sql = "SELECT * FROM invitados WHERE invitado_id = $id";
                    $resultado = $conn->query($sql);
                    $invitado = $resultado->fetch_assoc();
?>
                    <!-- form start -->
                    <!-- enctype="multipart/form-data": Utilizamos este metodo para enviar archivos desde un formulario -->
                    <form class="form-horizontal needs-validation" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-invitado.php" enctype="multipart/form-data">
                      <div class="card-body">
                           <div class="form-group row">
                              <label for="nombre_invitado" class="col-sm-2 col-form-label">Nombre:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre Invitado" required value="<?=$invitado['nombre_invitado']?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="apellido_invitado" class="col-sm-2 col-form-label">Apellido:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apellido Invitado" required value="<?=$invitado['apellido_invitado']?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="biografia_invitado" class="col-sm-2 col-form-label">Biografía:</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" name="biografia_invitado" id="biografia_invitado"  rows="10" placeholder="Biografía"><?=$invitado['descripcion']?></textarea>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="imagen_actual" class="col-sm-2 col-form-label">Imagen Actual:</label>
                              <div class="col-sm-10">
                                <img src="../img/invitados/<?=$invitado['url_imagen']?>" width="200"> 
                              </div>
                            </div>
                            <div class="form-group row">
                              <label for="imagen_invitado" class="col-sm-2 col-form-label">Imagen</label>
                              <div class="input-group col-sm-10">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="imagen_invitado" name="imagen_invitado"> 
                                  <!-- Para cambiar el Icono pegado al Input ir:
                                      Archivo "admin/css/adminlte.css"
                                      Selector ".custom-file-label::after"
                                      Propiedad: "content"
                                   -->
                                  <label class="custom-file-label" for="imagen_invitado"><?=$invitado['url_imagen']?></label>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="registro" value="editar">
                        <input type="hidden" name="id_registro" value="<?=$id?>">
                        <button type="submit" id="btn-enviar-invitado" class="btn btn-info">Enviar</button>
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
}
include_once 'templates/footer.php';
""
?>


