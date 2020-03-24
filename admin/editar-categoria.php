<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';

$id = $_GET['id'];
//Validamos si el valor del ID del GET es un String se muestra un error
if(!filter_var($id, FILTER_VALIDATE_INT)){
    die("¡ERRROR!");
}else{

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
            <h1>Editar Categoría de Evento</h1>
            <span>Llena el formulario para editar una categoria</span>
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
                      <h3 class="card-title">Editar Categoria</h3>
                    </div>
                    <!-- /.card-header -->
<?php
                    $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id";
                    $resultado = $conn->query($sql);
                    $categoria_evento = $resultado->fetch_assoc();
?>
                    <!-- form start -->
                    <form class="form-horizontal needs-validation" name="guardar-registro" id="guardar-registro" method="post" action="modelo-categoria.php" >
                      <div class="card-body">
                           <div class="form-group row">
                              <label for="nombre_categoria" class="col-sm-2 col-form-label">Nombre:</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Nombre Categoría" value="<?=$categoria_evento['cat_evento']?>" required>
                              </div>
                            </div>
                            <div class="form-group row">
                            <label for="icono_categoria" class="col-sm-2 col-form-label">Icono:</label>
                              <div class="input-group col-sm-6">
                                  <div class="input-group-prepend col-sm-2">
                                    <span class="input-group-addon icono-personalizado input-group-text"></span>
                                  </div>
                                  <input type="text" data-placement="bottomRight" id="icono_categoria" class="form-control icp iconpicker" name="icono_categoria" value="<?=$categoria_evento['icono']?>" required/>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="registro" value="editar">
                        <input type="hidden" name="id_registro" value="<?=$id?>">
                        <button type="submit" id="btn-enviar-categoria" class="btn btn-info">Enviar</button>
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
?>


