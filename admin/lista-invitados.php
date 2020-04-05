<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';
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
            <h1>Listado de Invitados</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Gestiona los invitados en esta sección</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
  <!--=========================================== Tabla dinamica - Plugin.js - DataTable.js============================================================ -->
              <table id="registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>invitado_id</th>
                  <th>Nombre</th>
                  <th>Biografía</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
                    try{
                      include_once "funciones/funciones.php";
                      $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado, descripcion, url_imagen
                              FROM invitados";
                      $resultado =  $conn->query($sql);
                    }catch (Exception $e){
                      $error = $e->getMessage();
                      echo $error;
                    }

                    while($invitado = $resultado->fetch_assoc()){
?>
                      <tr>
                        <td><?=$invitado['invitado_id']?></td>
                        <td><?=$invitado['nombre_invitado']." ".$invitado['apellido_invitado']?></td>
                        <td><?=$invitado['descripcion']?></td>
                        <td><?=$invitado['url_imagen']?></td>
                        <td>
                          <a href="editar-invitado.php?id=<?=$invitado['invitado_id']?>" class="btn bg-gradient-info btn-sm ml-1 ">
                            <i class="fa fa-pencil-alt"></i>
                          </a>
                          <a href="#" data-id="<?=$invitado['invitado_id']?>" data-tipo="invitado" class="btn bg-gradient-danger btn-sm ml-2 borrar_registro">
                            <i class="fa fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                                         
<?php               }
?>                
                </tbody>
                <tfoot>
                <tr>
                  <th>invitado_id</th>
                  <th>Nombre</th>
                  <th>Biografía</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'templates/footer.php';
?>


