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
          <h1>Listado de Registrados</h1>
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
            <h3 class="card-title">Gestiona los registrados en esta sección</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!--=========================================== Tabla dinamica - Plugin.js - DataTable.js============================================================ -->
            <table id="registros" class="table table-bordered table-hover wrap" style="width:100%">
              <thead>
                <tr>
                  <th>ID Registrado</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Artículos</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                  <th>Talleres</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  include_once "funciones/funciones.php";
                  $sql = "SELECT registrados.*, regalos.nombre_regalo
                              FROM registrados
                              JOIN regalos
                              ON registrados.regalo = regalos.ID_regalo";
                  $resultado =  $conn->query($sql);
                } catch (Exception $e) {
                  $error = $e->getMessage();
                  echo $error;
                }

                while ($registado = $resultado->fetch_assoc()) {
                  // echo "<pre>";
                  // die(print_r($registado));
                ?>
                  <tr>
                    <!-- Col-Nombre -->
                    <td>
                      <?$registado['ID_Registrado'];?>
                    </td>
                    <td>
                      <?= $registado['nombre_registrado'] . " " . $registado['apellido_registrado'];
                      $pagado = $registado['pagado'];

                      // Verificamos Si el Usuario Pago o No
                      if ($pagado) {
                        echo '<br><span class="badge bg-green"> Pagado </span>';
                      } else {
                        echo '<br><span class="badge bg-red"> No Pagado </span>';
                      }
                      ?>
                    </td>
                    <!-- Col-Nombre -->
                    <td><?= $registado['email_registrado'] ?></td>
                    <!-- Col-Fecha Registro -->
                    <td><?= $registado['fecha_registro'] ?></td>
                    <!-- Col-Articulos -->
                    <td><?php
                        $articulos = json_decode($registado['pases_articulos'], true);

                        $arreglo_articulos = array(
                          'un_dia' => 'Pase 1 día',
                          'pase_2dias' => 'Pase 2 días',
                          'pase_completo' => 'Pase Completo',
                          'camisas' => 'Camisas',
                          'etiquetas' => 'Etiquetas'
                        );

                        foreach ($articulos as $llave => $articulo) {
                          // echo "<pre>";
                          // echo print_r($articulo);
                          // echo "<pre>";
                          if (array_key_exists('cantidad', $articulo)) {
                            echo "<span class='badge badge-info right'>" . $articulo['cantidad'] . "</span>"  . " " . $arreglo_articulos[$llave] . "<br>";
                          } else {
                            echo "<span class='badge badge-info right'>$articulo</span>"  . " " . $arreglo_articulos[$llave] . "<br>";
                          }
                        }

                        ?>
                    </td>
                    <!-- Regalo -->
                    <td><?= $registado['nombre_regalo'] ?></td>
                    <!-- Compra -->
                    <td>$ <?= (float)$registado['total_pagado'] ?></td>
                    <!-- Acciones -->
                    <td>
                      <a href="editar-registrado.php?id=<?= $registado['ID_Registrado'] ?>" class="btn bg-gradient-info btn-sm ml-1 ">
                        <i class="fa fa-pencil-alt"></i>
                      </a>
                      <a href="#" data-id="<?= $registado['ID_Registrado'] ?>" data-tipo="registrado" class="btn bg-gradient-danger btn-sm ml-2 borrar_registro">
                        <i class="fa fa-trash-alt"></i>
                      </a>
                    </td>
                    <!-- Col-Talleres -->
                    <td>
                      <?php
                      $eventos_resultado = $registado['talleres_registrados'];
                      $talleres = json_decode($eventos_resultado, true);

                      $talleres = implode("', '", $talleres['eventos']);
                      $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM  eventos WHERE clave IN ('$talleres') OR evento_id IN ('$talleres')";

                      $resultado_talleres = $conn->query($sql_talleres);

                      while ($eventos = $resultado_talleres->fetch_assoc()) {
                        echo  utf8_encode($eventos['nombre_evento']) . " " . "<small class='badge badge-primary'><i class='far fa-calendar-alt'></i>" . " " . $eventos['fecha_evento'] . " " . "<i class='far fa-clock'></i>" . $eventos['hora_evento'] . "</small><br>";
                      }

                      ?>
                    </td>
                  </tr>
                  </tr>

                <?php }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID Registrado</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Artículos</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                  <th>Talleres</th>
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