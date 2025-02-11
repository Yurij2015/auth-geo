<?php
session_start();
if (empty($_SESSION['username'])) {
//  echo "Необходимо войти в систему!";
  header("Location: /admin/log-in.php");

}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin Panel | Maps</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Главная</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="attracion-admin.php" class="nav-link active">Достопримечательности</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="user-admin.php" class="nav-link">Пользователи</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="log-out.php" class="nav-link">Выход <?= "| " . $_SESSION['username'] ?></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Admin Panel" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo "Admin User"; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Меню администратора
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Главная</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="attracion-admin.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Объекты в БД</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Пользователи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="log-out.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Выход <?= "| " . $_SESSION['username'] ?></p>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Достопримечательности в базе данных</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
              <li class="breadcrumb-item active">Объекты в базе данных</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Список достопримечательностей</h5>
                <a href="attraction-create.php" target="_blank" class="btn btn-outline-primary float-right">Добавить запись</a>
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Адрес</th>
                    <th>Широта</th>
                    <th>Долгота</th>
                    <th>Тип</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  require_once("../RedBeanPHP5_4_2/rb.php");
                  R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
                  $markers = R::getAll('SELECT * FROM markers ORDER BY name');
                  foreach ($markers as $marker) {
                    $id = $marker['id'];
                    echo "<tr>
                        <td>" . $id . "</td>
                        <td>" . $marker['name'] . "</td>
                        <td>" . $marker['address'] . "</td>
                        <td>" . $marker['lat'] . "</td>
                        <td>" . $marker['lng'] . "</td>
                        <td>" . $marker['type'] . "</td>
                        <td><a href='attraction-update.php?id=$id'>Edit</a>|<a href='attraction-delete.php?id=$id' onclick='return confirmDelete();'>Delete</a></td>
                      </tr>";
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date("Y") ?> <a href="/">AdminPanel</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="../js/confirmdelete.js"></script>
</body>
</html>
