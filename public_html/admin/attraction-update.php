<?php
session_start();
if (empty($_SESSION['username'])) {
//  echo "Необходимо войти в систему!";
  header("Location: /admin/log-in.php");
}
require_once("../RedBeanPHP5_4_2/rb.php");
R::setup('mysql:host=mysql_geoauth;port=3306;dbname=geoauth', 'geoauth', '3004917779');
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $markers = R::load('markers', $id);
  $name = $markers->name;
  $address = $markers->address;
  $lat = $markers->lat;
  $lng = $markers->lng;
  $type = $markers->type;
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
            <h1 class="m-0 text-dark">Добавить запись</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
              <li class="breadcrumb-item active"><a href="attracion-admin.php">Объекты в базе данных</a>
              </li>
              <li class="breadcrumb-item active">Добавить запись</li>
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
                <form method="post" action="handler-update-attraction.php">
                  <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>">
                  </div>
                  <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?= $address ?>">
                  </div>
                  <div class="form-group">
                    <label for="lat">Широта</label>
                    <input type="number" step="any" class="form-control" name="lat" id="lat" value="<?= $lat ?>">
                  </div>
                  <div class="form-group">
                    <label for="lng">Долгота</label>
                    <input type="number" step="any" class="form-control" name="lng" id="lng" value="<?= $lng ?>">
                  </div>
                  <input hidden name="id" value="<?= $id ?>">
                  <div class="form-group">
                    <label for="type">Тип</label>
                    <select type="text" class="form-control" name="type" id="type">
                      <option value="<?= $type ?>"><?= $type ?></option>
                      <option value="aquarium">Акваримуы</option>
                      <option value="art_gallery">Арт-галлереи</option>
                      <option value="church">Церкви</option>
                      <option value="city_hall">Ратуша</option>
                      <option value="amusement_park">Парк с атракционами</option>
                      <option value="museum">Музеи</option>
                      <option value="synagogue">Синагога</option>
                      <option value="tourist_attraction">Туристические достопримечательности</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-success">Сохранить запись</button>
                  <a href="attracion-admin.php" class="btn btn-info">Назад</a>
                </form>
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
