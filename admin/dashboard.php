<?php
// Para que funcione la redirección, no debe haber nada antes
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'templates/navbar.php';
include_once 'templates/sidebar.php';
include_once "funciones/funciones.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">
      <!-- LINE CHART -->
      <div class="card card-info" style="width: 64rem;"> 
        <div class="card-header">
          <h3 class="card-title">Estadisticas de Registros</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="grafica-registros" style="max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>


    <h3>Resumen de Registros</h3>
    <div class="row">
      <!-- ./col Total Registrados-->
      <div class="col-lg-3 col-6">
        <?php
        // Total Registrados
        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small card -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $registrados['registros'] ?></h3>
            <p>Total Registrados</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="lista-registrado.php" class="small-box-footer">
            Más información <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col Total Pagados-->
      <div class="col-lg-3 col-6">
        <?php
        // Total pagados
        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 1";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small card -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $registrados['registros'] ?></h3>
            <p>Total Pagados</p>
            <div class="icon">
              <i class="fas fa-user-check"></i>
            </div>
          </div>
          <a href="lista-registrado.php" class="small-box-footer">
            Más información <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col Total Sin Pagar-->
      <div class="col-lg-3 col-6">
        <?php
        // Total sin pagar
        $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 0";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small card -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= $registrados['registros'] ?></h3>
            <p>Total Sin Pagar</p>
            <div class="icon">
              <i class="fas fa-user-times"></i>
            </div>
          </div>
          <a href="lista-registrado.php" class="small-box-footer">
            Más información <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col Ganancias Totales-->
      <div class="col-lg-3 col-6">
        <?php
        // Ganancias Total
        $sql = "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado = 1";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small card -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>$<?= $registrados['ganancias'] ?></h3>
            <p>Ganancias Totales</p>
            <div class="icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
          <a href="lista-registrado.php" class="small-box-footer">
            Más información <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <h3>Regalos</h3>
    <div class="row">
      <?php

      // Total Regalos(Pulseras - Etiquetas - Plumas)
      $sql = "SELECT rg.nombre_regalo AS regalo, COUNT(r.regalo) AS cant_regalo
                FROM registrados r
                JOIN regalos rg
                  ON ID_regalo = regalo
                WHERE pagado = 1
                GROUP BY rg.ID_regalo";
      $resultado = $conn->query($sql);

      while ($registrados = $resultado->fetch_assoc()) {

        switch ($registrados['regalo']) {

          case 'Pulsera':
      ?>
            <!-- ./col Pulseras Totales-->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>$<?= $registrados['cant_regalo'] ?></h3>
                  <p>Pulseras Totales</p>
                  <div class="icon">
                    <i class="fas fa-gift"></i>
                  </div>
                </div>
                <a href="lista-registrado.php" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          <?php
            break;

          case 'Etiquetas':
          ?>
            <!-- ./col Etiquetas Totales-->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3>$<?= $registrados['cant_regalo'] ?></h3>
                  <p>Etiquetas Totales</p>
                  <div class="icon">
                    <i class="fas fa-gift"></i>
                  </div>
                </div>
                <a href="lista-registrado.php" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          <?php
            break;

          case 'Plumas':
          ?>
            <!-- ./col Plumas Totales-->
            <div class="col-lg-3 col-6">
              <!-- small card -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>$<?= $registrados['cant_regalo'] ?></h3>
                  <p>Plumas Totales</p>
                  <div class="icon">
                    <i class="fas fa-gift"></i>
                  </div>
                </div>
                <a href="lista-registrado.php" class="small-box-footer">
                  Más información <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
      <?php
            break;
        }
      }

      ?>

    </div>

  </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once 'templates/footer.php';
?>