<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';


$id = $_GET['id'];
// Validamos que el valor que pasamos por GET sea un Numero
if(!filter_var($id, FILTER_VALIDATE_INT)){
  die('¡ERROR!');
} 

include_once 'templates/header.php';
include_once 'templates/navbar.php';
include_once 'templates/sidebar.php';

// Obtenemos los datos del administrador por el ID que pasamos por GET
$sql = "SELECT * FROM admins WHERE id_admin = $id";
$resultado = $conn->query($sql);
$admin = $resultado->fetch_assoc();
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Administrador</h1>
            <span>Llena el formulario para crear un administrador</span>
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
                      <h3 class="card-title">Crear Administrador</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" name="crear-admin" id="crear-admin" method="post" action="modelo-admin.php">
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?=$admin['usuario']?>">
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu Nombre Completo" value="<?=$admin['nombre']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="agregar-admin">
                        <button type="submit" class="btn btn-info">Añadir</button>
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


