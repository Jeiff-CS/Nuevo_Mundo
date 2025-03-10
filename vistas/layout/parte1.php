<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuevo Mundo Confecciones</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Agregar FontAwesome (CDN) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- Sweetallert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- jQuery -->
  <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">

<script>
  if (!sessionStorage.getItem("bienvenida")) {
    Swal.fire({
      icon: "success",
      title: "Bienvenido al Sistema!",
      showConfirmButton: false,
      timer: 1500
    });

    // Guardar en sessionStorage para que no vuelva a mostrarse
    sessionStorage.setItem("bienvenida", "1");
  }
</script>

<div class="wrapper">

  <!-- Navbar horizontal-->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links vertical -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Full Scream -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $URL;?>/vistas/index.php" class="brand-link">
      <img src="<?php echo $URL;?>/public/images/logo.png" alt="NuevoMundo Logo" class="brand-image img-circle elevation-4">
      <span class="brand-text font-weight-light">Nuevo Mundo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $usuario_nombre ?></a>
        </div>
      </div>

      <!-- Sidebar Menu vertical -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- USUARIOS -->
          <li class="nav-item">
              <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                      Usuarios
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/usuarios/userindex.php" class="nav-link <?php echo (strpos($current_page, 'userindex.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lista de Usuarios</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/usuarios/createuser.php" class="nav-link <?php echo (strpos($current_page, 'createuser.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Gestión de Usuarios</p>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <!-- Propio -->
          <?php if ($usuario_rol === "Cajero") { ?> 
          <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="fa-solid fa-cart-shopping"></i>
                  <p>Punto Venta</p>
              </a>
          </li>
          <?php } ?>

          <li class="nav-item">
              <a href="#" class="nav-link">

                  <i class="nav-icon fas fa-list"></i>
                  <p>
                      Stock
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/" class="nav-link <?php echo (strpos($current_page, 'userindex.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tienda #202</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/" class="nav-link <?php echo (strpos($current_page, 'createuser.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Tienda #307</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/" class="nav-link <?php echo (strpos($current_page, 'createuser.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Almacén</p>
                      </a>
                  </li>
              </ul>
          </li>

          <?php if ($usuario_rol === "Administrador") { ?> 
          <!-- CATEGORÍAS -->
          <li class="nav-item">
              <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-tag"></i>
                  <p>
                      Categorías
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/categorias/catindex.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lista de Categorías</p>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item ">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-dolly"></i>
                  <p>
                      Productos
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/productos/prodindex.php" class="nav-link <?php echo (strpos($current_page, 'categorias/index.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Lista de Productos</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="<?php echo $URL; ?>/vistas/productos/createprod.php" class="nav-link <?php echo (strpos($current_page, 'categorias/index.php') !== false) ? 'active' : ''; ?>">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Gestion de Productos</p>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>Reportes</p>
              </a>
          </li>
          <?php } ?>

          <li class="nav-item">
          <a href="<?php echo $URL; ?>/recursos/controllers/login/logout.php" class="nav-link" style="background-color:rgb(158, 39, 39)">
                  <i class="nav-icon fas fa-door-closed"></i>
                  <p>Cerrar Sesión</p>
                  <!-- /vistas/login/index.php -->
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>