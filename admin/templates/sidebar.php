  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../../sitio-evento/img/logo-mini.svg"   
           alt="GDLWebcamp Logo Mini"
           class="brand-image elevation-3"
           style="margin-top: 0px;border-radius: 10%;">
      <span class="brand-text font-weight-light"
       style="margin-left: -6px; font-family: 'Oswald', sans-serif;font-size: 1.4em;">
        DLWEBCAMP
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Eventos
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-evento.php" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-evento.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-book"></i>
              <p>
                Categoria Eventos
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-categoria.php" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-categoria.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>  

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-users"></i>
              <p>
                Invitados
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-invitados.php" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="v" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-address-card"></i>
              <p>
                Registrados
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-registrado.php" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-registrado.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>
 <?php   if($_SESSION['nivel'] == 1): ?> <!-- Solo el administrador con Nivel 1 podra ver este menu -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Administradores
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="lista-admin.php" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-admin.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>
<?php   endif ?> <!-- Fin de condición -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="nav-icon fas fa-comments"></i>
              <p>
                Testimoniales
              </p>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>