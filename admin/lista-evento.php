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
            <h1>Listado de Eventos</h1>
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
              <h3 class="card-title">Gestiona los eventos en esta sección</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
  <!--=========================================== Tabla dinamica - Plugin.js - DataTable.js============================================================ -->
              <table id="registros" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
<?php 
                    try{
                      include_once "funciones/funciones.php";
                      $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado
                              FROM eventos
                              INNER JOIN categoria_evento
                              ON eventos.id_cat_evento = categoria_evento.id_categoria
                              INNER JOIN invitados
                              ON eventos.id_inv = invitados.invitado_id
                              ORDER BY evento_id ";
                      $resultado =  $conn->query($sql);
                    }catch (Exception $e){
                      $error = $e->getMessage();
                      echo $error;
                    }

                    while($eventos = $resultado->fetch_assoc()){
?>
                      <tr>
                        <td><?=$eventos['nombre_evento']?></td>
                        <td><?=$eventos['fecha_evento']?></td>
                        <td><?=$eventos['hora_evento']?></td>
                        <td><?=$eventos['cat_evento']?></td>
                        <td><?=$eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']?></td>
                        <td>
                          <a href="editar-admin.php?id=<?=$eventos['evento_id']?>" class="btn bg-gradient-info btn-sm ml-1 ">
                            <i class="fa fa-pencil-alt"></i>
                          </a>
                          <a href="#" data-id="<?=$eventos['evento_id']?>" data-tipo="admin" class="btn bg-gradient-danger btn-sm ml-2 borrar_registro">
                            <i class="fa fa-trash-alt"></i>
                          </a>
                        </td>
                      </tr>
                                         
<?php               }
?>                
                </tbody>
                <tfoot>
                <tr>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoría</th>
                  <th>Invitado</th>
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


