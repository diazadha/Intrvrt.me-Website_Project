<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <link href='<?= base_url("assets/uploads/images/avatar.png"); ?>' rel='shortcut icon' type='image/x-icon' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5//plugins/select2/css/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?=base_url('home')?>" class="nav-link">Beranda Website</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <a href="<?= base_url('admin/account'); ?>" class="dropdown-item">
              Profile Admin
            </a>
            <a href="<?= base_url('home/logout') ?>" class="dropdown-item">
              Log out
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <?php $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      ?>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/uploads/user/') . $this->UserModel->profil('foto'); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href=" <?= base_url('admin/account') ?> " class="d-block"> <?= $this->UserModel->profil('nama'); ?> </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fab fa-blogger"></i>
                <p>
                  Blog
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/blog/index') ?>" class="nav-link">
                    <i class="fas fa-pen-square"></i>
                    <p>Konten Blog</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/blog/kategori') ?>" class="nav-link">
                    <i class=" fas fa-tag"></i>
                    <p>Kategori Blog</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Merchandise
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/merchandise') ?>" class="nav-link">
                    <i class="fas fa-pen-square ml-3"></i>
                    <p>Merchandise</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/merchandise/kategori') ?>" class="nav-link">
                    <i class=" fas fa-tag ml-3"></i>
                    <p>Kategori Merchandise</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>
                  Event
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/Event') ?>" class="nav-link">
                    <i class="fas fa-pen-square ml-3"></i>
                    <p>Data Event</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/Event/kategori') ?>" class="nav-link">
                    <i class=" fas fa-tag ml-3"></i>
                    <p>Kategori Tiket</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/user') ?>" class="nav-link">
                    <i class="far fa-user ml-3"></i>
                    <p>Register Admin</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">SETTING</li>
            <li class="nav-item">
              <a href="<?= base_url('admin/profil/perusahaan') ?>" class="nav-link">
                <i class="fas fa-building nav-icon"></i>
                <p>Profil Perusahaan</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <?php $this->load->view($content) ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; <?= date('Y') ?> INTRVRT.ME</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.3
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/chart.js/Chart.min.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- jquery-validation -->
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/dist/js/adminlte.js"></script>
  <script>
    let base_url = '<?php echo base_url(); ?>';
    $(function() {
      $('.select2').select2();
      var timeout = 3000; // in miliseconds (3*1000)
      $('.tutup').delay(timeout).fadeOut(300);
    })
  </script>

  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
  <?php if (isset($js)) : foreach ($js as $j) : ?>
      <script src="<?= base_url('assets/js/' . $j) ?>"></script>
  <?php endforeach;
  endif; ?>
</body>

</html>
