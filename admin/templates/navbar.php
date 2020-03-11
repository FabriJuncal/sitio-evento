<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>   
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-user mr-2"></i> <?=$_SESSION['nombre']?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              
              <div class="dropdown-divider"></div>
              <a href="editar-admin.php?id=<?=$_SESSION['id_admin']?>" class="dropdown-item">
                <i class="fas fa-cogs mr-2"></i></i> Configuración
              </a>
              <div class="dropdown-divider"></div>
              <a href="login.php?cerrar_sesion=true" class="dropdown-item">
                <i class="fas fa-sign-out-alt mr-2"></i> Salir
              </a>
              
            </div>
          </li>
    </ul>


  </nav>
  <!-- /.navbar -->